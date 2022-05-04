@extends('layout')
@section('content')
    <?php
    $error = Session::get('error');
    if ($error) {
        echo "<script>alert('$error')</script>";
        Session::put('error', null);
    }
    $message = Session::get('message');
    if ($message) {
        echo "<script>alert('$message')</script>";
        Session::put('message', null);
    }
    ?>

    <!--/#cart_items-->


    {{--  --}}
    <div class="container">
        <h1 class="text-center">Thanh toán</h1>
        <div class="col-md-12 col-sm-12">
            <!-- BEGIN CHECKOUT PAGE -->
            <div class="panel-group checkout-page accordion scrollable" id="checkout-page">
                <!-- BEGIN CHECKOUT -->
                <div id="checkout" class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">
                            <a data-toggle="collapse" data-parent="#checkout-page" href="#checkout-content"
                                class="accordion-toggle collapsed" aria-expanded="false">
                                Giỏ hàng
                            </a>
                        </h2>
                    </div>
                    <div id="checkout-content" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body row">
                            <form action="{{ url('/update-cart') }}" method="POST" style="padding: 0 20px">
                                @csrf <br>
                                <table>
                                    <tbody>
                                        <tr>
                                            <th class="checkout-image">Ảnh</th>
                                            <th class="checkout-description">Tên</th>
                                            <th class="checkout-model">Kho còn</th>
                                            <th class="checkout-quantity">Lượng mua</th>
                                            <th class="checkout-price">Thành tiền</th>
                                            <th class="checkout-total">Tổng</th>
                                            <th></th>
                                        </tr>
                                        @if (Session::get('cart') == true)
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach (Session::get('cart') as $key => $cart)
                                                @php
                                                    $subtotal = $cart['product_price'] * $cart['product_qty'];
                                                    $total += $subtotal;
                                                @endphp
                                                <tr>
                                                    <td class="checkout-image">
                                                        <a href="javascript:;">
                                                            <img src="{{ asset('public/uploads/product/' . $cart['product_image']) }}"
                                                                alt="{{ $cart['product_name'] }}" width="50px">
                                                        </a>
                                                    </td>
                                                    <td class="checkout-description">
                                                        <h3><a href="javascript:;">{{ $cart['product_name'] }}</a></h3>
                                                    </td>
                                                    <td class="checkout-model">{{ $cart['product_quantity'] }}</td>
                                                    <td class="checkout-quantity">
                                                        <input type="number" class="cart_quantity" min="1"
                                                            oninput="validity.valid||(value='');" type="text"
                                                            name="cart_qty[{{ $cart['session_id'] }}]"
                                                            value="{{ $cart['product_qty'] }}" autocomplete="off" size="2"
                                                            max="20">
                                                        <input type="hidden" value="" name="rowId_cart"
                                                            class="form-control">
                                                    </td>
                                                    <td class="checkout-price">
                                                        <strong>{{ number_format($cart['product_price']) }} VND</strong>
                                                    </td>
                                                    <td class="checkout-total"><strong>{{ number_format($subtotal) }}
                                                            VND</strong></td>
                                                    <td>
                                                        <a class="cart_quantity_delete"
                                                            href="{{ url('/delete-sp/' . $cart['session_id']) }}"><i
                                                                class="fa fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td><input type="submit" name="update-cart" class="btn btn-default btn-sm"
                                                        value="Cập nhật"></td>
                                                <td style="list-style: none">
                                                    <li>Tổng tiền hàng :<span>{{ number_format($total) }} VND</span></li>

                                                    @if (Session::get('coupon'))
                                                        <li>
                                                            @foreach (Session::get('coupon') as $key => $cou)
                                                                @if ($cou['coupon_condition'] == 1)
                                                                    Mã giảm : {{ $cou['coupon_number'] }} %
                                                                    <p>
                                                                        @php
                                                                            $total_coupon = ($total * $cou['coupon_number']) / 100;
                                                                        @endphp
                                                                    </p>
                                                                    <p>
                                                                        @php
                                                                            $total_after_coupon = $total - $total_coupon;
                                                                        @endphp
                                                                    </p>
                                                                    {{-- <a href="{{url('del-cou')}}" class="btn btn-susscess">Xóa mã</a> --}}
                                                                @elseif ($cou['coupon_condition'] == 2)
                                                                    Mã giảm : {{ number_format($cou['coupon_number']) }}
                                                                    VND
                                                                    <p>
                                                                        @php
                                                                            $total_coupon = $total - $cou['coupon_number'];
                                                                        @endphp
                                                                    </p>
                                                                    <p>
                                                                        @php
                                                                            $total_after_coupon = $total_coupon;
                                                                        @endphp
                                                                    </p>
                                                                    <a href="{{ url('del-cou') }}"
                                                                        class="btn btn-susscess">Xóa
                                                                        mã</a>
                                                                @endif
                                                            @endforeach
                                                    @endif
                                                    {{-- <li>Thuế <span></span></li> --}}
                                                    @if (Session::get('fee'))
                                                        <li>
                                                            <a class="cart_quantity_delete"
                                                                href="{{ url('/del-fee') }}"><i
                                                                    class="fa fa-times"></i></a>
                                                            Phí vận chuyển <span>{{ number_format(Session::get('fee')) }}
                                                                VND</span>
                                                        </li>
                                                        @php
                                                            $total_after_fee = $total + Session::get('fee');
                                                        @endphp
                                                    @endif
                                                    <li>Tổng đơn hàng :
                                                        @php
                                                            if (Session::get('fee') && !Session::get('coupon')) {
                                                                $total_after = $total_after_fee;
                                                                echo number_format($total_after);
                                                            } elseif (!Session::get('fee') && Session::get('coupon')) {
                                                                $total_after = $total_after_coupon;
                                                                echo number_format($total_after);
                                                            } elseif (Session::get('fee') && Session::get('coupon')) {
                                                                $total_after = $total_after_coupon;
                                                                $total_after = $total_after + Session::get('fee');
                                                                echo number_format($total_after);
                                                            } elseif (!Session::get('fee') && !Session::get('coupon')) {
                                                                $total_after = $total;
                                                                echo number_format($total_after);
                                                            }
                                                        @endphp
                                                        VND
                                                    </li>

                                                </td>
                                                <td colspan="5"><a href="{{ url('/delete-all-cart/') }}"
                                                        class="btn btn-default check_out pull-right">Hủy</a></td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="6">
                                                    <center style="margin-top: 15px">
                                                        @php
                                                            echo 'Chưa có sản phẩm trong giỏ';
                                                        @endphp
                                                    </center>
                                                </td>
                                            </tr>
                                    </tbody>
                                    @endif
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CHECKOUT -->

        @if (Session::get('cart'))
            @if (!Session::get('fee'))
                <!-- BEGIN PAYMENT ADDRESS -->
                <div class="col-md-12 col-sm-12">
                    <div id="payment-address" class="panel panel-default panel-group checkout-page accordion scrollable">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                <a data-toggle="collapse" data-parent="#checkout-page" href="#payment-address-content"
                                    class="accordion-toggle collapsed" aria-expanded="false">
                                    Chọn địa chỉ giao hàng
                                </a>
                            </h2>
                        </div>
                        <div id="payment-address-content" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body row">
                                <div class="col-md-12 col-sm-12">
                                    <form role="form">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Chọn thành phố</label>
                                            <select name="city" id="city"
                                                class="form-control input-lg m-bot15 city choose ">
                                                <option value="">---Chọn thành phố---</option>
                                                @foreach ($city as $key => $c_t)
                                                    <option value="{{ $c_t->matp }}">{{ $c_t->name_city }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Chọn quận huyện</label>
                                            <select name="province" id="province"
                                                class="form-control input-lg m-bot15 province choose ">
                                                <option value="">---Chọn quận huyện---</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Chọn xã phường</label>
                                            <select name="wards" id="wards" class="form-control input-lg m-bot15 wards">
                                                <option value="">---Chọn xã phường---</option>
                                            </select>
                                        </div>
                                        <input type="button" value="Tính phí vận chuyển" name="caculate_order"
                                            class="btn btn-primary  pull-right collapsed caculate_delivery">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- END PAYMENT ADDRESS -->

            <!-- BEGIN SHIPPING ADDRESS -->
            <div class="col-md-12 col-sm-12">
                <div id="shipping-address" class="panel panel-default panel-group checkout-page accordion scrollable">
                    <div class="panel-heading">
                        <h2 class="panel-title">
                            <a data-toggle="collapse" data-parent="#checkout-page" href="#shipping-address-content"
                                class="accordion-toggle collapsed" aria-expanded="false">
                                Thông tin cá nhân
                            </a>
                        </h2>
                    </div>
                    <div id="shipping-address-content" class="panel-collapse collapse" aria-expanded="false">
                        <div class="panel-body row">
                            <form method="POST">
                                @csrf
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="firstname-dd">Email<span class="require">*</span></label>
                                        <input type="email" placeholder="Email*" name="shipping_email"
                                            class="shipping_email form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname-dd">Tên khách hàng <span
                                                class="require">*</span></label>
                                        <input type="text" placeholder="Họ tên" name="shipping_name"
                                            class="form-control shipping_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email-dd">Địa chỉ cụ thể<span class="require">*</span></label>
                                        <input type="text" placeholder="Địa chỉ" name="shipping_address"
                                            class="shipping_address form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="telephone-dd">Điện thoại <span class="require">*</span></label>
                                        <input type="text" placeholder="Điện thoại" name="shipping_phone"
                                            class="shipping_phone form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="fax-dd">Ghi chú</label>
                                        <input type="text" placeholder="Ghi chú" name="shipping_notes"
                                            class="form-control shipping_notes">
                                    </div>
                                    @if (Session::get('fee'))
                                        <input type="hidden" name="order_fee" class="order_fee"
                                            value="{{ Session::get('fee') }}">
                                    @else
                                        <input type="hidden" name="order_fee" class="order_fee" value="30000">
                                    @endif
                                    @if (Session::get('coupon'))
                                        @foreach (Session::get('coupon') as $key => $cou)
                                            <input type="hidden" name="order_coupon" class="order_coupon"
                                                value="{{ $cou['coupon_code'] }}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                                    @endif
                                    <div class="">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
                                            <select name="payment_select"
                                                class="form-control input-lg m-bot15 payment_select">
                                                <option value="0">Thanh toán online</option>
                                                <option value="1">Thanh toán trực tiếp</option>
                                                <option value="2">Thanh toán paypal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <a class="btn btn-primary pull-right collapsed send_order" type="button"
                                        name="send_order">Continue</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- END SHIPPING ADDRESS -->
    @endif
</div>


@endsection
