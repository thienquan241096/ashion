@extends('layout/index')
@section('title')
<title>Product</title>
@section( 'content')
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__left product__thumb nice-scroll" tabindex="1"
                        style="overflow-y: hidden; outline: none;">
                        <a class="pt active" href="#product-1">
                            <img src="{{ asset("storage/$detailProduct->im  age") }}" alt="">
                        </a>
                        <a class="pt" href="#product-2">
                            <img src="{{ asset("storage/$detailProduct->image") }}" alt="">
                        </a>
                        <a class="pt" href="#product-3">
                            <img src="{{ asset("storage/$detailProduct->image") }}" alt="">
                        </a>
                        <a class="pt" href="#product-4">
                            <img src="{{ asset("storage/$detailProduct->image") }}" alt="">
                        </a>
                    </div>
                    <div class="product__details__slider__content">
                        <div class="product__details__pic__slider owl-carousel owl-loaded">
                            <div class="owl-stage-outer">
                                <div class="owl-stage"
                                    style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2073px;">
                                    <div class="owl-item active" style="width: 518.2px;"><img data-hash="product-1"
                                            class="product__big__img" src="{{ asset("storage/$detailProduct->image") }}"
                                            alt=""></div>
                                    <div class="owl-item" style="width: 518.2px;"><img data-hash="product-2"
                                            class="product__big__img" src="{{ asset("storage/$detailProduct->image") }}"
                                            alt=""></div>
                                    <div class="owl-item" style="width: 518.2px;"><img data-hash="product-3"
                                            class="product__big__img" src="{{ asset("storage/$detailProduct->image") }}"
                                            alt=""></div>
                                    <div class="owl-item" style="width: 518.2px;"><img data-hash="product-4"
                                            class="product__big__img" src="{{ asset("storage/$detailProduct->image") }}"
                                            alt=""></div>
                                </div>
                            </div>
                            <div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><i
                                        class="arrow_carrot-left"></i></button><button type="button" role="presentation"
                                    class="owl-next"><i class="arrow_carrot-right"></i></button></div>
                            <div class="owl-dots disabled"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product__details__text">
                    <h3>{{$detailProduct->product_name}}<span>Brand: {{$detailProduct->brand}}</span></h3>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <span>( 138 reviews )</span>
                    </div>
                    <div class="product__details__price">$ {{$detailProduct->sale}} <span>$
                            {{$detailProduct->price}}</span></div>
                    <p>{{$detailProduct->description}}</p>
                    <div class="product__details__button">
                        <form action="{{ route('postAddToCart') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$detailProduct->id}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Số lượng</label>
                                        <input type="number" class="form-control" name="quantity" min="1" step="1">
                                        {{-- @error('quantity')
                                        <span class="alert alert-danger">{{$message}}</span>
                                        @enderror --}}
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Cart_id</label>
                                        <input type="number" class="form-control" name="cart_id">
                                    </div>
                                </div> --}}
                            </div>
                            <button type="submit" class="btn btn-danger">Add to cart</button>
                        </form>
                    </div>
                    <div class="product__details__widget">
                        <ul>
                            <li>
                                <span>Availability:</span>
                                <div class="stock__checkbox">
                                    <label for="stockin">
                                        In Stock
                                        <input type="checkbox" id="stockin">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <span>Available color:</span>
                                <div class="color__checkbox">
                                    <label for="red">
                                        <input type="radio" name="color__radio" id="red" checked="">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="black">
                                        <input type="radio" name="color__radio" id="black">
                                        <span class="checkmark black-bg"></span>
                                    </label>
                                    <label for="grey">
                                        <input type="radio" name="color__radio" id="grey">
                                        <span class="checkmark grey-bg"></span>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <span>Available size:</span>
                                <div class="size__btn">
                                    <label for="xs-btn" class="active">
                                        <input type="radio" id="xs-btn">
                                        xs
                                    </label>
                                    <label for="s-btn">
                                        <input type="radio" id="s-btn">
                                        s
                                    </label>
                                    <label for="m-btn">
                                        <input type="radio" id="m-btn">
                                        m
                                    </label>
                                    <label for="l-btn">
                                        <input type="radio" id="l-btn">
                                        l
                                    </label>
                                </div>
                            </li>
                            <li>
                                <span>Promotions:</span>
                                <p>Free shipping</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( 2 )</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <h6>Description</h6>
                            <p>{{$detailProduct->description}}</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                quis, sem.</p>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <h6>Specification</h6>
                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                consequat massa quis enim.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                quis, sem.</p>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <h6>Reviews ( 2 )</h6>
                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                consequat massa quis enim.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                quis, sem.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="related__title">
                    <h5>{{$detailProduct->name}}</h5>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection