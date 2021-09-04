<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-lg-2">
            <div class="header__logo">
                <a href="{{ route('home') }}"><img src="img/logo.png" alt=""></a>
            </div>
        </div>
        <div class="col-xl-6 col-lg-7">
            <nav class="header__menu">
                <ul>
                    <li class="active"><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                    <li><a href="#">Pages</a>
                        <ul class="dropdown">
                            {{-- <li><a href="">Product Details</a></li> --}}
                            <li><a href="{{ route('getCart') }}">Shop Cart</a></li>
                            <li><a href="{{ route('checkOut') }}">Checkout</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </nav>
        </div>
        @if (Auth::user())
        <div class="col-lg-3">
            <div class="header__right">
                <div class="header__right__auth">
                    <a href="">Chào bạn {{ Auth::user()->name }}</a>
                    <form action="{{ route('postLogout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn">Logout</button>
                    </form>
                </div>
                <ul class="header__right__widget">
                    <li><span class="icon_search search-switch"></span></li>
                    {{-- <li>
                        <a href="#"><span class="icon_heart_alt"></span>
                            <div class="tip">0</div>
                        </a>
                    </li> --}}
                    <li><a href="{{ route('getCart') }}"><span class="icon_bag_alt"></span>
                            <div class="tip" id="tip" data-user="{{ Auth::user()->id }}">

                            </div>
                        </a></li>
                </ul>
            </div>
        </div>
        @else
        <div class="col-lg-3">
            <div class="header__right">
                <div class="header__right__auth">
                    <a href="{{ route('getLogin') }}">Login</a>
                    <a href="{{ route('getRegister') }}">Register</a>
                </div>
                <ul class="header__right__widget">
                    <li><span class="icon_search search-switch"></span></li>
                    {{-- <li>
                        <a href="#"><span class="icon_heart_alt"></span>
                            <div class="tip"></div>
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('getCart') }}"><span class="icon_bag_alt"></span>
                            <div class="tip">0</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        @endif
    </div>
    <div class="canvas__open">
        <i class="fa fa-bars"></i>
    </div>
</div>
<script>
    $(document).ready(function () {
        var user_id = $("#tip").data('user');
        $.ajax({
            type: "GET",
            url: "/api/count", 
            data: {
                user_id : user_id
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('#tip').html(data.count);
            }
        });
    });
</script>