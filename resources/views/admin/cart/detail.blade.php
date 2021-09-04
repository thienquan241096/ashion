@extends('admin/layout/index')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th>STT</th>
            <th scope="col">Mã sp</th>
            <th scope="col">Tên sản phẩm</th>
            <th>Giá</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detailCart as $detail)
        <tr>
            <th>{{$detail->id}}</th>
            <th scope="row">{{$detail->products->id}}</th>
            <td>
                {{$detail->products->product_name}}
            </td>
            <td>
                {{$detail->products->price}}
            </td>
            <td>
                <form action="{{ route('cart.postDelete', ['id'=>$detail->id]) }}" method="post">
                    @csrf
                    <input type="text" name="" hidden>
                    <button class="btn btn-danger" type="submit">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    @if(Session::has('thongbao'))
    <p class="alert alert-success">
        {{Session::get('thongbao')}}
    </p>
    @endif
</table>
@endsection
