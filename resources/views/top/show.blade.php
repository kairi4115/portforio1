<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@your_twitter_handle">
  <meta name="twitter:title" content="Product Details">
  <meta name="twitter:description" content="{{ $product->description }}">
  <meta name="twitter:image" content="{{ asset('images') }}/{{ $product->image }}">
  <title>Product Details</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <div class="product-container">
    <div class="product-details">
      <img src="{{ asset('images') }}/{{ $product->image }}" alt="Product Image">
      <h1>{{ $product->name }}</h1>
      <p>{{ $product->description }}</p>
      <p class="price">Price: {{ $product->price }} 円 + 税</p>

       <!-- Twitter投稿ボタン -->
       <a href="{{ route('product.tweet',['id' => $product->id]) }}">
          <i class="fab fa-twitter">ツイート</i> 
        </a>

      <div class="recipe-form">
        <form action="{{ route('recipe.steps.store', ['product' => $product->id]) }}" method="post">
          @csrf
          <div class="form-group">
            <label for="step">作り方</label>
            <textarea class="form-control" name="step" id="step" placeholder="作り方を入力してください"></textarea>
          </div>
          <button type="submit">作り方を投稿</button>
        </form>

       

        <a href="{{ route('top.edit', ['product' => $product->id]) }}" class="edit-button">編集</a>

        <!-- レシピのステップを表示 -->
        <div class="recipe-steps">
          <h2>作り方</h2>
          @if($product->recipeSteps->count() > 0)
            <ul>
              @foreach($product->recipeSteps as $step)
                <li class="centered-text">{{$step->step}}
                <form action="{{ route('top.steps.destroy', ['step' => $step->id]) }}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit">削除</button>
                </form>
              </li>
              @endforeach
            </ul>
          @else
            <p>レシピのステップはありません</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</body>
</html>
