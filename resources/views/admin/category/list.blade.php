@extends('admin/layout/index')
@section('title')
<title>Category List</title>
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 float-left">Category list</h1>
    <p class="float-right"><a name="" id="" class="btn btn-primary" href="{{ route('category.getCreate') }}">Thêm
            mới</a>
    </p>
    <div class="clearfix"></div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary float-left">Category</h6>

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
                            <div id="dataTable_filter" class="dataTables_filter">
                                {{-- <form action="" method="get"> --}}
                                <label>Search:<input type="text" name="keyword"
                                        class="form-control form-control-sm keyword" placeholder=""
                                        aria-controls="dataTable">
                                </label>
                                {{-- <button type="submit" class="btn btn-primary">Tìm</button> --}}
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th>STT</th>
                                        <th>Tên danh mục</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody">
                                    @foreach ($categoryQuery as $listCate)
                                    <tr>
                                        <th scope="row">{{$listCate->id}}</th>
                                        <td>{{$listCate->cate_name}}</td>
                                        <td>
                                            <a name="" id="" class="btn btn-primary"
                                                href="{{route('category.getEdit',[$listCate->id])}}"
                                                role="button">Sửa</a>
                                        </td>
                                        <td>
                                            <a name="" id="" class="btn btn-danger"
                                                href="{{route('category.getDelete',[$listCate->id])}}"
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
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.keyword').change(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: "/api/searchCate",
                data: {
                    keyword : $("[name='keyword']").val()
                },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    let outPut = "";
                    response.result.forEach(element => {
                       outPut += `
                       <tr>
                                        <th scope="row">${element.id}</th>
                                        <td>${element.cate_name}</td>
                                        <td>
                                            <a name="" id="" class="btn btn-primary"
                                                href="/admin/category/edit/${element.id}"
                                                role="button">Sửa</a>
                                        </td>
                                        <td>
                                            <a name="" id="" class="btn btn-danger"
                                                href="/admin/category/delete/${element.id}"
                                                role="button">Xóa</a>
                                        </td>
                        </tr>`;
                    });
                    $('.tbody').html(outPut);
                }
            });
        });
    });
</script>
@endsection