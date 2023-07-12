<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return view('product.index');
        $products = Product::latest()->paginate(5);
        return view('product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        request()->validate(
            ['name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'category' => 'required',
            'image'=> 'required|mimes:jpeg,png,jpg,git,svg'],
            ['name.required'=> '商品名を入力してください。',
            'description.required' => '詳細を入力してください。',
            'price.required' => '値段を入力してください。',
            'category.required'=> 'カテゴリーを入力してください。',
            'image.required' => '画像を選択してください。']
        );

        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath,$name);

        product::create([
            'name' =>request('name'),
            'description' => request('description'),
            'price' => request('price'),
            'category_id' =>request('category'),
            'image'=>$name
        ]);

        return redirect()->back()->with('message', '商品情報が追加されました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::find($id);
        return view('product.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'category' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg'],

            ['name.required' => '商品を入力してください',
             'description' => '詳細を入力してください',
            'price.required' => '値段を入力してください',
            'category.reuired' => 'カテゴリーを入力してください。'
        ]);
        
         $product =Product::find($id);
         $name = $product->image;
         if($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->move($destinationPath,$name);
         }

          $product->update([
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price'),
            'category_id' =>request('category'),
            'image' => $name
          ]);

          return redirect()->route('product.index')->with('message', '商品情報が更新されました');
    }

     
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = product::find($id);
        $product->delete();
        return redirect('product')->with('message', '商品情報が削除されました');  
    }
}
