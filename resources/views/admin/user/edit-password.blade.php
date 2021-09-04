@extends('admin/layout/index')
@section('title')
<title>User edit passwoed</title>
@section('content')
<div class="container-fluid">
    <form action="{{ route('user.getEditPasword',['id'=>$user->id]) }}" method="post">
        @csrf
        <div class="form-group">
            <label for="">New Password</label>
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
        <button type="submit" class="btn btn-primary">Sửa</button>
        @if(Session::has('thongbao'))
        <p class="alert alert-success">
            {{Session::get('thongbao')}}
        </p>
        @endif
    </form>
</div>
@endsection