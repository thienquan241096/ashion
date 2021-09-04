@extends('layout/index')
@section('content')
<div class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="{{ route('postRegister') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="name" class="form-control form-control-user"
                                            id="exampleFirstName" placeholder="Name ...">
                                        @error('name')
                                        <p class="alert alert-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone" class="form-control form-control-user"
                                            id="exampleLastName" placeholder="Phone number ...">
                                        @error('phone')
                                        <p class="alert alert-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user"
                                        id="exampleInputEmail" placeholder="Email Address ...">
                                    @error('email')
                                    <p class="alert alert-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password ...">
                                    @error('password')
                                    <p class="alert alert-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" name="confirmPassword" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="confirmPassword ...">
                                    @error('confirmPassword')
                                    <p class="alert alert-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                                <a href="" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            @if(Session::has('thongbao'))
                            <p class="alert alert-success">
                                {{Session::get('thongbao')}}
                            </p>
                            @endif
                            <hr>
                            <div class="text-center">
                                <a class="small" href="">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection