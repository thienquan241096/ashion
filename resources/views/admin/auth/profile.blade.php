@extends('admin/layout/index')
@section('title')
<title>Edit Profile</title>
@section('content')
<div class="container-fluid">
    <form action="" method="post">
        @csrf
        <div class="form-group">
            <label for="">Tên người dùng</label>
            <input type="text" name="name" id="" class="form-control" value="{{$infoUser->name}}">
            @error('name')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" id="" class="form-control" value="{{$infoUser->email}}" readonly>
            @error('email')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Số điện thoại</label>
            <input type="text" name="phone" id="" class="form-control" value="{{$infoUser->phone}}">
            @error('phone')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        @if(Session::has('thongbao'))
        <p class="alert alert-success">
            {{Session::get('thongbao')}}
        </p>
        @endif
    </form>
</div>
@endsection