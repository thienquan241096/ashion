@extends('layout/index')
@section( 'content')
@if (Session::has('thongbao'))
<p class="alert alert-success text-center">
    {{ Session::get('thongbao') }}
</p>
@endif
<!-- Categories Section Begin -->
<section class="categories">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="categories__item categories__large__item set-bg"
                    data-setbg="{{ asset("storage/$category_first->image") }}">
                    <div class="categories__text">
                        <h1>{{$category_first->cate_name}}</h1>
                        <p>Sitamet, consectetur adipiscing elit, sed do eiusmod tempor incidid-unt labore
                            edolore magna aliquapendisse ultrices gravida.</p>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    @foreach ($category as $cate)
                    <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                        <div class="categories__item set-bg" data-setbg="{{ asset("storage/$cate->image") }}">
                            <div class="categories__text">
                                <h4>{{$cate->cate_name}}</h4>
                                <p>{{$cate->product_count}} items</p>
                                <a href="{{ route('shop') }}">Shop now</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>New product</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <ul class="filter__controls">
                    <li>
                        <a class="allProd" href="{{ route('home') }}">All</a>
                        {{-- {{ route('home') }} --}}
                    </li>
                    @foreach ($listCate as $cate)
                    <li>
                        <a class="category" data-id="{{$cate->id}}" href="{{ route('home', ['id'=> $cate->id ]) }}"
                            id="cate_{{$cate->id}}">
                            {{$cate->cate_name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row property__gallery">
            @foreach ($listProduct as $listPrd)
            <div class="col-lg-3 col-md-4 col-sm-6 mix">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset("storage/$listPrd->image") }}">
                        <ul class="product__hover">
                            <li><a href="{{ asset("storage/$listPrd->image") }}" class="image-popup"><span
                                        class="arrow_expand"></span></a></li>
                            {{-- <li><a href="#"><span class="icon_heart_alt"></span></a></li> --}}
                            {{-- <li><a href="#"><span class="icon_bag_alt"></span></a></li> --}}
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="{{ route('getDetail', ['id'=> $listPrd->id]) }}">{{$listPrd->product_name}}</a>
                        </h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">
                            <a href="{{ route('getDetail', ['id'=> $listPrd->id]) }}">{{$listPrd->sale}}$</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Banner Section Begin -->
<section class="banner set-bg" data-setbg="img/banner/banner-1.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-8 m-auto">
                <div class="banner__slider owl-carousel">
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Chloe Collection</span>
                            <h1>The Project Jacket</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Chloe Collection</span>
                            <h1>The Project Jacket</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                    <div class="banner__item">
                        <div class="banner__text">
                            <span>The Chloe Collection</span>
                            <h1>The Project Jacket</h1>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Trend Section Begin -->
<section class="trend spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Hot Trend</h4>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="{{ asset('img/trend/ht-1.jpg') }}" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Chain bucket bag</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="{{ asset('img/trend/ht-2.jpg') }}" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Pendant earrings</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="{{ asset('img/trend/ht-3.jpg') }}" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Cotton T-Shirt</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Best seller</h4>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="{{ asset('img/trend/bs-1.jpg') }}" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Cotton T-Shirt</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="{{ asset('img/trend/bs-2.jpg') }}" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Zip-pockets pebbled tote <br />briefcase</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="{{ asset('img/trend/bs-3.jpg') }}" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Round leather bag</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Feature</h4>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="{{ asset('img/trend/f-1.jpg') }}" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Bow wrap skirt</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="{{ asset('img/trend/f-2.jpg') }}" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Metallic earrings</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="{{ asset('img/trend/f-3.jpg') }}" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Flap cross-body bag</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Trend Section End -->

{{-- <section class="discount">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="discount__pic">
                        <img src="img/discount.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="discount__text">
                        <div class="discount__text__title">
                            <span>Discount</span>
                            <h2>Summer 2019</h2>
                            <h5><span>Sale</span> 50%</h5>
                        </div>
                        <div class="discount__countdown" id="countdown-time">
                            <div class="countdown__item">
                                <span>22</span>
                                <p>Days</p>
                            </div>
                            <div class="countdown__item">
                                <span>18</span>
                                <p>Hour</p>
                            </div>
                            <div class="countdown__item">
                                <span>46</span>
                                <p>Min</p>
                            </div>
                            <div class="countdown__item">
                                <span>05</span>
                                <p>Sec</p>
                            </div>
                        </div>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
<!-- Discount Section End -->

<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-car"></i>
                    <h6>Free Shipping</h6>
                    <p>For all oder over $99</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-money"></i>
                    <h6>Money Back Guarantee</h6>
                    <p>If good have Problems</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-support"></i>
                    <h6>Online Support 24/7</h6>
                    <p>Dedicated support</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-headphones"></i>
                    <h6>Payment Secure</h6>
                    <p>100% secure payment</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->


@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.category').click(function(e) {
            e.preventDefault();
            // bước 1 : khi click phải lấy cate_id 
            var cate_id = $(this).data('id'); 
            // bước 2 :  truyền cate_id lên api : /api/products?cate_id=?
            $.ajax({
                type: "GET"
                , url: "/api/products"
                , data: {
                    cate_id: cate_id
                }
                , dataType: "json"
                , success: function(response) {
                    console.log(response);
                    var outPut = ``;
                    response.forEach(element => {
                        let route = `/detail/${element.id}`;
                        // const product_id = element.id;
                        console.log(element);
                        // <img src='/upload/product/product-2.jpg'/>
                        outPut += `
                        <div class="col-lg-3 col-md-4 col-sm-6 mix women">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="storage/${element.image}" style="background-image:url('storage/${element.image}');">
                                    <div class="label new">New</div>
                                    <ul class="product__hover">
                                        <li><a href="${route}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="${route}">${element.product_name}</a></h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price"> ${element.sale} $</div>
                                </div>
                            </div>
                        </div>
                        `;
                    });
                    $('.property__gallery').html(outPut);;
                }
            });
            // console.log(cate_id);
        });

        $('.allProd').click(function (e) { 
            e.preventDefault();
            // alert(1);
            $.ajax({
                type: "GET",
                url: "/api/listProd",
                // data: "data",
                dataType: "json",
                success: function (data) {
                    console.log(data.result);
                    var listProd = "";
                    // data.result.forEach(element => {
                    //     console.log(element);
                    //     listProd += `${element.product_name}`
                    // });
                    data.result.forEach(element => {
                        listProd += `
                            <div class="col-lg-3 col-md-4 col-sm-6 mix">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="storage/${element.image}"
                                     style="background-image:url('/storage/${element.image}');">
                                        <ul class="product__hover">
                                            <li><a href="#" class="image-popup"><span
                                                        class="arrow_expand"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="/detail/${element.id}">${element.product_name}</a>
                                        </h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product__price">
                                            <a href="/detail/${element.id}">${element.sale}$</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                    // console.log(listProd);
                    });
                    $('.property__gallery').html(listProd);;
                    
                }
            });
        });
    });
</script>
@endsection