<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function getList(Request $request)
    {
        if ($request->keyword != "") {
            $categoryQuery =  Category::where('cate_name', 'like', "%" . $request->keyword . "%")->get();
        } else {
            $categoryQuery =  Category::all();
        }

        $listCate = Category::all();
        return view('admin/category/list', [
            'listCate' => $listCate,
            'categoryQuery' => $categoryQuery
        ]);
    }

    public function getCreate()
    {
        return view('admin/category/add');
    }

    public function postCreate(CategoryFormRequest $request)
    {

        try {

            $model = new Category();
            $model->fill($request->all());
            if ($request->hasFile('image')) {
                $newFileName = uniqid() . '-' . $request->image->getClientOriginalName();
                $path = $request->image->storeAs('public/uploads/category', $newFileName);
                $model->image = str_replace('public/', '', $path);
                // dd($path);
            }
            $model->save();
            return redirect()->route('category.getCreate')->with('thongbao', "Thêm mới thành công !!!");
        } catch (\Exception $th) {
            dump($th->getMessage());
        }
    }

    public function getEdit(Request $request)
    {
        $cate = Category::where('id', $request->id)->first();
        return view('admin/category/edit', [
            'cate' => $cate
        ]);
    }

    public function postEdit(CategoryFormRequest $request)
    {
        $cate = Category::where('id', $request->id)->first();
        try {
            $model = Category::find($request->id);
            $model->fill($request->all());
            if ($request->hasFile('image')) {
                $newFileName = uniqid() . '-' . $request->image->getClientOriginalName();

                $path = $request->image->storeAs('public/uploads/category', $newFileName);
                $model->image = str_replace('public/', '', $path);
                // dd($path);
            }
            $model->save();
            return redirect()->route('category.getList')->with('thongbao', 'Sửa thành công !!!');
        } catch (\Exception $th) {
            dump($th->getMessage());
        }
    }

    public function getDelete(Request $request)
    {
        try {
            $deleteProd = Product::where('cate_id', $request->id)->delete();
            $delete = Category::where('id', $request->id)->delete();
            if ($delete) {
                return redirect()->route('category.getList')->with('thongbao', 'Xóa thành công !!!');
            }
        } catch (\Exception $th) {
            dump($th->getMessage());
        }
    }
}