@extends('layout')
@section('content')
    <div class="container">
        <div class="row margin-bottom-40">
            <!-- BEGIN SIDEBAR -->
            <div class="sidebar col-md-3 col-sm-5">
                <ul class="list-group margin-bottom-25 sidebar-menu">
                    @foreach ($category as $cate)
                        <li class="list-group-item clearfix"><a href="shop-product-list.html"><i
                                    class="fa fa-angle-right"></i>{{ $cate->category_name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <!-- END SIDEBAR -->

            <!-- BEGIN CONTENT -->
            <div class="col-md-9 col-sm-7">
                <h1>My Wish List</h1>
                <div class="goods-page">
                    <div class="goods-data clearfix">
                        <div class="table-wrapper-responsive">
                            <table summary="Shopping cart">
                                <tbody>
                                    <tr>
                                        <th class="goods-page-image">Ảnh</th>
                                        <th class="goods-page-description">Tên sản phẩm</th>
                                        <th class="goods-page-stock">Trạng thái</th>
                                        <th class="goods-page-price" colspan="2">Giá</th>
                                    </tr>

                                    @foreach ($wishlist as $w)
                                        @php
                                            $w->getProductFavorite->product_sale_after = $w->getProductFavorite->product_price - ($w->getProductFavorite->product_price * $w->getProductFavorite->product_sale) / 100;
                                        @endphp
                                        <tr>
                                            <td class="goods-page-image">
                                                <a href="javascript:;"><img
                                                        src="{{ asset('public/uploads/product/' . $w->getProductFavorite->product_image) }}"
                                                        alt="Berry Lace Dress"></a>
                                            </td>
                                            <td class="goods-page-description">
                                                <h3><a
                                                        href="{{ URL::to('chi-tiet-san-pham/' . $w->getProductFavorite->product_slug) }}">{{ $w->getProductFavorite->product_name }}</a>
                                                </h3>
                                                <p>{{ $w->getProductFavorite->product_content }}</p>
                                            </td>
                                            <td class="goods-page-stock">
                                                @if ($w->getProductFavorite->product_quantity > 0)
                                                    Còn hàng ( {{$w->getProductFavorite->product_quantity}} )
                                                    @else
                                                    Hết hàng
                                                @endif
                                            </td>
                                            <td class="goods-page-price">
                                                @if ($w->getProductFavorite->product_sale)
                                                    <span class="price">
                                                        <div class="ml-3 d-flex">
                                                            <strong>
                                                                <span>{{ number_format($w->getProductFavorite->product_sale_after) }}
                                                                    VND</span>
                                                            </strong>
                                                        </div>
                                                        <strong>
                                                            <strike
                                                            class="m-0-5 d-flex mausay">{{ number_format($w->getProductFavorite->product_price) }}
                                                            VND
                                                            </strike>
                                                        </strong>
                                                    </span>
                                                @else
                                                    <strong>
                                                        <span
                                                        class="price">{{ number_format($w->getProductFavorite->product_price) }}
                                                        VND</span>
                                                    </strong>
                                                @endif
                                            </td>
                                            <td class="del-goods-col">
                                                <a class="del-goods"
                                                    href="{{ URL::to('del-wishlist/' . $w->product_favorite_id) }}">&nbsp;</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>
@endsection
