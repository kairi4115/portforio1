<?php

namespace App\Http\Controllers;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\RecipeStep;
use App\Models\Product;
use Illuminate\Http\Request;

class RecipeStepController extends Controller
{
    //
   
   public function store(Request $request, $productId)
   {

    $product = Product::findOrFail($productId);
    $request->validate([
        'step' => 'required|string|max:100',
    ]);

    $product->recipeSteps()->create([
        'step' => $request->input('step'),
    ]);
    return redirect()->route('top.show', ['product' => $product->id])->with('success', 'レシピのステップを投稿しました');

   }

   public function edit(Product $product)
   {
    return view('recipe.edit', compact('product'));
   }

   public function update(Request $request, $productId,$stepId)
   {
    $product = Product::findOrFail($productId);
    $recipeStep = RecipeStep::findOrFail($stepId);

    $request->validate([
        'step' => 'required|string|max:100',
    ]);

    $recipeStep->update([
        'step' => $request->input('step'),
    ]);

    return redirect()->route('top.show', ['product' => $product->id])->with('success', 'レシピのステップを更新しました。');
    
   }
}
