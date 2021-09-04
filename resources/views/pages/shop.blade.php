@extends('layout/index')
@section('title')
<title>Shop</title>
@section( 'content')
<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="shop__sidebar">
                    <div class="sidebar__categories">
                        <div class="section-title">
                            <h4>Categories</h4>
                        </div>
                        <div class="categories__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a class="allProd" data-toggle="collapse""
                                        >All</a>
                                    </div>
                                </div>
                                @foreach ($listCate as $cate)
                                    <div class=" card">
                                            <div class="card-heading">
                                                <a class="category" data-toggle="collapse" data-id="{{$cate->id}}"
                                                    data-target="#collapseTwo">{{$cate->cate_name}}</a>
                                            </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__filter">
                            <div class="section-title">
                                <h4>Khoảng giá</h4>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="priceMin" placeholder="Từ ...">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <p style="line-height: 33px;">---</p>
                                </div>
                                <div class="col-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="priceMax" placeholder="đến ...">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="button" name="" id="filter" class="btn btn-primary" btn-lg btn-block">Tìm
                                    kiếm</button>
                            </div>
                        </div>
                        {{-- <div class="sidebar__sizes">
                            <div class="section-title">
                                <h4>Shop by size</h4>
                            </div>
                            <div class="size__list">
                                <label for="xxs">
                                    xxs
                                    <input type="checkbox" id="xxs">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="xs">
                                    xs
                                    <input type="checkbox" id="xs">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="xss">
                                    xs-s
                                    <input type="checkbox" id="xss">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="s">
                                    s
                                    <input type="checkbox" id="s">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="m">
                                    m
                                    <input type="checkbox" id="m">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="ml">
                                    m-l
                                    <input type="checkbox" id="ml">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="l">
                                    l
                                    <input type="checkbox" id="l">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="xl">
                                    xl
                                    <input type="checkbox" id="xl">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__color">
                            <div class="section-title">
                                <h4>Shop by size</h4>
                            </div>
                            <div class="size__list color__list">
                                <label for="black">
                                    Blacks
                                    <input type="checkbox" id="black">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="whites">
                                    Whites
                                    <input type="checkbox" id="whites">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="reds">
                                    Reds
                                    <input type="checkbox" id="reds">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="greys">
                                    Greys
                                    <input type="checkbox" id="greys">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="blues">
                                    Blues
                                    <input type="checkbox" id="blues">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="beige">
                                    Beige Tones
                                    <input type="checkbox" id="beige">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="greens">
                                    Greens
                                    <input type="checkbox" id="greens">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="yellows">
                                    Yellows
                                    <input type="checkbox" id="yellows">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row listProd">
                        @foreach ($listProduct as $listPrd)
                        <div class="col-lg-4 col-md-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ asset("storage/$listPrd->image") }}"
                                    style="background-image: url('{{ asset("storage/$listPrd->ima1ge") }}');">
                                    <div class="label new">New</div>
                                    {{-- <ul class="product__hover">
                                        <li><a href="img/shop/shop-1.jpg" class="image-popup"><span
                                                    class="arrow_expand"></span></a></li>
                                        <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                        <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                    </ul> --}}
                                </div>
                                <div class="product__item__text">
                                    <h6>
                                        <a href="{{ route('getDetail', ['id'=>$listPrd->id]) }}">{{$listPrd->product_name}}
                                        </a>
                                    </h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">$ {{$listPrd->sale}}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $listProduct->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Shop Section End -->
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {

        $('.category').click(function(e) {
            e.preventDefault();
            // alert($(this).data('id'));
            var cate_id = $(this).data('id');
            $.ajax({
                type: "GET"
                , url: "/api/products"
                , data: {
                    cate_id: cate_id
                }
                , dataType: "json"
                , success: function(data) {
                    // console.log(data);
                    var listProd = "";
                    data.forEach(element => {
                        listProd += `
                        <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="storage/${element.image}"
                                style="background-image: url('storage/${element.image}');">
                                <div class="label new">New</div>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="/detail/${element.id}">${element.product_name}</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ ${element.sale}</div>
                            </div>
                        </div>
                    </div>`;
                    });
                    $('.listProd').html(listProd);
                }
            });

        });

        $('#filter').click(function (e) { 
            // alert($("[name='priceMin']").val());
            // alert($("[name='priceMax']").val());
            e.preventDefault();
               
            $.ajax({
                type: "POST",
                url: "/api/search",
                data: {
                    priceMin: $("[name='priceMin']").val(),
                    priceMax: $("[name='priceMax']").val()
                },
                dataType: "json",
                success: function (response) {
                    // console.log(response.result);
                    var listProd = "";
                    response.result.forEach(element => {
                        listProd += `
                        <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="storage/${element.image}"
                                style="background-image: url('storage/${element.image}');">
                                <div class="label new">New</div>
                                <ul class="product__hover">
                                    <li><a href="img/shop/shop-1.jpg" class="image-popup"><span
                                                class="arrow_expand"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="/detail/${element.id}">${element.product_name}</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ ${element.sale}</div>
                            </div>
                        </div>
                    </div>`;
                    });
                    $('.listProd').html(listProd);
                }
            });
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
                        <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="storage/${element.image}"
                                style="background-image: url('storage/${element.image}');">
                                <div class="label new">New</div>
                                // <ul class="product__hover">
                                //     <li><a href="img/shop/shop-1.jpg" class="image-popup"><span
                                //                 class="arrow_expand"></span></a></li>
                                //     <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                //     <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                // </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="/detail/${element.id}">${element.product_name}</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ ${element.sale}</div>
                            </div>
                        </div>
                    </div>`;
                    // console.log(listProd);
                    });
                    $('.listProd').html(listProd);
                    
                }
            });
        });

    });

</script>
@endsection