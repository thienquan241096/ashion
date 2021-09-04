<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getList()
    {
        $listCart = Cart::all();
        return view('admin/cart/list', ['listCart' => $listCart]);
    }

    public function getDetail(Request $request)
    {
        $detailCart = CartDetail::with('products')->where('cart_id', $request->id)->get();

        $arr = [];
        foreach ($detailCart as $value) {
            $product_id = $value->product_id;
            array_push($arr, $product_id);
        }
        $listProduct = Product::whereIn('id', $arr)->get();

        return view('admin/cart/detail', [
            'detailCart' => $detailCart,
            'listProduct' => $listProduct
        ]);
    }

    public function postDelete(Request $request)
    {
        try {
            $delete = CartDetail::where('id', $request->id)->delete();
            if ($delete) {
                return redirect()->route("cart.getList")->with('thongbao', 'Xóa thành công !!!');
            }
        } catch (\Exception $th) {
            dump($th->getMessage());
        }
    }
}