<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ApiAdminController extends Controller
{
    function getSearchCate(Request $request)
    {
        try {
            if ($request->get('keyword') != "") {
                $categoryQuery =  Category::where('cate_name', 'like', "%" . $request->keyword . "%")->get();
            } else {
                $categoryQuery =  Category::all();
            }

            return response()->json([
                'status' => 200,
                'result' => $categoryQuery
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 400
            ]);
        }
    }

    function getSearchProd(Request $request)
    {
        try {
            if ($request->get('keyword') != null) {
                $productQuery =  Product::with('category')->where('product_name', 'like', "%" . $request->get('keyword') . "%")
                    ->orWhere('brand', 'like', "%" . $request->get('keyword') . "%")
                    ->get();
            } else {
                $productQuery =  Product::with('category')->get();
            }

            return response()->json([
                'status' => 200,
                'result' => $productQuery
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 400
            ]);
        }
    }

    function getSearchUser(Request $request)
    {
        try {
            if ($request->get('keyword') != null) {
                $userQuery =  User::where('name', 'like', "%" . $request->get('keyword') . "%")
                    ->get();
            } else {
                $userQuery =  User::get();
            }

            return response()->json([
                'status' => 200,
                'result' => $userQuery
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 400
            ]);
        }
    }
}
