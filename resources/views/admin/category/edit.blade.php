@extends('admin/layout/index')
@section('title')
<title>Category Edit</title>
@section('content')
<div class="container-fluid">
    <form action="{{ route('category.postEdit',[$cate->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Tên danh mục</label>
            <input type="text" name="cate_name" id="" class="form-control" value="{{$cate->cate_name}}">
            @error('cate_name')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Ảnh</label>
            <input type="file" name="image" id="" class="form-control">
            <p>
                <img src="/upload/category/{{$cate->image}}" width="100px" alt="">
            </p>
        </div>
        @error('image')
        <p class="alert alert-danger">{{$message}}</p>
        @enderror
        <button type="submit" class="btn btn-primary">Sửa</button>
        @if(Session::has('thongbao'))
        <p class="alert alert-success">
            {{Session::get('thongbao')}}
        </p>
        @endif
    </form>
</div>
@endsection