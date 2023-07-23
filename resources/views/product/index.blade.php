@extends('layouts.app')

@section('content')
<div class="container-fluid my-2">
    <div class="row m-2">
        <div class="col">
            <h3 class="font-weight-bold">ダッシュボード</h3>
        </div>
        <div class="col text-right">
            <a type="button" href="{{ url('/product/create/') }}" class="btn btn-primary text-right" role="button"><i class="fas fa-plus"></i></a>
        </div>
    </div>

    @if(session('message'))
    <div class="alert alert-succes" role="alert">{{ session('message') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">
                    #
                </th>
                <th scope="col">
                    画像
                </th>
                <th scope="col">
                    商品名
                </th>
                <th scope="col">
                    詳細
                </th>
                <th scope="col">
                    値段
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
            @if(count($products) > 0)
            @foreach($products as $key=>$product)
            <tr>
                <th scope="row">
                    {{ $key+1 }}
                </th>
                <td style="max-width: 200px;">
               <img src="{{asset('images')}}/{{$product->image}}" class="img-fluid">
            </td>
            <td>
               {{$product->name}}
            </td>
            <td style="max-width: 300px;">
               {{$product->description}}
            </td>
            <td>
               {{$product->price}} 円
            </td>
            <td>
              {{ $product->category->name}}
            </td>
            <td>
                <a href="{{route('product.edit',[$product->id])}}">
                <button type="button" class="btn btn-outline-danger"><i class="far fa-edit"></i> 編集</button>
                </a>
            </td>
            <td>
              <button type="button" class="btn btn-outline-primary" data-bs-toggl="modal" data-bs-target="#exampleModal{{$product->id}}"><i class="far fa-trash-alt"></i> 削除</button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('product.destroy', ['product' => $product->id ]) }}" method="POST">
                       @csrf 
                       @method('DELETE')
                       <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">カテゴリー削除</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>  
                        </button>
                       </div>
                       <div class="modal-body">
                        本当に削除しますか？
                       </div>
                       <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-primary">削除</button>
                       </div>
                    </form>
                </div>
              </div>
            </td>
            @endforeach
            @else 
            <tr>
                <td colspan="8">追加された商品情報はありません。</td>
            </tr>
            @endif
            </td>
            </tr>
        </tbody>

        <div class="d-flex">
            <div class="mx-auto">
                {{$products->links("pagination::bootstrap-4")}}
            </div>
        </div>
    </table>
</div>
@endsection