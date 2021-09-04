<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //


    public function index()
    {
        # code...
        return view('admin.layout.index');
    }

    // public function __construct()
    // {
    //     $this->login();
    // }

    // public function login()
    // {
    //     if (Auth::check()) {
    //         $inforUser = Auth::user();
    //         dump($inforUser);
    //         die;
    //         view()->share('inforUser', $inforUser);
    //     }
    // }

    public function postSearch(Request $request)
    {
        $search = $request->search;

        $productSearch = Product::where('product_name', "like", "%$search%")
            ->orWhere('price', ">", "$search")->orderBy('id', 'ASC')->get();
        // dump($productSearch);

        return view('admin/search/search', [
            'productSearch' => $productSearch
        ]);
    }
}