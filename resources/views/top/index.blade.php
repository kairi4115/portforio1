<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>
    /* 追加のスタイルはここに記述します */
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
      background-image: linear-gradient(to bottom right, #f2f2f2, #ffffff);
    }

    .menu-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    .menu-category {
      color: #FF0000;
      font-weight: bold;
      font-size: 24px;
      margin-bottom: 20px;
    }

    .menu-category hr {
      background-color: #FF0000;
      height: 2px;
      border: none;
      margin-top: 0;
      margin-bottom: 10px;
    }

    .menu-category .menu-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .menu-card {
      width: calc(33.33% - 20px);
      margin-bottom: 20px;
      margin-right: 20px;
      background-color: #ffffff;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
      border-radius: 6px;
      overflow: hidden;
    }

    .menu-card:hover {
      transform: translateY(-5px);
    }

    .menu-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .menu-card .card-body {
      padding: 20px;
    }

    .menu-card .card-title {
      font-weight: bold;
      color: #000000;
      font-size: 20px;
      margin-bottom: 10px;
    }

    .menu-card .card-price {
      float: right;
      color: #FF0000;
      font-size: 18px;
    }

    .menu-card hr {
      margin-top: 10px;
      margin-bottom: 10px;
      border-color: #000000;
    }

    .menu-card .card-text {
      margin-bottom: 0;
      color: #555555;
      font-size: 16px;
    }
  </style>
</head>
<body>
<div class="menu-container">
<a href="{{route('product.create') }}" class="btn btn-primary">商品を追加する</a>
  @foreach($categories as $category)
  <div class="menu-category">
    {{$category->name}}
    <hr>
    <div class="menu-row">
      @foreach(App\Models\Product::where('category_id',$category->id)->get() as $product)
      <div class="menu-card card">
        <a href="{{route('top.show',$product->id)}}">
        <img src="{{ asset('images') }}/{{ $product->image }}" class="card-img-top" alt="Product Image">
        </a>
        <div class="card-body">
          <h5 class="card-title">{{ $product->name }}</h5>
          <span class="card-price">{{ $product->price }} 円 + 税</span>
          <hr>
          <p class="card-text">{{ $product->description }}</p>
        </div>
      </div>
  
      @endforeach
    </div>
  </div>
  @endforeach
</div>
</body>
</html>
