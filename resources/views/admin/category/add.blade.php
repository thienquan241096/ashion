@extends('admin/layout/index')
@section('title')
<title>Category Add</title>
@section('content')
<div class="container-fluid">
    <form action="{{ route('category.postCreate') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Tên danh mục</label>
            <input type="text" name="cate_name" id="" class="form-control" value="{{old('cate_name')}}">
            @error('cate_name')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Ảnh đại diện</label>
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
        <button type="submit" class="btn btn-primary">Thêm</button>
        @if(Session::has('thongbao'))
        <p class="alert alert-success">
            {{Session::get('thongbao')}}
        </p>
        @endif
    </form>
</div>
@endsection