<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function getList()
    {
        $products =  Product::paginate(6);
        return view('admin/product/list', ['products' => $products]);
    }

    public function getCreate()
    {
        $cate = Category::all();
        return view('admin/product/add', [
            'cate' => $cate
        ]);
    }

    public function postCreate(ProductFormRequest $request)
    {

        try {
            $model = new Product();
            $model->fill($request->all());
            if ($request->hasFile('image')) {
                $newFileName = uniqid() . '-' . $request->image->getClientOriginalName();
                $path = $request->image->storeAs('public/uploads/products', $newFileName);
                $model->image = str_replace('public/', '', $path);
                // dd($path);
            }
            $model->save();
            return redirect()->route('product.getCreate')->with('thongbao', "Thêm mới thành công !!!");
        } catch (\Exception $th) {
            dump($th->getMessage());
        }
    }

    public function test(Request $request)
    {
        // $path = Storage::disk('public')->put('product', $request->file('image'));
        // dump(asset("storage/$path"));
    }

    public function getEdit(Request $request)
    {
        $cate = Category::all();
        $product = Product::where('id', $request->id)->first();
        return view('admin/product/edit', [
            'cate' => $cate,
            'product' => $product
        ]);
    }

    public function postEdit(ProductFormRequest $request)
    {
        try {
            $model = Product::find($request->id);
            $model->fill($request->all());
            if ($request->hasFile('image')) {
                $newFileName = uniqid() . '-' . $request->image->getClientOriginalName();
                $path = $request->image->storeAs('public/uploads/products', $newFileName);
                $model->image = str_replace('public/', '', $path);
            }
            $model->save();
            return redirect()->route('product.getList')->with('thongbao', "Sửa thành công !!!");
        } catch (\Exception $th) {
            dump($th->getMessage());
        }
    }

    public function getDelete(Request $request)
    {
        try {

            //    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim temporibus voluptatibus asperiores magnam sed doloribus eaque nisi et quaerat voluptatem! 
            $delete = Product::where('id', $request->id)->delete();
            // $a = Product::find($request->id)->image;
            // unlink($a);
            if ($delete) {
                return redirect()->route("product.getList")->with('thongbao', "Xóa thành công !!!");
            }
        } catch (\Exception $th) {
            dump($th->getMessage());
        }
    }
}