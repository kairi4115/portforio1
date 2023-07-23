@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 720px;">
    <div class="text-right">
        <a href="{{ url('/product/create') }}">＜戻る＞</a>
    </div>

    @if (session('message'))
    <div class="alert alert-success" role="alert">{{ session('message') }}</div>
    @endif

    <table class="table table-bordered mt-2">
        <thead class="table-dark">
            <tr>
                <th scope="col">
                    #
                </th>
                <th scope="col">
                    作成日
                </th>
                <th scope="col">
                    カテゴリー
                </th>
                <th scope="col">
                    編集
                </th>
                <th scope="col">
                    削除
                </th> 
            </tr>
        </thead>
        <tbody>
            @if (count($categories) > 0)
            @foreach ($categories as $key => $category)
            <tr>
                <th scope="row">
                    {{ $key + 1 }}
                </th>
                <td>
                    {{ $category->created_at->format('Y/m/d') }}
                </td>
                <td>
                    {{ $category->name }}
                </td>
                <td>
                    <a href="{{ route('category.edit', ['category' => $category->id]) }}">
                        <button type="button" class="btn btn-outline-danger">
                            <i class="far fa-edit"></i>編集
                        </button>
                    </a>
                </td>
               
<td>
 <!-- <button type="button" class="btn btn-outline-primary"><i class="far fa-trash-alt"></i> 削除</button> -->  //コメントアウト
 <!-- Button trigger modal -->
 <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$category->id}}"><i class="far fa-trash-alt"></i> 削除</button>  //変更

 <!-- Modal -->
 <div class="modal fade" id="exampleModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">  //変更
   <div class="modal-dialog" role="document">
     <form action="{{ route('category.destroy', [ 'category' => $category->id ]) }}" method="POST">  //追加
       @csrf  //追加
       @method('DELETE')  //追加
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">カテゴリー削除</h5>  //変更
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           本当に削除しますか？  //変更
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>  //変更
           <button type="submit" class="btn btn-primary">削除</button>  //変更
         </div>
       </div>
     </form>
   </div>
 </div>
</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5">追加されたカテゴリーはありません。</td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="my-4">
        <a href="{{ url('/category/create') }}">カテゴリー新規追加ページへ</a>
    </div>
</div>
@endsection