@extends('admin/layout/index')
@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Tên sản phẩm</th>
        <th scope="col">Thương hiệu</th>
        <th scope="col">Giá</th>
        <th scope="col">Ảnh</th>
        <th scope="col">Loại sản phẩm</th>
        <th scope="col">Highlight</th>
        {{-- <th></th>
        <th></th> --}}
      </tr>
    </thead>
    <tbody>
      @foreach ($productSearch as $product)
        <tr>
          <th scope="row">{{$product->id}}</th>
          <td>{{$product->product_name}}</td>
          <td>{{$product->brand}}</td>
          <td>{{$product->price}}</td>
          <td>
            <img src="/upload/product/{{$product->image}}" width="100px" alt="">
          </td>
          <td>
            {{$product->category->cate_name}}
          </td>
          <td>
            {{$product->highlight == 1 ? "Đang hot" : "Bình thường"}}
          </td>
          {{-- <td>
            <a name="" id="" class="btn btn-primary" href="{{ route('product.getEdit', ['id'=>$product->id]) }}" role="button">Sửa</a>
          </td>
          <td>
            <form action="{{ route('product.postDelete', ['id'=>$product->id]) }}" method="post">
              @csrf
              <button class="btn btn-danger" type="submit">Xóa</button>
            </form>
          </td> --}}
        </tr>
      @endforeach
    </tbody>
  </table>
    @if(Session::has('thongbao'))
        <p class="alert alert-success">
          {{Session::get('thongbao')}}
        </p>
    @endif
@endsection