@extends('layout/index')
@section('content')
<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailCart as $detail)
                            <tr>
                                <td class="cart__product__item">
                                    <img src="/upload/product/{{ $detail->products->image }}" width="100px" alt="">
                                    <div class="cart__product__item__title">
                                        <h6>{{ $detail->products->product_name }}</h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price">$ {{ number_format((float) $detail->products->sale) }}</td>
                                <td class="cart__quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="{{ number_format((float) $detail->quantity) }}">
                                    </div>
                                </td>
                                <td class="cart__total">$
                                    {{ number_format((float) $detail->products->price * $detail->quantity) }}</td>
                                <td class="cart__close">
                                    <form action="{{ route('postDeleteProductByID', ['id' => $detail->products->id]) }}"
                                        method="post">
                                        @csrf
                                        {{-- <input type="text" value="{{$detail->products->id}}" hidden> --}}
                                        <button type="submit" class="btn"><span class="icon_close"></span></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn">
                    <a href="{{ route('shop') }}">Continue Shopping</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn update__btn">
                    <a href="#"><span class="icon_loading"></span> Update cart</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="discount__content">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Enter your coupon code">
                        <button type="submit" class="site-btn">Apply</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>$ 750.0</span></li>
                        <li>Total <span>$ 750.0</span></li>
                    </ul>
                    <a href="#" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
@if (Session::has('thongbao'))
<p class="alert alert-success text-center">
    {{ Session::get('thongbao') }}
</p>
@endif
<!-- Shop Cart Section End -->
@endsection