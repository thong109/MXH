@extends('layout')
@section('content')
    <!-- Wrap -->
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
    <div id="wrap">
        <!-- BEGIN SLIDER -->
        <div class="page-slider">
            <div id="carousel-example-generic" class="carousel slide carousel-slider">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <!-- First slide -->
                    @foreach ($banner as $banner)
                        <div class="item carousel-item-four active">
                            <div class="container">
                                <div class="carousel-position-four text-center" style="position: absolute;z-index:1000;right:0;left:0">
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
            </div>
            <!-- END SLIDER -->

            {{-- Product --}}
            <div class="main" style="margin-top:50px">
                <div class="container">
                    <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
                    <div class="row margin-bottom-40">
                        <!-- BEGIN SALE PRODUCT -->
                        <div class="col-md-12 sale-product">
                            <h2>{{ __('Product') }}</h2>
                            <div class="owl-carousel owl-carousel5">
                                @foreach ($all_product as $product)
                                    <div>
                                        <div class="product-item">
                                            <div class="pi-img-wrapper">
                                                <img src="{{ URL::to('public/uploads/product/' . $product->product_image) }}"
                                                    class="img-responsive" alt="{{ $product->product_content }}"
                                                    style="width: 194px;height:194px">
                                                <div>
                                                    <a href="{{ URL::to('public/uploads/product/' . $product->product_image) }}"
                                                        class="btn btn-default fancybox-button">Zoom</a>
                                                    {{-- <a type="button" data-toggle="modal" data-target="#xemnhanh"
                                                        data-href="#xemnhanh" class="btn btn-default xemnhanh"
                                                        data-id_product="{{ $product->product_id }}">View</a> --}}
                                                    <a href="{{URL::to('add-wishlist/'.$product->product_id)}}"class="btn btn-default fancybox-button">Like</a>
                                                </div>
                                            </div>
                                            <h3><a
                                                    href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                            </h3>
                                            <input type="hidden" name="productid_hidden"
                                                value="{{ $product->product_id }}">
                                            <form action="">
                                                @csrf
                                                <input type="hidden" value="{{ $product->product_id }}"
                                                    class="cart_product_id_{{ $product->product_id }}">
                                                <input type="hidden" id="wistlist_productname{{ $product->product_id }}"
                                                    value="{{ $product->product_name }}"
                                                    class="cart_product_name_{{ $product->product_id }}">
                                                <input type="hidden" value="{{ $product->product_image }}"
                                                    class="cart_product_image_{{ $product->product_id }}">
                                                <input type="hidden" value="{{ $product->product_quantity }}"
                                                    class="cart_product_quantity_{{ $product->product_id }}">
                                                @php
                                                    $product->product_sale_after = $product->product_price - ($product->product_price * $product->product_sale) / 100;
                                                @endphp
                                                <input type="hidden" id="wistlist_productprice{{ $product->product_id }}"
                                                    value="{{ $product->product_sale_after }}"
                                                    class="cart_product_sale_after_{{ $product->product_id }}">
                                                <input type="hidden" class="cart_product_qty_{{ $product->product_id }}"
                                                    name="cart_product_quantity" min="1"
                                                    oninput="validity.valid||(value='');" value="1">
                                                <input type="hidden" name="productid_hidden"
                                                    value="{{ $product->product_id }}">
                                            </form>
                                            <div class="pi-price">
                                                @if ($product->product_sale)
                                                    <span class="price">
                                                        <div class="ml-3 d-flex">
                                                            <span>{{ number_format($product->product_sale_after) }}
                                                                VND</span>
                                                        </div>
                                                        <strike
                                                            class="m-0-5 d-flex mausay">{{ number_format($product->product_price) }}
                                                            VND
                                                        </strike>
                                                    </span>
                                                @else
                                                    <span
                                                        class="price">{{ number_format($product->product_price) }}
                                                        VND</span>
                                                @endif
                                            </div>
                                            <?php if($product->product_quantity > 0){ ?>
                                                <a type="button" class="add-to-cart btn btn-default add2cart"
                                                data-id_product="{{ $product->product_id }}" name="add-to-cart">{{ __('AddToCart') }}</a>
                                            <?php } else { ?>
                                                <a href="javascript:;" class="btn btn-default add1cart">{{ __('SoldOff') }}</a>
                                            <?php } ?>
                                            @if ($product->product_sale)
                                                <div class="sticker sticker-sale"></div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- END SALE PRODUCT -->
                    </div>
                    <!-- END SALE PRODUCT & NEW ARRIVALS -->

                    {{-- model --}}
                    <div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="">
                        <div class="modal-dialog" role="document" style="max-width:700px;width:100%">
                            <div class="modal-content">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-3">
                                        <div class="product-main-image">
                                            <span id="product_quickview_image" class="hinhanh"></span>
                                        </div>
                                        <div class="product-other-images">
                                            <span id="product_quickview_gallery" class="hinhanh"
                                                style="display: flex;height: 100px;"></span>
                                        </div>
                                    </div>
                                    <form action="">
                                        @csrf
                                        <div id="product_quickview_value"></div>
                                        <div class="col-md-6 col-sm-6 col-xs-9" style="margin-top: 20px;margin-left:-15px">
                                            <h2 id="product_quickview_title"></h2>
                                            <div class="price-availability-block clearfix">
                                                <div class="price">
                                                    <strong id="product_quickview_price"></strong>
                                                </div>
                                            </div>
                                            <div class="product-page-cart">
                                                <div class="product-quantity">
                                                    <input type="number" name="qty" min="1" class="cart_product_qty_"
                                                        value="1" readonly>
                                                </div>
                                                <div id="product_quickview_button"></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- MOdel --}}
                    <!-- BEGIN SIDEBAR & CONTENT -->
                    <div class="row margin-bottom-40 ">
                        <!-- BEGIN SIDEBAR -->
                        <div class="sidebar col-md-3 col-sm-4">
                            <h2>{{ __('Brand') }}</h2>
                            @foreach ($category as $cate)
                                <li class="list-group-item clearfix"><a
                                        href="{{ URL::to('/product-by-category/' . $cate->category_id) }}"><i
                                            class="fa fa-angle-right"></i>{{ $cate->category_name }}</a></li>
                            @endforeach
                        </div>
                        <!-- END SIDEBAR -->
                        <!-- BEGIN CONTENT -->
                        <div class="col-md-9 col-sm-8">
                            <h2>{{ __('Sale') }}</h2>
                            <div class="owl-carousel owl-carousel3">
                                @foreach ($all_product_sale as $product)
                                <div>
                                    <div class="product-item">
                                        <div class="pi-img-wrapper">
                                            <img src="{{ URL::to('public/uploads/product/' . $product->product_image) }}"
                                                class="img-responsive" alt="{{ $product->product_content }}"
                                                style="width: 194px;height:194px">
                                            <div>
                                                <a href="{{ URL::to('public/uploads/product/' . $product->product_image) }}"
                                                    class="btn btn-default fancybox-button">Zoom</a>
                                                {{-- <a type="button" data-toggle="modal" data-target="#xemnhanh"
                                                    data-href="#xemnhanh" class="btn btn-default xemnhanh"
                                                    data-id_product="{{ $product->product_id }}">View</a> --}}
                                                <a href="{{URL::to('add-wishlist/'.$product->product_id)}}"class="btn btn-default fancybox-button">Like</a>
                                            </div>
                                        </div>
                                        <h3><a
                                                href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                        </h3>
                                        <input type="hidden" name="productid_hidden"
                                            value="{{ $product->product_id }}">
                                        <form action="">
                                            @csrf
                                            <input type="hidden" value="{{ $product->product_id }}"
                                                class="cart_product_id_{{ $product->product_id }}">
                                            <input type="hidden" id="wistlist_productname{{ $product->product_id }}"
                                                value="{{ $product->product_name }}"
                                                class="cart_product_name_{{ $product->product_id }}">
                                            <input type="hidden" value="{{ $product->product_image }}"
                                                class="cart_product_image_{{ $product->product_id }}">
                                            <input type="hidden" value="{{ $product->product_quantity }}"
                                                class="cart_product_quantity_{{ $product->product_id }}">
                                            @php
                                                $product->product_sale_after = $product->product_price - ($product->product_price * $product->product_sale) / 100;
                                            @endphp
                                            <input type="hidden" id="wistlist_productprice{{ $product->product_id }}"
                                                value="{{ $product->product_sale_after }}"
                                                class="cart_product_sale_after_{{ $product->product_id }}">
                                            <input type="hidden" class="cart_product_qty_{{ $product->product_id }}"
                                                name="cart_product_quantity" min="1"
                                                oninput="validity.valid||(value='');" value="1">
                                            <input type="hidden" name="productid_hidden"
                                                value="{{ $product->product_id }}">
                                        </form>
                                        <div class="pi-price">
                                            @if ($product->product_sale)
                                                <span class="price">
                                                    <div class="ml-3 d-flex">
                                                        <span>{{ number_format($product->product_sale_after) }}
                                                            VND</span>
                                                    </div>
                                                    <strike
                                                        class="m-0-5 d-flex mausay">{{ number_format($product->product_price) }}
                                                        VND
                                                    </strike>
                                                </span>
                                            @else
                                                <span
                                                    class="price">{{ number_format($product->product_price) }}
                                                    VND</span>
                                            @endif
                                        </div>
                                        <?php if($product->product_quantity > 0){ ?>
                                            <a type="button" class="add-to-cart btn btn-default add2cart"
                                            data-id_product="{{ $product->product_id }}" name="add-to-cart">{{ __('AddToCart') }}</a>
                                        <?php } else { ?>
                                            <a href="javascript:;" class="btn btn-default add1cart">{{ __('SoldOff') }}</a>
                                        <?php } ?>
                                        @if ($product->product_sale)
                                            <div class="sticker sticker-sale"></div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <!-- END CONTENT -->
                    </div>
                    <!-- END SIDEBAR & CONTENT -->

                    <!-- BEGIN TWO PRODUCTS & PROMO -->
                    {{-- <div class="row margin-bottom-35 ">
                        <!-- BEGIN TWO PRODUCTS -->
                        <div class="col-md-6 two-items-bottom-items">
                            <h2>Two items</h2>
                            <div class="owl-carousel owl-carousel2">
                                <div>
                                    <div class="product-item">
                                        <div class="pi-img-wrapper">
                                            <img src="assets/pages/img/products/k4.jpg" class="img-responsive"
                                                alt="Berry Lace Dress">
                                            <div>
                                                <a href="assets/pages/img/products/k4.jpg"
                                                    class="btn btn-default fancybox-button">Zoom</a>
                                                <a href="#product-pop-up"
                                                    class="btn btn-default fancybox-fast-view">View</a>
                                            </div>
                                        </div>
                                        <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                                        <div class="pi-price">$29.00</div>
                                        <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                                    </div>
                                </div>
                                <div>
                                    <div class="product-item">
                                        <div class="pi-img-wrapper">
                                            <img src="assets/pages/img/products/k2.jpg" class="img-responsive"
                                                alt="Berry Lace Dress">
                                            <div>
                                                <a href="assets/pages/img/products/k2.jpg"
                                                    class="btn btn-default fancybox-button">Zoom</a>
                                                <a href="#product-pop-up"
                                                    class="btn btn-default fancybox-fast-view">View</a>
                                            </div>
                                        </div>
                                        <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                                        <div class="pi-price">$29.00</div>
                                        <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                                    </div>
                                </div>
                                <div>
                                    <div class="product-item">
                                        <div class="pi-img-wrapper">
                                            <img src="assets/pages/img/products/k3.jpg" class="img-responsive"
                                                alt="Berry Lace Dress">
                                            <div>
                                                <a href="assets/pages/img/products/k3.jpg"
                                                    class="btn btn-default fancybox-button">Zoom</a>
                                                <a href="#product-pop-up"
                                                    class="btn btn-default fancybox-fast-view">View</a>
                                            </div>
                                        </div>
                                        <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                                        <div class="pi-price">$29.00</div>
                                        <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                                    </div>
                                </div>
                                <div>
                                    <div class="product-item">
                                        <div class="pi-img-wrapper">
                                            <img src="assets/pages/img/products/k1.jpg" class="img-responsive"
                                                alt="Berry Lace Dress">
                                            <div>
                                                <a href="assets/pages/img/products/k1.jpg"
                                                    class="btn btn-default fancybox-button">Zoom</a>
                                                <a href="#product-pop-up"
                                                    class="btn btn-default fancybox-fast-view">View</a>
                                            </div>
                                        </div>
                                        <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                                        <div class="pi-price">$29.00</div>
                                        <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                                    </div>
                                </div>
                                <div>
                                    <div class="product-item">
                                        <div class="pi-img-wrapper">
                                            <img src="assets/pages/img/products/k4.jpg" class="img-responsive"
                                                alt="Berry Lace Dress">
                                            <div>
                                                <a href="assets/pages/img/products/k4.jpg"
                                                    class="btn btn-default fancybox-button">Zoom</a>
                                                <a href="#product-pop-up"
                                                    class="btn btn-default fancybox-fast-view">View</a>
                                            </div>
                                        </div>
                                        <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                                        <div class="pi-price">$29.00</div>
                                        <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                                    </div>
                                </div>
                                <div>
                                    <div class="product-item">
                                        <div class="pi-img-wrapper">
                                            <img src="assets/pages/img/products/k3.jpg" class="img-responsive"
                                                alt="Berry Lace Dress">
                                            <div>
                                                <a href="assets/pages/img/products/k3.jpg"
                                                    class="btn btn-default fancybox-button">Zoom</a>
                                                <a href="#product-pop-up"
                                                    class="btn btn-default fancybox-fast-view">View</a>
                                            </div>
                                        </div>
                                        <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                                        <div class="pi-price">$29.00</div>
                                        <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END TWO PRODUCTS -->
                        <!-- BEGIN PROMO -->
                        {{-- <div class="col-md-6 shop-index-carousel">
                            <div class="content-slider">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li>
                                        <li data-target="#myCarousel" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <img src="{{URL::to('public/uploads/gallery/120_790_thuc_an_kho_royal_canin_indoor_27_32.png')}}" class="img-responsive"
                                                alt="Berry Lace Dress">
                                        </div>
                                        <div class="item">
                                            <img src="" class="img-responsive"
                                                alt="Berry Lace Dress">
                                        </div>
                                        <div class="item">
                                            <img src="" class="img-responsive"
                                                alt="Berry Lace Dress">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- END PROMO -->
                    </div>
                    <!-- END TWO PRODUCTS & PROMO -->
                </div>
            </div>
            {{-- End Product --}}


        <style>
            .hinhanh img {
                width: 100%;
                height: 100%;
            }

            .color_black,
            .color_black span {
                color: #000;
            }

        </style>
    @endsection
