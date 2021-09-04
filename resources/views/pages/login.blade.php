@extends('layout/index')
@section('title')
<title>Login</title>
@section('content')
{{-- <div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
        </div>

        <!-- Login Form -->
        <form action="{{ route('postLogin') }}" method="post">
@csrf
<input type="text" id="login" class="fadeIn second" name="email" placeholder="Email...">
@error('email')
<p class="alert alert-danger">{{$message}}</p>
@enderror

<input type="password" id="password" class="fadeIn third form-control" name="password" placeholder="Password...">
@error('password')
<p class="alert alert-danger">{{$message}}</p>
@enderror
<input type="submit" class="fadeIn fourth" value="Đăng nhập">
</form>
@if (Session::has('thongbao'))
<p class="alert alert-success">
    {{ Session::get('thongbao') }}
</p>
@endif
<!-- Remind Passowrd -->
<div id="formFooter">
    <a class="underlineHover" href="#">Forgot Password?</a>
</div>

</div>
</div> --}}

<div class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="{{ route('postLogin') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        @error('email')
                                        <p class="alert alert-danger">{{$message}}</p>
                                        @enderror
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Password">
                                        </div>
                                        @error('password')
                                        <p class="alert alert-danger">{{$message}}</p>
                                        @enderror
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                        <hr>
                                        <a href="" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('getRegister') }}">Create an
                                            Account!</a>
                                    </div>
                                </div>
                                @if (Session::has('thongbao'))
                                <p class="alert alert-success">
                                    {{ Session::get('thongbao') }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection