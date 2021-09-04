@extends('admin/layout/index')
@section('title')
<title>User List</title>
@section('content')
<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800 float-left">User list</h1>
  <p class="float-right"><a name="" id="" class="btn btn-primary" href="{{ route('user.getCreate') }}">Thêm
      mới</a>
  </p>
  <div class="clearfix"></div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header">
      <h6 class="m-0 font-weight-bold text-primary float-left">User</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length"
                    aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select> entries</label></div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" name="keyword"
                    class="form-control form-control-sm keyword" placeholder="" aria-controls="dataTable"></label></div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid"
                aria-describedby="dataTable_info" style="width: 100%;">
                <thead>
                  <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Sđt</th>
                    <th scope="col">Quyền</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody class="tbody">
                  @foreach ($user as $user)
                  <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone }}</td>
                    <td>{{$user->type == 1 ? "Admin" : "Khách hàng" }}</td>
                    <td>
                      <a name="" class="btn btn-primary" href="{{ route('user.getEdit', ['id'=>$user->id]) }}"
                        role="button">Sửa thông tin
                      </a>

                      <a name="" class="btn btn-success" href="{{ route('user.getEditPasword', ['id'=>$user->id]) }}"
                        role="button">Sửa mật khẩu
                      </a>
                    </td>
                    <td>
                      <form action="{{ route('user.postDelete', ['id'=>$user->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-danger" type="submit">Xóa</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
            $.ajax({
                type: "GET",
                url: "/api/searchUser",
                data: {
                    keyword : $("[name='keyword']").val()
                },
                dataType: "json",
                success: function (response) {
                    console.log(response.result);
                    let outPut = "";
                    response.result.forEach(element => {
                      let roles = element.type == 1 ? 'Admin' : 'Khách hàng';
                       outPut += `
                       <tr>
                    <th scope="row">${element.id}</th>
                    <td>${element.name}</td>
                    <td>${element.email}</td>
                    <td>${element.phone}</td>
                    <td>${roles}</td>
                    <td>
                      <a name="" class="btn btn-primary" href="edit-profile/${element.id}"
                        role="button">Sửa thông tin
                      </a>

                      <a name="" class="btn btn-success" href="edit-password/${element.id}"
                        role="button">Sửa mật khẩu
                      </a>
                    </td>
                    <td>
                      <form action="delete/${element.id}" method="post">
                        @csrf
                        <button class="btn btn-danger" type="submit">Xóa</button>
                      </form>
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