
@extends('layouts.app')

@section('content')
<div class="container mt-3" style="max-width: 720px;">
 <div class="text-right">
   <a href="{{ url('/product/') }}">＜ 戻る</a>
 </div>

 @if ( session('message') )
 <div class="alert alert-success" role="alert">{{ session('message') }}</div>
 @endif

 <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
   @csrf
   <div class="form-group" style="margin-top: 30px; margin-bottom: 30px">
     <label for="name" class="font-weight-bold">商品名</label>
     <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" />
     @error('name')
     <p class="text-danger">{{ $message }}</p>
     @enderror
   </div>
   <div class="form-group" style="margin-bottom: 30px">
     <label for="textarea" class="font-weight-bold">詳細</label>
     <textarea class="form-control @error('description') is-invalid @enderror" id="textarea" rows="5" name="description"></textarea>
     @error('description')
     <p class="text-danger">{{ $message }}</p>
     @enderror
   </div>
   <div class="form-group" style="margin-bottom: 30px">
     <label for="price" class="font-weight-bold">値段</label>
     <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" />
     <small class="form-text text-muted">半角数字で入力してください。</small>
     @error('price')
     <p class="text-danger">{{ $message }}</p>
     @enderror
   </div>
   <div class="form-group" style="margin-bottom: 30px">
     <label for="category" class="font-weight-bold">カテゴリー</label>
     <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
       <option value="" disabled selected style="display: none;">カテゴリーを選択してください。</option>
       @foreach(App\Models\Category::all() as $category)
       <option value="{{ $category->id }}">{{ $category->name }}</option>
       @endforeach
     </select>
     @error('category')
     <p class="text-danger">{{ $message }}</p>
     @enderror
     <div class="text-right mt-2">
       <a type="button" href="{{ url('/category/create/') }}" class="btn btn-outline-secondary py-1" role="button">新規追加</a>
       <a type="button" href="{{ url('/category/') }}" class="btn btn-outline-secondary py-1" role="button">編集</a>
     </div>
   </div>
   <div class="form-group" style="margin-bottom: 30px">
     <label for="image" class="font-weight-bold">画像アップロード</label>
     <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" />
     @error('image')
     <p class="text-danger">{{ $message }}</p>
     @enderror
   </div>

   <button type="submit" class="btn btn-primary my-3">送信</button>

 </form>
</div>
@endsection