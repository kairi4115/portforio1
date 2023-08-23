<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Details</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .product-container {
      max-width: 800px;
      margin: 50px auto;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      padding: 20px;
    }

    .product-details {
      text-align: center;
    }

    .product-details img {
      max-width: 100%;
      border-radius: 8px;
      margin-bottom: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .product-details h1 {
      font-size: 28px;
      margin-bottom: 10px;
      color: #333;
    }

    .product-details p {
      font-size: 16px;
      color: #666;
      line-height: 1.6;
      margin-bottom: 10px;
    }

    .product-details p:last-child {
      margin-bottom: 0;
    }

    .product-details p.price {
      font-size: 24px;
      font-weight: bold;
      color: #ff5722;
    }

    .recipe-form {
      margin-top: 40px;
      text-align: left;
    }

    .recipe-form label {
      font-size: 18px;
      font-weight: bold;
      color: #333;
    }

    .recipe-form textarea {
      width: 100%;
      height: 150px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
      padding: 10px;
      font-size: 16px;
      line-height: 1.6;
    }

    .recipe-form button {
      margin-top: 20px;
      background-color: #ff5722;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      font-size: 18px;
      cursor: pointer;
    }

    .recipe-form button:hover {
      background-color: #ff3d00;
    }
  </style>
</head>
<body>
  <div class="product-container">
    <div class="product-details">
      <img src="{{ asset('images') }}/{{ $product->image }}" alt="Product Image">
      <h1>{{ $product->name }}</h1>
      <p>{{ $product->description }}</p>
      <p class="price">Price: {{ $product->price }} 円 + 税</p>

      <div class="recipe-form">
        <form action="{{ route('recipe.steps.store', ['product' => $product->id]) }}" method="post">
          @csrf
          <div class="form-group">
            <label for="step">作り方</label>
            <textarea class="form-control" name="step" id="step" placeholder="作り方を入力してください"></textarea>
          </div>
          <button type="submit">作り方を投稿</button>
        </form>
      </div>

      <!-- レシピのステップを表示　-->
      <div class="recipe-steps">
  <h2>作り方</h2>
  @if($product->recipeSteps->count() > 0)
    <ul>
      @foreach($product->recipeSteps as $step)
        <li>{{$step->step}}</li>
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
