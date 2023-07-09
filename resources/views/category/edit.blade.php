@extends('layouts.app')

@section('content')
<div class="container mt-3" style="max-width: 720px;">
<div class="text-right">
    <a href="{{ url('/product/create') }}">< 戻る</a>
</div>

<form action="{{ route('category.update', ['category' => $category->id ]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <lavel for="categoryAdd" class="font-weight-bold">カテゴリー編集</lavel>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="categoryAdd" name="name" value="{{ $category->name }}">
        @error('name')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">編集</button>
</form>

<div class="my-4">
    <a href="{{ url('/category/') }}">>一覧ページへ</a>
</div>
</div>
@endsection