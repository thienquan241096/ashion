@extends('admin/layout/index')
@section('title')
<title>Product List</title>
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800 float-left">Product list</h1>
    <p class="float-right"><a name="" id="" class="btn btn-primary" href="{{ route('product.getCreate') }}">Thêm
            mới</a>
    </p>
    <div class="clearfix"></div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary float-left">Product</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="dataTable_length"><label>Show <select
                                        name="dataTable_length" aria-controls="dataTable"
                                        class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries</label></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search"
                                        class="form-control form-control-sm keyword" name="keyword" placeholder=""
                                        aria-controls="dataTable"></label></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Thương hiệu</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Loại sản phẩm</th>
                                        <th scope="col">Highlight</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="tbody">
                                    @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">{{$product->id}}</th>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->brand}}</td>
                                        <td>{{$product->sale}}</td>
                                        <td>
                                            {{-- <img src="/upload/product/{{$product->image}}" width="100px" alt="">
                                            --}}

                                            <img src="{{ asset("storage/$product->image") }}" alt="" width="100px">
                                        </td>
                                        <td>
                                            {{$product->category->cate_name}}
                                        </td>
                                        <td>
                                            {{$product->highlight == 1 ? "Đang hot" : "Bình thường"}}
                                        </td>
                                        <td>
                                            <a name="" id="" class="btn btn-primary"
                                                href="{{ route('product.getEdit', ['id'=>$product->id]) }}"
                                                role="button">Sửa</a>
                                        </td>
                                        <td>
                                            <a name="" id="" class="btn btn-danger"
                                                href="{{ route('product.getDelete', ['id'=>$product->id]) }}"
                                                role="button">Xóa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1
                                to 10 of 57 entries</div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled" id="dataTable_previous"><a
                                            href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0"
                                            class="page-link">Previous</a></li>
                                    <li class="paginate_button page-item active"><a href="#" aria-controls="dataTable"
                                            data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                            data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                            data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                            data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                            data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable"
                                            data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                    <li class="paginate_button page-item next" id="dataTable_next"><a href="#"
                                            aria-controls="dataTable" data-dt-idx="7" tabindex="0"
                                            class="page-link">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    {{ $products->links('pagination::bootstrap-4') }}
    @if(Session::has('thongbao'))
    <p class="alert alert-success">
        {{Session::get('thongbao')}}
    </p>
    @endif
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.keyword').change(function (e) { 
            e.preventDefault();
            // alert(1);
            $.ajax({
                type: "GET",
                url: "/api/searchProd",
                data: {
                    keyword : $("[name='keyword']").val()
                },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    let outPut = "";
                    response.result.forEach(element => {
                        var img = element.image;
                        var hightLight = element.highlight == 1 ? "Đang hot" : "Bình thường";
                       outPut += `
                       <tr>
                                        <th scope="row">${element.id}</th>
                                        <td>${element.product_name}</td>
                                        <td>${element.brand}</td>
                                        <td>${element.sale}</td>
                                        <td>
                                            {{-- <img src="/upload/product/{{$product->image}}" width="100px" alt="">
                                            --}}

                                            <img src="/storage/${img}" alt="" width="100px">
                                        </td>
                                        <td>
                                            ${element.category.cate_name}
                                        </td>
                                        <td>
                                            ${hightLight}
                                        </td>
                                        <td>
                                            <a name="" id="" class="btn btn-primary"
                                                href="/admin/product/edit/${element.id}"
                                                role="button">Sửa</a>
                                        </td>
                                        <td>
                                            <a name="" id="" class="btn btn-danger"
                                                href="/admin/product/delete/${element.id}"
                                                role="button">Xóa</a>
                                        </td>
                                    </tr>
                       `;
                    });
                    $('.tbody').html(outPut);
                }
            });
        });
    });
</script>
@endsection