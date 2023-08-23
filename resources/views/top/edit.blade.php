@extends('layouts.app')

@section('content')
<div class="recipe-edit-form">
    <form action="{{ route('top.updateAll', ['product' => $product->id]) }}" method="post" class="recipe-form">
        @csrf
        @method('PUT')
        
        <h2 class="form-title">レシピ編集</h2>
        
        @foreach ($recipeSteps as $index => $recipeStep)
        <div class="form-group">
            <label for="step{{ $index }}" class="step-label">作り方 {{ $index + 1 }}</label>
            <textarea class="form-control step-input" name="steps[{{ $index }}]" id="step{{ $index }}" placeholder="作り方を入力してください">{{ $recipeStep->step }}</textarea>
        </div>
        @endforeach
        
        <!-- 1つのフォーム内で編集を可能にするため、同じフォームの中に追加 -->
        <div class="form-group">
            <button type="submit" class="btn-update">作り方を更新</button>
        </div>
    </form>
</div>
@endsection
