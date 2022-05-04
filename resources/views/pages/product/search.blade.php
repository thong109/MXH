@extends('layout')
@section('content')

<?php
$message = Session::get('message');
if ($message) {
    echo "<script>alert('$message')</script>";
    Session::put('message', null);
}
$error = Session::get('error');
if ($error) {
    echo "<script>alert('$error')</script>";
    Session::put('error', null);
}
?>
 <!-- Popular Products -->
 <div class="page-slider margin-bottom-35">
    {{-- <div id="carousel-example-generic" class="carousel slide carousel-slider">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <!-- First slide -->
            @foreach ($banner as $banner)
                <div class="item carousel-item-four active">
                    <div class="container">
                        <div class="carousel-position-four text-center" style="position: absolute;z-index:1000">
                            <h2 class="margin-bottom-20 animate-delay carousel-title-v3 border-bottom-title text-uppercase"
                                data-animation="animated fadeInDown" style="margin-left: 50px">
                                {{ $banner->banner_name }}<br /><span
                                    class="color-red-v2">LJShop.vn</span><br />{{ $banner->banner_desc }}
                            </h2>
                            <p class="carousel-subtitle-v2" data-animation="animated fadeInUp">
                                {{ $banner->banner_content }}</p>
                        </div>
                    </div>
                    <img src="{{ URL::to('public/uploads/product/'.$banner->banner_image) }}" alt=""
                        style="height: 100%;width: 100%;position: absolute;z-index: 1;">
                </div>
            @endforeach
        </div>
    </div> --}}
    <!-- END SLIDER -->
    <div class="container">
        <div class="row margin-bottom-40 margin-top-40">
            <!-- BEGIN SIDEBAR -->
            <div class="sidebar col-md-3 col-sm-4">
                @foreach ($category as $cate)
                    <li class="list-group-item clearfix"><a
                            href="{{ URL::to('/product-by-category/' . $cate->category_id) }}"><i
                                class="fa fa-angle-right"></i>{{ $cate->category_name }}</a></li>
                @endforeach
                </ul>
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="col-md-9 col-sm-8">
                <h2>Có tất cả {{ count($search_product) }} sản phẩm</h2>
                <div class="owl-carousel owl-carousel3">
                    @foreach ($search_product as $pro)
                        <div>
                            <div class="product-item">
                                <div class="pi-img-wrapper cate-image-fa">
                                    <img src="{{ URL::to('public/uploads/product/' . $pro->product_image) }}"
                                        class="cate-image img-responsive" alt="{{ $cate->product_content }}">
                                    <div>
                                        <a href="{{ URL::to('public/uploads/product/' . $pro->product_image) }}"
                                            class="btn btn-default fancybox-button">Zoom</a>
                                            <a href="{{URL::to('add-wishlist/'.$pro->product_id)}}"class="btn btn-default fancybox-button">Like</a>
                                    </div>
                                </div>
                                <h3><a href="{{ URL::to('/chi-tiet-san-pham/' . $pro->product_slug) }}"
                                        class="thugon">{{ $pro->product_name }}</a></h3>
                                <input type="hidden" name="productid_hidden" value="{{ $pro->product_id }}">
                                <form action="">
                                    @csrf
                                    <input type="hidden" value="{{ $pro->product_id }}"
                                        class="cart_product_id_{{ $pro->product_id }}">
                                    <input type="hidden" id="wistlist_productname{{ $pro->product_id }}"
                                        value="{{ $pro->product_name }}"
                                        class="cart_product_name_{{ $pro->product_id }}">
                                    <input type="hidden" value="{{ $pro->product_image }}"
                                        class="cart_product_image_{{ $pro->product_id }}">
                                    <input type="hidden" value="{{ $pro->product_quantity }}"
                                        class="cart_product_quantity_{{ $pro->product_id }}">
                                    @php
                                        $pro->product_sale_after = $pro->product_price - ($pro->product_price * $pro->product_sale) / 100;
                                    @endphp
                                    <input type="hidden" id="wistlist_productprice{{ $pro->product_id }}"
                                        value="{{ $pro->product_sale_after }}"
                                        class="cart_product_sale_after_{{ $pro->product_id }}">
                                    <input type="hidden" class="cart_product_qty_{{ $pro->product_id }}"
                                        name="cart_product_quantity" min="1" oninput="validity.valid||(value='');"
                                        value="1">
                                    <input type="hidden" name="productid_hidden" value="{{ $pro->product_id }}">
                                </form>
                                <div class="pi-price">
                                    @if ($pro->product_sale)
                                        <span class="price">
                                            <div class="ml-3 d-flex">
                                                <span>{{ number_format($pro->product_sale_after) }}
                                                    VND</span>
                                            </div>
                                            <strike
                                                class="m-0-5 d-flex mausay">{{ number_format($pro->product_price) }}
                                                VND
                                            </strike>
                                        </span>
                                    @else
                                        <span class="price">{{ number_format($pro->product_price) }}
                                            VND</span>
                                    @endif
                                </div>
                                <a type="button" class="add-to-cart btn btn-default add2cart"
                                    data-id_product="{{ $pro->product_id }}" name="add-to-cart">Add to
                                    cart</a>
                                @if ($pro->product_sale)
                                    <div class="sticker sticker-sale"></div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>



@endsection
