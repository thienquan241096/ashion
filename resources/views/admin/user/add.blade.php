@extends('admin/layout/index')
@section('title')
<title>User Add</title>
@section('content')
<div class="container-fluid">
  <form action="{{ route('user.postCreate') }}" method="post">
    @csrf
    <div class="form-group">
      <label for="">Tên người dùng</label>
      <input type="text" name="name" id="" class="form-control" value="{{old('name')}}">
      @error('name')
      <p class="alert alert-danger">{{$message}}</p>
      @enderror
    </div>
    <div class="form-group">
      <label for="">Email</label>
      <input type="text" name="email" id="" class="form-control" value="{{old('email')}}">
      @error('email')
      <p class="alert alert-danger">{{$message}}</p>
      @enderror
    </div>
    <div class="form-group">
      <label for="">Password</label>
      <input type="text" name="password" id="" class="form-control" value="">
      @error('password')
      <p class="alert alert-danger">{{$message}}</p>
      @enderror
    </div>

    <div class="form-group">
      <label for="">Confirm Password</label>
      <input type="text" name="confirmPassword" id="" class="form-control" value="">
      @error('confirmPassword')
      <p class="alert alert-danger">{{$message}}</p>
      @enderror
    </div>

    <div class="form-group">
      <label for="">Số điện thoại</label>
      <input type="text" name="phone" id="" class="form-control" value="{{old('phone')}}">
      @error('phone')
      <p class="alert alert-danger">{{$message}}</p>
      @enderror
    </div>

    <div class="form-check">
      <label class="form-check-label">
        <input type="radio" class="form-check-input" name="type" id="" value="1" checked>
        Admin
      </label>
    </div>
    <div class="form-check">
      <label class="form-check-label">
        <input type="radio" class="form-check-input" name="type" id="" value="0">
        Người dùng
      </label>
    </div>

    <button type="submit" class="btn btn-primary">Thêm</button>
    @if(Session::has('thongbao'))
    <p class="alert alert-success">
      {{Session::get('thongbao')}}
    </p>
    @endif
  </form>
</div>
@endsection