<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Exception;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\at;

class TestController extends Controller
{
    //
    public function test(Request $request)
    {
        $product = Product::all();

        $findPro = Product::where('id', $request->id)->first(); // tim
        if ($findPro) {
            $editProduct = $findPro->update([
                'product_name' => $request->product_name,
                'brand' => $request->brand,
                'price' => $request->price,
                'sale' => $request->sale,
                'size' => $request->size,
                'color' => $request->color,
                'image' => $request->image,
                'description' => $request->description,
                'highlight' => $request->highlight,
                'cate_id' => $request->cate_id,
            ]);
            if ($editProduct) {
                return response()->json($findPro);
            }
        } else {
            return 'sai';
        }
    }


    public function apiUploadProduct(Request $request)
    {
        $findProduct = Product::where('id', $request->id)->first();
        if ($findProduct) {
            $editProduct = $findProduct->update([
                'product_name' => $request->product_name,
                'brand' => $request->brand,
                'price' => $request->price,
                'sale' => $request->sale,
                'size' => $request->size,
                'color' => $request->color,
                'image' => $request->image,
                'description' => $request->description,
                'highlight' => $request->highlight,
                'cate_id' => $request->cate_id,
            ]);
            if ($editProduct) {
                return response()->json($findProduct);
            }
        }
    }

    public function test2(Request $request)
    {
        $insertProduct = Product::create([
            'product_name' => $request->product_name,
            'brand' => $request->brand,
            'price' => $request->price,
            'sale' => $request->sale,
            'size' => $request->size,
            'color' => $request->color,
            'image' => $request->image,
            'description' => $request->description,
            'highlight' => $request->highlight,
            'cate_id' => $request->cate_id,
        ]);

        if ($insertProduct) {
            return response()->json($insertProduct);
        }
    }

    public function apiProduct(Request $request)
    {
        $product = Product::where('cate_id', 2)->get();
        return response()->json($product);
    }


    public function apiAddToCart(Request $request)
    {
        $listCart = Cart::all(); // B1 : lấy tất cả user_id trong cart
        $arr = [];
        // dump($cart);
        $keyCheck = false;

        foreach ($listCart as $key) {
            $user_id_cart = $key->user_id;
            array_push($arr, $user_id_cart);
            // if (Auth::user()->id == $key->user_id) {
            //     $keyCheck = true;
            // }
            // break;
        }
        // dump($keyCheck);
        // die;

        if (Auth::check()) {
            $user = Auth::user()->id;
            dump($user);
            if (in_array($user, $arr)) { // B2 : ktra xem user có cart chưa ?
                dump('đã có cart');
                $cart = Cart::where('user_id', $user)->first(); //có thì lấy ra

            } else {
                $cart = Cart::create([ // chưa có thì thêm
                    'user_id' => Auth::user()->id,
                ]);
                dump('chưa có');
            }
            $cart_id = $cart->id;
            $create = CartDetail::create([
                'product_id' => 4,
                'cart_id' => $cart_id,
                'quantity' => 2
            ]);

            if ($create) {
                return response()->json($create);
            }
        }
    }


    public function addCartByDB(Request $request)
    {
        $quantity = 0;
        try {
            // dump(Auth::user()->id);
            $cart = Cart::where('user_id', 1)->first();
            if ($cart) {
                dump('Có cart');
                $cart = $cart;
            } else {
                $cart = Cart::create([
                    'user_id' => 1,
                ]);
                dump('chưa có');
            }
            $cart_id = $cart->id;
            $cartDetail = CartDetail::where('cart_id', $cart_id)->get(); // b1 : lấy tất cả cartDetail
            // dump($cartDetail);
            if ($cartDetail) {
                dump('có cartDT');
                $arrPrdID = [];
                foreach ($cartDetail as $key) {
                    $prd_id = $key->product_id;
                    $quantity = $key->quantity;
                    // dump($prd_id);
                    array_push($arrPrdID, $prd_id);
                }
            }

            if (!in_array(6, $arrPrdID)) {
                $createDetail = CartDetail::create([
                    'product_id' => 6,
                    'cart_id' => $cart_id,
                    'quantity' => 1
                ]);
                if ($createDetail) {
                    dump('thêm mới tc');
                }
            } else {
                $createDetail = CartDetail::where('product_id', 6)->where('cart_id', $cart_id)->first();
                $createDetail->update([
                    'product_id' => 6,
                    'cart_id' => $cart_id,
                    'quantity' => $quantity + 1
                ]);
            }

            $cartDt = Cart::with('cart_detail')->where('user_id', 1)->first();
            dump($cartDt);
            $count = 0;
            foreach ($cartDt->cart_detail as $key) {
                $count = $count + $key->quantity;
            }

            dump($count);

            if ($createDetail) {
                return response()->json([
                    'status' => 200,
                    'result' => $createDetail,
                    'count' => $count
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                'status' => 400,
            ]);
        }
    }

    public function countProduct(Request $request)
    {
        try {
            $cartDt = Cart::with('cart_detail')->where('user_id', Auth::user()->id)->first();
            dump(Auth::user()->id);
            $count = 0;
            foreach ($cartDt->cart_detail as $key) {
                $count = $count + $key->quantity;
            }
            if ($count) {
                return response()->json([
                    'status' => 200,
                    'count' => $count
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                'status' => 400,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function deleteByID(Request $request)
    {
        try {
            $product_id = $request->id;
            // dump(Auth::user()->id);
            $cart_id = Cart::where('user_id', Auth::user()->id)->first()->id;

            $delete = CartDetail::where('product_id', $product_id)->where('cart_id', $cart_id)->delete();
            if ($delete) {
                return response()->json([
                    'status' => 200,
                ]);
            } else {
                return response()->json([
                    'status' => 400
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                'status' => 400,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function listProd()
    {
        try {
            $listProd = Product::all();
            if ($listProd) {
                return response()->json([
                    'status' => 200,
                    'result' => $listProd,
                ]);
            } else {
                return response()->json([
                    'status' => 400
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                'status' => 400,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function deleteProd(Request $request)
    {
        try {
            $cart_id = Cart::where('user_id', 1)->first()->id;

            $delete = CartDetail::where('product_id', 2)::where('cart_id', $cart_id)->delete();

            if ($delete) {
                return response()->json([
                    'status' => 200,
                    'result' => 'Xóa thành công'
                ]);
            } else {
                return response()->json([
                    'status' => 400
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                'status' => 400,
                'message' => $th->getMessage()
            ]);
        }

        dump($cart_id);
    }

    public function searchProd(Request $request)
    {
        dd(1);
    }

    public function testzz()
    {
        return 1;
    }
}