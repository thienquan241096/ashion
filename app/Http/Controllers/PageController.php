<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class PageController extends Controller
{
    //
    public function __construct(Request $request)
    {
        $category_first = Category::where('id', 1)->first();
        $category = Category::withCount('product')->where('id', '>', 1)->get();
        $listCate = Category::all();
        $product = Product::with('category');
        // dump($request->id);
        if ($request->id) {
            $product->where('id', $request->id);
        }
        $listProduct = $product->paginate(8);

        // dump($listProduct);
        view()->share([
            'category_first' => $category_first,
            'category' => $category,
            'listCate' => $listCate,
            'listProduct' => $listProduct,
        ]);
    }

    // HOMEPAGE
    public function home()
    {
        return view('pages/homePage');
    }


    //  DETAIL
    public function getDetail(Request $request)
    {
        $detailProduct = Product::where('id', $request->id)->first();
        // dump($detailProduct);
        return view('pages/productDetail', [
            'detailProduct' => $detailProduct
        ]);
    }

    public function getCart(Request $request)
    {
        $listCart = Cart::all();
        $arr = [];
        foreach ($listCart as $value) {
            $user_id = $value->user_id;
            array_push($arr, $user_id);
        }

        if (Auth::check()) {
            if (in_array(Auth::user()->id, $arr)) {
                $cart = Cart::where('user_id', Auth::user()->id)->first();

                $detailCart = CartDetail::with('products')->where('cart_id', $cart->id)->get();
                // $newArr = [];
                // foreach ($detailCart as  $value) {
                //     $product_id = $value->product_id;
                //     array_push($newArr, $product_id);
                // }
                // $listProduct = Product::whereIn('id', $newArr)->get();
                // dump($cart);

                return view('pages/shopCart', [
                    'detailCart' => $detailCart
                ]);
            } else {
                return redirect()->route('home');
                // ->with('thongbao', 'Ch??a c?? g?? trong gi??? h??ng c???a b???n')
            }
        } else {
            return view('pages/login');
        }
    }

    public function postAddToCart(Request $request)
    {
        try {
            if (Auth::user() != null) {
                $quantity = $request->quantity;
                $cart = Cart::where('user_id', Auth::user()->id)->first();
                if ($cart) {
                    // dump('C?? cart');
                    $cart = $cart;
                } else {
                    $cart = Cart::create([
                        'user_id' => Auth::user()->id,
                    ]);
                    // dump('ch??a c??');
                }
                $cart_id = $cart->id;
                $cartDetail = CartDetail::where('cart_id', $cart_id)->get(); // b1 : l???y t???t c??? cartDetail
                if ($cartDetail) {
                    // dump('c?? cartDT');
                    $arrPrdID = [];
                    foreach ($cartDetail as $key) {
                        $prd_id = $key->product_id;
                        $quantity = $key->quantity;
                        // dump($prd_id);
                        array_push($arrPrdID, $prd_id);
                    }
                }
                // $request->validate([
                //     'quantity' => 'required|min:0',
                // ], [
                //     'quantity.required' => 'Vui l??ng k ????? tr???ng',
                //     'quantity.min' => 'Vui l??ng nh???p ??t nh???t 1 k?? t???'
                // ]);

                if (!in_array($request->id, $arrPrdID)) {
                    $createDetail = CartDetail::create([
                        'product_id' => $request->id,
                        'cart_id' => $cart_id,
                        'quantity' => $quantity
                    ]);
                } else {
                    $createDetail = CartDetail::where('product_id', $request->id)->where('cart_id', $cart_id)->first();
                    $createDetail->update([
                        'product_id' => $request->id,
                        'cart_id' => $cart_id,
                        'quantity' => $quantity + $createDetail->quantity
                    ]);
                }
                if ($createDetail) {
                    return redirect()->route('getCart');
                }
            } else {
                return redirect()->route('getLogin');
            }
        } catch (\Exception $th) {
            dump($th->getMessage());
        }
    }

    public function postDeleteProductByID(Request $request)
    {
        try {
            $product_id = $request->id;
            $cart_id = Cart::where('user_id', Auth::user()->id)->first()->id;
            // dump($cart_id);
            $delete = CartDetail::where('product_id', $product_id)->where('cart_id', $cart_id)->delete();
            if ($delete) {
                return redirect()->route('getCart')->with('thongbao', 'X??a th??nh c??ng !!!')->with('thongbao', 'Th??m m???i th??nh c??ng !!!');
            }
        } catch (\Exception $th) {
            dump($th->getMessage());
        }
    }

    public function checkOut()
    {
        return view('pages/checkout');
    }

    // LOGIN
    public function getLogin()
    {
        return view('pages/login');
    }

    public function postLogin(Request $request)
    {
        $errs = [
            'email.required' => 'Vui l??ng k ????? tr???ng',
            'email.email' => 'Vui l??ng nh???p ????ng ?????nh d???ng',
            'password.required' => 'Vui l??ng k ????? tr???ng',
            'password.min' => 'Vui l??ng nh???p ??t nh???t 6 k?? t???',
            // 'confirmPassword.required' => 'Vui l??ng k ????? tr???ng',
            // 'confirmPassword.same' => 'm???t kh???u nh???p l???i kh??ng kh???p',
        ];

        $validateData =  $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            // 'confirmPassword' => 'required|same:password',
        ], $errs);


        $info = $request->only('email', 'password');
        // $info['type'] = 1;

        if (Auth::attempt($info)) {
            return redirect()->route('getCart')->with('thongbao', '????ng nh???p th??nh c??ng !!!');
        } else {
            return redirect()->route('getLogin')->with('thongbao', '????ng nh???p th???t b???i !!!');
        }
    }

    // LOGOUT
    public function postLogout()
    {
        Auth::logout();
        return redirect()->route('getLogin')->with('thongbao', '????ng xu???t th??nh c??ng !!!');
    }

    // REGISTER
    public function getRegister()
    {
        return view('pages/register');
    }

    public function postRegister(Request $request)
    {
        $errs = [
            'name.required' => 'Vui l??ng k ????? tr???ng',
            'name.min' => 'Vui l??ng nh???p ??t nh???t 2 k?? t???',
            'name.max' => 'Vui l??ng nh???p d?????i 20 k?? t???',
            'email.required' => 'Vui l??ng k ????? tr???ng',
            'email.email' => 'Vui l??ng nh???p ????ng ?????nh d???ng',
            'email.unique' => 'Email n??y ???? ???????c s??? d???ng',
            'password.required' => 'Vui l??ng k ????? tr???ng',
            'password.min' => 'Vui l??ng nh???p ??t nh???t 6 k?? t???',
            'confirmPassword.required' => 'Vui l??ng k ????? tr???ng',
            'confirmPassword.same' => 'm???t kh???u nh???p l???i kh??ng kh???p',
            'phone.required' => 'Vui l??ng k ????? tr???ng',
            'phone.min' => 'Vui l??ng nh???p ??t nh???t 10 s???',
            'phone.max' => 'Vui l??ng nh???p d?????i 11 s???',
        ];

        $validateData =  $request->validate([
            'name' => 'required|min:2|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
            'phone' => 'required|min:10|max:11',
        ], $errs);

        try {
            $create = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'confirmPassword' => bcrypt($request->confirmPassword),
                'phone' => $request->phone,
                'type' => 0,
            ]);
            if ($create) {
                return redirect()->route('getRegister')->with('thongbao', "????ng k?? th??nh c??ng !!!");
            }
        } catch (\Exception $th) {
            dump($th->getMessage());
        }
    }

    public function shop()
    {
        return view('pages/shop');
    }

    public function contact()
    {
        return view('pages/contact');
    }

    public function blog()
    {
        return view('pages/blog');
    }
}
