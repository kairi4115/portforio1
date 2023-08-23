@extends('layouts.app')

@section('content')
<div class="recipe-edit-form">
    <form action="{{ route('recipe.steps.update', ['product' => $product->id, 'step' => $recipeStep->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <lavel for="step">作り方</lavel>
            <textarea class="form-control" name="step" id="step" placeholder="作り方を入力してください">{{ $recipeStep->step }}</textarea>
        </div>
        <button type="submit">作り方を更新</button>
    </form>
</div>
@endsection