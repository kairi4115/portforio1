<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeStepController;
use App\Models\Category;
use App\Models\Product;
use App\Models\RecipeStep;
use Thujohn\Twitter\Twitter;


class TopController extends Controller
{
    //
    public function index(){
      $categories = Category::latest()->get();
      return view('top.index', ['categories' => $categories]);
    }

    

    public function show($id){
      $product = Product::with('recipeSteps')->findOrFail($id);
      return view('top.show',compact('product'));
    }

    public function store(Request $request, $productId)
    {
      $product = Product::findOrFail($productId);
      $request->validate([
        'step' => 'required|string|max:100',
      ]);

      $product->recipeSteps()->create([
        'step' => $request->input('step'),
      ]);
      return redirect()->route('top.show',['product' => $product->id])->with('success', 'レシピのステップを投稿しました');
    }

    public function edit(product $product){
      $recipeSteps = $product->recipeSteps;
      return view('top.edit' , compact('product', 'recipeSteps'));
    }

    public function updateAll(Request $request, $productId)
    {
      $product = Product::findOrFail($productId);
     
      $steps = $request->input('steps');

      foreach ($steps as $index => $step){
        $recipeStep = $product->recipeSteps->get($index);
        $recipeStep->update([
          'step' => $step,
        ]);
      }

      $product->update([
        'step' => $request->input('step')
      ]);

      return redirect()->route('top.show', ['id' => $product->id])->with('success','レシピを更新しました');

    }

    public function destroy(RecipeStep $step)
    {
      $step->delete();
      return redirect()->back()->with('success', 'レシピステップが削除されました。');
    }

   public function postImageToTwitter(Request $request, $productId)
   {
    $product = Product::find($productId);
    $tweetText = "新しいレシピを投稿しました!\n{$product->name}\n{$product->description}";

    $imagePath = public_path('images') . '/' . $product->image;

    try {
      $uploadedMedia = Twitter::uploadMedia(['media' => $imagePath]);
      $tweet = Twitter::postTweet(['status' => $tweetText, 'media_ids' => $uploadeMedia->media_id_string]);
      return redirect()->back()->with('success', 'twitterへの投稿に成功しました');
    }catch (\Exception $e) {
      return redirect()->back()->with('error', 'twitterへの投稿に失敗しました' . $e->getMessage());
    }
   }

}
   


