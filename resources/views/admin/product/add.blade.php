@extends('admin/layout/index')
@section('title')
<title>Product Add</title>
@section('content')
<div class="container-fluid">
    <form action="{{ route('product.postCreate') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Tên sản phẩm</label>
            <input type="text" name="product_name" id="" class="form-control" value="{{old('product_name')}}">
        </div>
        @error('product_name')
        <p class="alert alert-danger">{{$message}}</p>
        @enderror

        <div class="form-group">
            <label for="">Thương hiệu</label>
            <input type="text" name="brand" id="" class="form-control" value="{{old('brand')}}">
        </div>
        @error('brand')
        <p class="alert alert-danger">{{$message}}</p>
        @enderror

        <div class="form-group">
            <label for="">Giá tiền</label>
            <input type="text" name="price" id="" class="form-control" value="{{old('price')}}">
        </div>
        @error('price')
        <p class="alert alert-danger">{{$message}}</p>
        @enderror

        <div class="form-group">
            <label for="">Giảm giá</label>
            <input type="text" name="sale" id="" class="form-control" value="{{old('sale')}}">
        </div>
        @error('sale')
        <p class="alert alert-danger">{{$message}}</p>
        @enderror

        <div class="form-group">
            <label for="">Size</label>
            <input type="text" name="size" id="" class="form-control" value="{{old('size')}}">
        </div>
        @error('size')
        <p class="alert alert-danger">{{$message}}</p>
        @enderror

        <div class="form-group">
            <label for="">Màu sắc</label>
            <input type="color" name="color" id="" class="form-control" value="{{old('color')}}">
        </div>
        @error('color')
        <p class="alert alert-danger">{{$message}}</p>
        @enderror

        <div class="form-group">
            <label for="">Ảnh</label>
            <input type="file" name="image" id="image" class="form-control">
            <img id="blah" src="" width="100px" class="mt-2" />
        </div>
        <script>
            function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#blah').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]); // convert to base64 string
                    }
                }

                $(document).ready(function() {
                    $("#image").change(function(e) {
                        readURL(this);
                        console.log(this.files);
                    });
                });

        </script>
        @error('image')
        <p class="alert alert-danger">{{$message}}</p>
        @enderror


        <div class="form-group">
            <label for="">Mô tả</label>
            <textarea class="form-control" name="description" id="" rows="3"> {{old('description')}}</textarea>
        </div>
        @error('description')
        <p class="alert alert-danger">{{$message}}</p>
        @enderror

        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" name="highlight" id="" type="radio" checked value="1">
                Đang hot
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" name="highlight" id="" type="radio" value="0">
                Bình thường
            </label>
        </div>

        <div class="form-group">
            <label for=""></label>
            <select class="form-control" name="cate_id" id="">
                @foreach ($cate as $cate)
                <option value="{{$cate->id}}"> {{$cate->cate_name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
</div>

@endsection