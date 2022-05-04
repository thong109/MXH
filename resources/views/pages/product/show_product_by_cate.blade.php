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
                    <h2>Có tất cả {{ count($show_product_by_cate) }} sản phẩm</h2>
                    <div class="owl-carousel owl-carousel3">
                        @foreach ($show_product_by_cate as $pro)
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
                                    <?php if($pro->product_quantity > 0){ ?>
                                        <a type="button" class="add-to-cart btn btn-default add2cart"
                                        data-id_product="{{ $pro->product_id }}" name="add-to-cart">Add to
                                        cart</a>
                                    <?php } else { ?>
                                        <a href="javascript:;" class="btn btn-default add1cart">Hết hàng</a>
                                    <?php } ?>
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
