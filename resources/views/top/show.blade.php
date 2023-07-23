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
      display: flex;
      flex-direction: column;
      align-items: center;
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
  </style>
</head>
<body>
  <div class="product-container">
    <div class="product-details">
      <img src="{{ asset('images') }}/{{ $product->image }}" alt="Product Image">
      <h1>{{ $product->name }}</h1>
      <p>{{ $product->description }}</p>
      <p class="price">Price: {{ $product->price }} 円 + 税</p>
      <!-- その他の詳細情報を表示するための要素を追加 -->
    </div>
  </div>
</body>
</html>
