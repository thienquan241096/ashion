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
                // ->with('thongbao', 'Chưa có gì trong giỏ hàng của bạn')
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
                    // dump('Có cart');
                    $cart = $cart;
                } else {
                    $cart = Cart::create([
                        'user_id' => Auth::user()->id,
                    ]);
                    // dump('chưa có');
                }
                $cart_id = $cart->id;
                $cartDetail = CartDetail::where('cart_id', $cart_id)->get(); // b1 : lấy tất cả cartDetail
                if ($cartDetail) {
                    // dump('có cartDT');
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
                //     'quantity.required' => 'Vui lòng k để trống',
                //     'quantity.min' => 'Vui lòng nhập ít nhất 1 kí tự'
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
                return redirect()->route('getCart')->with('thongbao', 'Xóa thành công !!!')->with('thongbao', 'Thêm mới thành công !!!');
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
            'email.required' => 'Vui lòng k để trống',
            'email.email' => 'Vui lòng nhập đúng định dạng',
            'password.required' => 'Vui lòng k để trống',
            'password.min' => 'Vui lòng nhập ít nhất 6 kí tự',
            // 'confirmPassword.required' => 'Vui lòng k để trống',
            // 'confirmPassword.same' => 'mật khẩu nhập lại không khớp',
        ];

        $validateData =  $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            // 'confirmPassword' => 'required|same:password',
        ], $errs);


        $info = $request->only('email', 'password');
        // $info['type'] = 1;

        if (Auth::attempt($info)) {
            return redirect()->route('getCart')->with('thongbao', 'Đăng nhập thành công !!!');
        } else {
            return redirect()->route('getLogin')->with('thongbao', 'Đăng nhập thất bại !!!');
        }
    }

    // LOGOUT
    public function postLogout()
    {
        Auth::logout();
        return redirect()->route('getLogin')->with('thongbao', 'Đăng xuất thành công !!!');
    }

    // REGISTER
    public function getRegister()
    {
        return view('pages/register');
    }

    public function postRegister(Request $request)
    {
        $errs = [
            'name.required' => 'Vui lòng k để trống',
            'name.min' => 'Vui lòng nhập ít nhất 2 kí tự',
            'name.max' => 'Vui lòng nhập dưới 20 kí tự',
            'email.required' => 'Vui lòng k để trống',
            'email.email' => 'Vui lòng nhập đúng định dạng',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Vui lòng k để trống',
            'password.min' => 'Vui lòng nhập ít nhất 6 kí tự',
            'confirmPassword.required' => 'Vui lòng k để trống',
            'confirmPassword.same' => 'mật khẩu nhập lại không khớp',
            'phone.required' => 'Vui lòng k để trống',
            'phone.min' => 'Vui lòng nhập ít nhất 10 số',
            'phone.max' => 'Vui lòng nhập dưới 11 số',
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
                return redirect()->route('getRegister')->with('thongbao', "Đăng kí thành công !!!");
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
