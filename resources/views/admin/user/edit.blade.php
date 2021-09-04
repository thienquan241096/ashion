@extends('admin/layout/index')
@section('title')
<title>User Edit</title>
@section('content')
<div class="container-fluid">
  <form action="{{ route('user.postEdit',['id'=>$user->id]) }}" method="post">
    @csrf
    <div class="form-group">
      <label for="">Tên người dùng</label>
      <input type="text" name="name" id="" class="form-control" value="{{$user->name}}">
      @error('name')
      <p class="alert alert-danger">{{$message}}</p>
      @enderror
    </div>
    <div class="form-group">
      <label for="">Email</label>
      <input type="text" name="email" id="" class="form-control" value="{{$user->email}}" readonly>
      @error('email')
      <p class="alert alert-danger">{{$message}}</p>
      @enderror
    </div>
    <div class="form-group">
      <label for="">Số điện thoại</label>
      <input type="text" name="phone" id="" class="form-control" value="{{$user->phone}}">
      @error('phone')
      <p class="alert alert-danger">{{$message}}</p>
      @enderror
    </div>
    <div class="form-check">
      <label class="form-check-label">
        <input type="radio" class="form-check-input" {{$user->type == 1 ? "checked" : "" }} name="type" id="" value="1">
        Admin
      </label>
    </div>
    <div class="form-check">
      <label class="form-check-label">
        <input type="radio" class="form-check-input" name="type" id="" value="0" {{$user->type == 0 ? "checked" : "" }}>
        Người dùng
      </label>
    </div>

    <button type="submit" class="btn btn-primary">Sửa</button>
    @if(Session::has('thongbao'))
    <p class="alert alert-success">
      {{Session::get('thongbao')}}
    </p>
    @endif
  </form>
</div>
@endsection