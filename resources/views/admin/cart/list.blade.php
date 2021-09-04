@extends('admin/layout/index')
@section('title')
<title></title>
@section('content')
<div class="container-fluid">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                {{-- <th scope="col">Tên sản phẩm</th> --}}
                <th scope="col">Tên người mua</th>
                {{-- <th scope="col">Số lượng</th> --}}
                {{-- <th scope="col">Đơn giá</th> --}}
                {{-- <th scope="col">Tổng tiền</th> --}}
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listCart as $cart)
            <tr>
                <th scope="row">{{$cart->id}}</th>
                <td>{{$cart->users->name}}</td>
                <td>
                    <a name="" id="" class="btn btn-primary" href="{{ route('cart.getDetail', ['id'=>$cart->id]) }}"
                        role="button">Chi tiết giỏ hàng</a>
                </td>
                <td>
                    <form action="" method="post">
                        @csrf
                        <button class="btn btn-danger" type="submit">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        {{-- @if(Session::has('thongbao'))
    <p class="alert alert-success">
        {{Session::get('thongbao')}}
        </p>
        @endif --}}
    </table>
</div>
@endsection