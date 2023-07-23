<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Details</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <style>
    /* 追加のスタイルはここに記述します */
  </style>
</head>
<body>
  <div class="product-container">
    <div class="product-details">
      <img src="{{ asset('images') }}/{{ $product->image }}" alt="Product Image">
      <h1>{{ $product->name }}</h1>
      <p>{{ $product->description }}</p>
      <p>Price: {{ $product->price }} 円 + 税</p>
      <!-- その他の詳細情報を表示するための要素を追加 -->
    </div>
  </div>
</body>
</html>
