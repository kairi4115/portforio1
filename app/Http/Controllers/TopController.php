<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Models\Product;

class TopController extends Controller
{
    //
    public function index(){
      $categories = Category::latest()->get();
      return view('top.index', ['categories' => $categories]);
    }

    

    public function show($id){
      $product = Product::find($id);
      return view('top.show',compact('product'));
    }

}
