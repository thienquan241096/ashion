<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
            aria-controls="collapseTwo">
            {{-- <i class="fas fa-fw fa-cog"></i> --}}
            <span>Category</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('category.getList') }}">Danh sách</a>
                <a class="collapse-item active" href="{{ route('category.getCreate') }}">Thêm mới</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="false" aria-controls="collapseUtilities">
            {{-- <i class="fas fa-fw fa-wrench"></i> --}}
            <span>Product</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar"
            style="">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('product.getList') }}">Danh sách</a>
                <a class="collapse-item" href="{{ route('product.getCreate') }}">Thêm mới</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false"
            aria-controls="collapsePages">
            {{-- <i class="fas fa-fw fa-folder"></i> --}}
            <span>User</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar"
            style="">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('user.getList')}}">Danh sách</a>
                <a class="collapse-item" href="{{route('user.getCreate')}}">Thêm mới</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link" href="{{route('cart.getList')}}">
            {{-- <i class="fas fa-fw fa-chart-area"></i> --}}
            <span>Cart</span></a>
    </li>

</ul>
<!-- End of Sidebar -->



{{-- <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand" href="{{route('admin')}}">Trang chủ</a>
<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
    aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
<div class="collapse navbar-collapse" id="collapsibleNavId">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('category.getList') }}">Category</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{route('product.getList')}}">Product</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{route('user.getList')}}">User</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{route('cart.getList')}}">Cart</a>
        </li>
        @if(Auth::user())
        <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">Thông tin</a>
            <div class="dropdown-menu" aria-labelledby="dropdownId">
                <a class="dropdown-item" href="#">Chào bạn : <span class="text-danger">{{Auth::user()->name}}</span></a>
                <a class="dropdown-item" href="#">Sửa thông tin</a>
                <form action="{{route('admin.postLogout')}}" class="" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">Đăng xuất</button>
                </form>
            </div>
        </li>
        @endif
    </ul>
    <form action="{{ route('admin.postSearch') }}" method="POST" class="form-inline my-2 my-lg-0">
        @csrf
        <input class="form-control mr-sm-2" type="text" name="search" class="search" placeholder="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
    </form>
</div>
</nav> --}}