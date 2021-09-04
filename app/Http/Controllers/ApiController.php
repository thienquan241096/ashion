<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    //
    public function apiProductByCartID(Request $request)
    {
        $product = Product::where('cate_id', $request->cate_id)->get();

        return response()->json($product);
        if ($product) {
            return response()->json([
                'status' => 200,
                'result' => $product
            ]);
        } else {
            return response()->json([
                'status' => 400
            ]);
        }
    }

    public function apiAddToCart(Request $request)
    {
        try {
            $cart = Cart::where('user_id', Auth::user()->id)->first();
            if ($cart) {
                dump('Có cart');
                $cart = $cart;
            } else {
                $cart = Cart::create([
                    'user_id' => Auth::user()->id,
                ]);
                // dump('chưa có');
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

            if (!in_array($request->id, $arrPrdID)) {
                $createDetail = CartDetail::create([
                    'product_id' => $request->id,
                    'cart_id' => $cart_id,
                    'quantity' => $request->quantity
                ]);
                // if ($createDetail) {
                //     dump('thêm mới tc');
                // }
            } else {
                $createDetail = CartDetail::where('product_id', $request->id)->where('cart_id', $cart_id)->first();
                $createDetail->update([
                    'product_id' => 6,
                    'cart_id' => $cart_id,
                    'quantity' => $createDetail->quantity + $request->quantity
                ]);
            }

            $cartDt = Cart::with('cart_detail')->where('user_id', 1)->first();
            dump($cartDt);
            $count = 0;
            foreach ($cartDt->cart_detail as $key) {
                $count = $count + $key->quantity;
            }
            // dump($count);

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
                'status' => $th->getMessage()
            ]);
        }
    }

    public function apiCountPrd(Request $request)
    {
        try {
            $cartDt = Cart::with('cart_detail')->where('user_id', $request->user_id)->first();
            $count = 0;
            foreach ($cartDt->cart_detail as $key) {
                $count = $count + $key->quantity;
            }
            if ($cartDt) {
                return response()->json([
                    'status' => 200,
                    'count' => $count
                ]);
            } else {
                return response()->json([
                    'status' => 4001,
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                'status' => $th->getMessage()
            ]);
        }
    }

    public function apiListProd()
    {
        try {
            $listProd = Product::all();
            if ($listProd) {
                return response()->json([
                    // 'status' => 200,
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

    public function postSearch(Request $request)
    {
        try {
            $priceMin = $request->get('priceMin');
            $priceMax = $request->get('priceMax');

            // dump($priceMin);
            // die;
            $product = Product::with('category');

            if ($priceMin != "" && $priceMax != "") {
                $product->whereBetween('sale', [$priceMin, $priceMax]);
            }

            $data = $product->get();

            return response()->json([
                'status' => 200,
                'result' => $data
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 400
            ]);
        }
    }
}