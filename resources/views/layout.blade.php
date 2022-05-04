<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="canonical" href="{{ $url_canonical }}" />
    <meta name="keywords" content="{{ $meta_keywords }}" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="description" content="{{ $meta_desc }}">
    <meta charset="utf-8">
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type' />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="M_Adnan">
    <meta property="og:site_name" content="http://localhost/camera">
    <meta property="og:description" content="{{ $meta_desc }}">
    <meta property="og:title" content="{{ $meta_title }}">
    <meta property="og:url" content="{{ $url_canonical }}">
    <meta property="og:type" content="website">
    {{-- End seo --}}
    <title>{{ $meta_title }}</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::to('/public/frontend/images/download.png') }}">
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/rs-plugin/css/settings.css') }}"
        media="screen" />

    <link rel="shortcut icon" href="favicon.html">

    <!-- Fonts START -->
    <link
        href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all"
        rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all"
        rel="stylesheet" type="text/css">
    <!--- fonts for slider on the index page -->
    <!-- Fonts END -->

    <!-- Global styles START -->
    <link href="{{ URL::to('public/frontend/assets/plugins/font-awesome/css/font-awesome.min.css') }}"
        rel="stylesheet">
    <link href="{{ URL::to('public/frontend/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Global styles END -->

    <!-- Page level plugin styles START -->
    <link href="{{ URL::to('public/frontend/assets/pages/css/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::to('public/frontend/assets/plugins/fancybox/source/jquery.fancybox.css') }}"
        rel="stylesheet">
    <link href="{{ URL::to('public/frontend/assets/plugins/owl.carousel/assets/owl.carousel.css') }}"
        rel="stylesheet">
    <!-- Page level plugin styles END -->

    <!-- Theme styles START -->
    <link href="{{ URL::to('public/frontend/assets/pages/css/components.css') }}" rel="stylesheet">
    <link href="{{ URL::to('public/frontend/assets/pages/css/slider.css') }}" rel="stylesheet">
    <link href="{{ URL::to('public/frontend/assets/pages/css/style-shop.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('public/frontend/assets/corporate/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::to('public/frontend/assets/corporate/css/style-responsive.css') }}" rel="stylesheet">
    <link href="{{ URL::to('public/frontend/assets/corporate/css/themes/red.css') }}" rel="stylesheet"
        id="style-color">
    <link href="{{ URL::to('public/frontend/assets/corporate/css/custom.css') }}" rel="stylesheet">
    <!-- Theme styles END -->
    <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>
    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>
    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "102191541727483");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>
    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v13.0'
            });
        };
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</head>

<body class="ecommerce">
    <!-- LOADER -->
    <div id="loader">
        <div class="position-center-center">
            <div class="ldr"></div>
        </div>
    </div>
    <!-- END LOADER -->
    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-6 col-sm-6 additional-shop-info">
                    <ul class="list-unstyled list-inline">
                        <li><i class="fa fa-phone"></i><span>+0778 960 401</span></li>
                        <!-- BEGIN LANGS -->
                        <li class="langs-block">
                            <a href="javascript:void(0);" class="current">{{ __('Language') }}</a>
                            <div class="langs-block-others-wrapper">
                                <div class="langs-block-others">
                                    <a href="{{ URL::to('language', ['us']) }}">
                                        English
                                    </a>
                                    <a href="{{ URL::to('language', ['vi']) }}">
                                        VietNam
                                        </a>
                                </div>
                            </div>
                        </li>
                        <!-- END LANGS -->
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">
                        <?php
                        $customer_id = Session::get('customer_id');
                        $shipping_id = Session::get('shipping_id');
                        if ($customer_id!=NULL && $shipping_id==NULL) {
                          ?>
                        <li class="langs-block">
                            <a href="javascript:void(0);" class="current">{{ __('Hello') }} :
                                {{ Session::get('customer_name') }}</a>
                            <div class="langs-block-others-wrapper">
                                <div class="langs-block-others">
                                    <a href="{{ URL::to('/account/'.Session::get('customer_id')) }}">{{ __('Account') }}</a>
                                    <a href="{{ URL::to('/history') }}">{{ __('History') }}</a>
                                </div>
                            </div>
                        </li>
                        <?php
                        }else {
                            ?>
                        <?php } ?>
                        <li><a href="{{ URL::to('/wishlist') }}">{{ __('Wishlist') }}</a></li>
                        {{-- <li><a href="{{ URL::to('/gio-hang') }}">Giỏ hàng
                            <small class="badges">1</small>
                        </a></li> --}}
                        <li id="show-cart"></li>
                        <?php
                                            $customer_id = Session::get('customer_id');
                                            if ($customer_id!=NULL) {
                                              ?>
                        <li><a href="{{ URL::to('/logout-checkout') }}">{{ __('Logout') }}</a></li>
                        <?php
                            }else {
                                    ?>
                        <li><a href="{{ URL::to('/login-checkout') }}">{{ __('Login') }}</a></li>
                        <?php
                            }
                            ?>
                    </ul>
                </div>
                <!-- END TOP BAR MENU -->
            </div>
        </div>
    </div>
    <!-- END TOP BAR -->
    <!-- BEGIN HEADER -->
    <div class="header">
        <div class="container">
            <a class="site-logo" href="{{URL::to('/trang-chu')}}">LJShop.vn</a>

            <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>



            <!-- BEGIN NAVIGATION -->
            <div class="header-navigation">
                <ul>
                    <li><a href="{{URL::to('trang-chu')}}">{{ __('Home') }}</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                            {{ __('Brand') }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($category as $cate)
                                <li><a href="{{ URL::to('/product-by-category/' . $cate->category_id)}}">{{$cate->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </li>


                    <li><a href="">{{ __('News') }}</a></li>

                    <!-- BEGIN TOP SEARCH -->
                    <li class="menu-search">
                        <form action="{{ URL::to('/timkiem') }}" method="GET" autocomplete="off">
                            <div class="input-group" style="display: flex">
                                <input type="text" name="keyword" id="keyword">
                                <div id="search_ajax"></div>
                                <button type="submit">{{ __('Search') }}</button>
                            </div>
                        </form>
                    </li>
                    <!-- END TOP SEARCH -->
                </ul>
            </div>
            <!-- END NAVIGATION -->
        </div>
    </div>
    <!-- Header END -->
    @yield('content')
    <!-- footer -->
    {{-- <div class="footer pt-5">
        <div class="container py-4">
            <div class="row w3_footer_grids">
                <div class="col-md-3 w3_footer_grid">
                    <h3>Contact</h3>
                    <ul class="address">
                        <li><i class="fas fa-map-marker-alt"></i>124 Đà Nẵng</li>
                        <li><i class="fas fa-envelope-open-text"></i><a
                                href="mailto:thong.phan109@gmail.com">thong.phan109@gmail.com</a></li>
                        <li> <a href="tel:+44-000-888-999"><i class="fas fa-phone-alt"></i>+0778960401</a></li>
                    </ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Information</h3>
                    <ul class="info">
                        <li><a href="about.html"><i class="fas fa-angle-right"></i>About Us</a></li>
                        <li><a href="mail.html"><i class="fas fa-angle-right"></i>Contact Us</a></li>
                        <li><a href="codes.html"><i class="fas fa-angle-right"></i>Shortcodes</a></li>
                        <li><a href="faq.html"><i class="fas fa-angle-right"></i>FAQ's</a></li>
                        <li><a href="products1.html"><i class="fas fa-angle-right"></i>Special Products</a></li>
                    </ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Category</h3>
                    <ul class="info">
                        <li><a href="products1.html"><i class="fas fa-angle-right"></i>Fruits & Vegetables</a></li>
                        <li><a href="products2.html"><i class="fas fa-angle-right"></i>Meats & Seafood</a></li>
                        <li><a href="products1.html"><i class="fas fa-angle-right"></i>Bakery & Pastry</a></li>
                        <li><a href="products2.html"><i class="fas fa-angle-right"></i>Beverages</a></li>
                        <li><a href="products1.html"><i class="fas fa-angle-right"></i>Breakfast & Dairy</a></li>
                    </ul>
                </div>
                <div class="col-md-3 w3_footer_grid">
                    <h3>Profile</h3>
                    <ul class="info">
                        <li><a href="index.html"><i class="fas fa-angle-right"></i>Home</a></li>
                        <li><a href="products2.html"><i class="fas fa-angle-right"></i>Today's Deals</a></li>
                    </ul>
                    <h4>Follow Us</h4>
                    <div class="agileits_social_button">
                        <ul>
                            <li><a href="#facebook" class="facebook"><i class="fab fa-facebook-f"></i> </a></li>
                            <li><a href="#twitter" class="twitter"><i class="fab fa-twitter"></i> </a></li>
                            <li><a href="#google" class="google"><i class="fab fa-google-plus-g"></i> </a>
                            </li>
                            <li><a href="#pinterest" class="pinterest"><i class="fab fa-pinterest-p"></i> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copy mt-4">
            <div class="container">
                <p class="copy-text">&copy; 2021 Grocery Mart. All rights reserved. Design by <a
                        href="" target="_blank">Loeii</a>
                </p>
            </div>
        </div>
    </div> --}}
    <!-- //footer -->

    <!-- Js scripts -->
    <!-- move top -->
    {{-- <button onclick="topFunction()" id="movetop" title="Go to top" style="display: none !importand">
        <span class="fas fa-level-up-alt" aria-hidden="true"></span>
    </button> --}}
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("movetop").style.display = "block";
            } else {
                document.getElementById("movetop").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- //move top -->

    <!-- common jquery plugin -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- //common jquery plugin -->

    <!-- cart-js -->
    <script src="js/minicart.js"></script>
    <script>
        w3ls.render();

        w3ls.cart.on('w3sb_checkout', function(evt) {
            var items, len, i;

            if (this.subtotal() > 0) {
                items = this.items();

                for (i = 0, len = items.length; i < len; i++) {}
            }
        });
    </script>
    <!-- //cart-js -->

    <!-- owl carousel -->
    <script src="js/owl.carousel.js"></script>
    <!-- owl carousel -->
    <!-- script for customers -->
    <script>
        $(document).ready(function() {
            $('.owl-three').owlCarousel({
                loop: true,
                margin: 0,
                nav: false,
                dots: false,
                responsiveClass: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplaySpeed: 1000,
                autoplayHoverPause: false,
                responsive: {
                    0: {
                        items: 2,
                        nav: true
                    },
                    414: {
                        items: 3,
                        nav: true
                    },
                    800: {
                        items: 4,
                        nav: true
                    }
                }
            })
        })
    </script>
    <!-- //customers owlcarousel -->

    <!-- theme switch js (light and dark)-->
    <script src="js/theme-change.js"></script>
    <!-- //theme switch js (light and dark)-->

    <!-- MENU-JS -->
    <script>
        $(window).on("scroll", function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 80) {
                $("#site-header").addClass("nav-fixed");
            } else {
                $("#site-header").removeClass("nav-fixed");
            }
        });

        //Main navigation Active Class Add Remove
        $(".navbar-toggler").on("click", function() {
            $("header").toggleClass("active");
        });
        $(document).on("ready", function() {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
            $(window).on("resize", function() {
                if ($(window).width() > 991) {
                    $("header").removeClass("active");
                }
            });
        });
    </script>
    <!-- //MENU-JS -->

    <!-- disable body scroll which navbar is in active -->
    <script>
        $(function() {
            $('.navbar-toggler').click(function() {
                $('body').toggleClass('noscroll');
            })
        });
    </script>
    <!-- //disable body scroll which navbar is in active -->

    <!-- bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- //bootstrap -->
    <script src="{{ asset('public/frontend/js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/own-menu.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.lighter.js') }}"></script>
    <script src="{{ asset('public/frontend/js/owl.carousel.min.js') }}"></script>
    <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script type="text/javascript" src="{{ asset('public/frontend/rs-plugin/js/jquery.tp.t.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/rs-plugin/js/jquery.tp.min.js') }}"></script>
    {{--  --}}
    {{-- <script src="{{asset('public/frontend/js/main.js')}}"></script>
        <script src="{{asset('public/frontend/js/jquery-1.11.3.min.js')}}"></script>
        <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('public/frontend/js/own-menu.js')}}"></script>
        <script src="{{asset('public/frontend/js/jquery.lighter.js')}}"></script>
        <script src="{{asset('public/frontend/js/owl.carousel.min.js')}}"></script> --}}
    <script src="{{ asset('public/frontend/js/sweet-alert.min.js') }}"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    <script>
         show_cart();
            function show_cart(){
                $.ajax({
                    url:'{{url('/show-cart')}}',
                    method:"GET",
                    success:function(data){
                            $("#show-cart").html(data);
                    }
                });
            }
        $(document).ready(function() {
            //show-cart-quantity

            $('.add-to-cart').click(function() {
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_sale_after = $('.cart_product_sale_after_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name= "_token"]').val();
                if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                    alert('Làm ơn đặt nhỏ hơn' + cart_product_quantity);
                } else {
                    $.ajax({
                        url: '{{ url::to('/add-cart-ajax') }}',
                        method: 'POST',
                        data: {
                            cart_product_id: cart_product_id,
                            cart_product_name: cart_product_name,
                            cart_product_quantity: cart_product_quantity,
                            cart_product_image: cart_product_image,
                            cart_product_sale_after: cart_product_sale_after,
                            cart_product_qty: cart_product_qty,
                            _token: _token
                        },
                        success: function() {
                            swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{ url('/gio-hang') }}";
                                });
                                show_cart();
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            load_comment();

            function load_comment() {
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name= "_token"]').val();
                $.ajax({
                    url: '{{ url::to('/load-comment') }}',
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#show_comment').html(data);
                    }
                });
            }
            $('.send-comment').click(function() {
                var product_id = $('.comment_product_id').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();
                var _token = $('input[name= "_token"]').val();
                $.ajax({
                    url: '{{ url::to('/send-comment') }}',
                    method: 'POST',
                    data: {
                        product_id: product_id,
                        comment_name: comment_name,
                        comment_content: comment_content,
                        _token: _token
                    },
                    success: function(data) {
                        var comment_name = $('.comment_name').val('');
                        var comment_content = $('.comment_content').val('');
                        $('#notify_comment').html(
                            '<p class="text text-success">Thêm bình luận thành công</p>');
                        load_comment();
                        $('#notify_comment').fadeOut(2000);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{ url::to('/select-delivery-home') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.caculate_delivery').click(function() {
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if (matp == '' && maqh == '' && xaid == '') {
                    alert('Bạn chưa chọn địa chỉ');
                } else {
                    $.ajax({
                        url: '{{ url::to('/caculate-fee') }}',
                        method: 'POST',
                        data: {
                            matp: matp,
                            maqh: maqh,
                            _token: _token,
                            xaid: xaid
                        },
                        success: function() {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
    {{--  --}}
    <script>
        $('.xemnhanh').click(function() {
            var product_id = $(this).data('id_product');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ url::to('/quickview') }}',
                method: 'POST',
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    $('#product_quickview_title').html(data.product_name);
                    $('#product_quickview_id').html(data.product_id);
                    $('#product_quickview_price').html(data.product_price);
                    $('#product_quickview_tags').html(data.product_tags);
                    $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_gallery').html(data.product_gallery);
                    $('#product_quickview_desc').html(data.product_desc);
                    $('#product_quickview_content').html(data.product_content);
                    $('#product_quickview_value').html(data.product_quickview_value);
                    $('#product_quickview_button').html(data.product_button);
                }
            });
        });
    </script>
    {{--  --}}
    <script>
        $(document).ready(function() {
            $('.send_order').click(function() {
                swal({
                        title: "Xác nhận đơn hàng",
                        text: "Đơn hàng khi mua sẽ không được hoàn trả, bạn có chắc ???",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        buttons: true,
                        dangerMode: true,
                    },
                    function(willDelete) {
                        if (willDelete) {
                            var shipping_email = $('.shipping_email').val();
                            var shipping_name = $('.shipping_name').val();
                            var shipping_address = $('.shipping_address').val();
                            var shipping_phone = $('.shipping_phone').val();
                            var shipping_notes = $('.shipping_notes').val();
                            var shipping_method = $('.payment_select').val();
                            var order_fee = $('.order_fee').val();
                            var order_coupon = $('.order_coupon').val();
                            var _token = $('input[name= "_token"]').val();
                            $.ajax({
                                url: '{{ url::to('/confirm-order') }}',
                                method: 'POST',
                                data: {
                                    shipping_email: shipping_email,
                                    shipping_name: shipping_name,
                                    shipping_address: shipping_address,
                                    shipping_phone: shipping_phone,
                                    shipping_notes: shipping_notes,
                                    order_fee: order_fee,
                                    order_coupon: order_coupon,
                                    _token: _token,
                                    shipping_method: shipping_method
                                },
                                success: function(res) {
                                    console.log(res);
                                    // swal(
                                    //     "Đơn hàng đã được gửi, chúng tôi sẽ gửi cho bạn một email để theo dõi đơn hàng"
                                    // );
                                }
                            });
                            // window.setTimeout(function() {
                            //     location.reload();
                            // }, 3000);
                        }
                    });
            });
        });
    </script>
    <script>
        $.post('url-to-call', {
            demo: 1
        }, function(data) {
            // 200 http response code
            if (data.redirect_url) {
                window.location = data.redirect_url; // or {{ url('login') }}
            }
        }).fail(function(response) {

            //handle errors and other http response code

        });
    </script>
    {{-- Add-to-cart-quickview --}}
    <script>
        $(document).on('click', '.add-to-cart-quickview', function() {
            var id = $(this).data('id_product');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name= "_token"]').val();
            if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                alert('Làm ơn đặt nhỏ hơn' + cart_product_quantity);
            } else {
                $.ajax({
                    url: '{{ url::to('/add-cart-ajax') }}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_quantity: cart_product_quantity,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        _token: _token
                    },
                    beforeSend: function() {
                        $('#beforesned_quickview').html("Đang thêm sản phẩm vào giỏ ....");
                    },
                    success: function() {
                        $('#beforesned_quickview').html("Đã thêm sản phẩm vào giỏ !!!");
                    }
                });
            }
        });
    </script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/jquery.lighter.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/lightslider.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/prettify.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 5,
                slideMargin: 0,
                enableDrag: false,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>
    <script>
        $('#keyword').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url::to('/autocomplete-ajax') }}',
                    method: 'POST',
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });
            } else {
                $('#search_ajax').fadeOut();
            }
        });
        $(document).on('click', '.li_search_ajax', function() {
            $('#keyword').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>
    {{-- danh gia sao --}}
    <script>
        function remove_background(product_id) {
            for (var count = 1; count <= 5; count++) {
                $('#' + product_id + '-' + count).css('color', '#ccc');
            }
        }
        // hover chuot danh gia
        $(document).on('mouseenter', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data("product_id");
            remove_background(product_id);
            for (var count = 1; count <= index; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });
        // Nha chuot ko danh gia
        $(document).on('mouseleave', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data("product_id");
            var rating = $(this).data("rating");
            remove_background(product_id);
            for (var count = 1; count <= rating; count++) {
                $('#' + product_id + '-' + count).css('color', '#ffcc00');
            }
        });
        //click danh gia sao
        $(document).on('click', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data("product_id");
            var _token = $('input[name= "_token"]').val();
            $.ajax({
                url: '{{ url::to('/insert-rating') }}',
                method: 'POST',
                data: {
                    index: index,
                    _token: _token,
                    product_id: product_id
                },
                success: function(data) {
                    if (data == 'done') {
                        alert('Bạn đã đánh giá' + ' ' + index + ' ' + 'trên 5');
                        location.reload();
                    } else {
                        alert('Lỗi đánh giá');
                    }
                }
            });
        });
    </script>
    {{-- <script>
        function view() {
                if (localStorage / getItem('data') != null) {
                    var data = JSON.parse(localStorage.getItem('data'));
                    data.reverse();
                      document.getElementById('row_wistlist').style.overflow = 'scroll';
                      document.getElementById('row_wistlist').style.height = '300px';
                    for (i = 0; i < data.length; i++) {
                        var name = data[i].name;
                        var price = data[i].price;
                        var image = data[i].image;
                        var url = data[i].url;
                        $('#row_wistlist').append('<li><div class="media-left"><div class="cart-img"> <a href="' + url +
                            '"> <img class="media-object img-responsive" src="' + image +
                            '" alt="..."> </a> </div></div><div class="media-body"><h6 class="media-heading">' + name +
                            '</h6><span class="price">' + price + '</span><span class="price"><a href="' + url +
                            '">Xem</a></span><span class="price"><a href="#." class="btn-violet add home mt-3 delete_withlist">Xóa</a></span></div></li>'
                        );
                    }
                }
            }
            view();
    </script> --}}
    {{-- <script>


            function add_wistlist(clicked_id) {
                var id = clicked_id;
                var name = document.getElementById('wistlist_productname' + id).value;
                var price = document.getElementById('wistlist_productprice' + id).value;
                var image = document.getElementById('wistlist_productimage' + id).src;
                var url = document.getElementById('wistlist_producturl' + id).href;
                var newItem = {
                    'url': url,
                    'id': id,
                    'name': name,
                    'price': price,
                    'image': image
                }
                if (localStorage.getItem('data') == null) {
                    localStorage.setItem('data', '[]');
                }
                var old_data = JSON.parse(localStorage.getItem('data'));
                var matches = $.grep(old_data, function(obj) {
                    return obj.id == id;
                })
                if (matches.length) {
                    alert('Sản phẩm đã có trong danh sách yêu thích');
                } else {
                    old_data.push(newItem);
                    $('#row_wistlist').append('<li><div class="media-left"><div class="cart-img"> <a href="' + newItem.url +
                        '"> <img class="media-object img-responsive" src="' + newItem.image +
                        '" alt="..."> </a> </div></div><div class="media-body"><h6 class="media-heading">' + newItem.name +
                        '</h6><span class="price">' + newItem.price + ' VND</span><span class="price"><a href="' + newItem
                        .url +
                        '" class="btn-violet add home mt-3">Xem</a></span><span class="price"><a href="#." class="btn-violet add home mt-3 delete_withlist">Xóa</a></span></div></li>'
                    );
                }
                localStorage.setItem('data', JSON.stringify(old_data));
            }
            $(document).on('click', '.delete_withlist', function(event) {
                event.preventDefault();
                var id = $(this).data('id');
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        if (result[i].id == id) {
                            result.splice(i, i);
                            break;
                        }
                    }
                    localStorage.setItem('data', JSON.stringify(result));
                    swal({
                        title: 'Sản phẩm đã được xóa khỏi danh mục yêu thích!!!',
                        icon: "success",
                        button: "Quay lại",
                    }).then(ok => {
                        window.location.reload();
                    });

                }
                if (result.length == 1) {
                    for (var i = 0; i < result.length; i++) {
                        if (result[i].id == id) {
                            result.splice(i, 1);
                            break;
                        }
                    }
                    localStorage.setItem('data', JSON.stringify(result));
                    swal({
                        title: 'Sản phẩm đã được xóa khỏi danh mục yêu thích!!!',
                        icon: "success",
                        button: "Quay lại",
                    }).then(ok => {
                        window.location.reload();
                    });
                }
            });
        </script> --}}
    <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script src="{{ URL::to('public/frontend/assets/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('public/frontend/assets/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('public/frontend/assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ URL::to('public/frontend/assets/corporate/scripts/back-to-top.js') }}" type="text/javascript">
    </script>
    <script src="{{ URL::to('public/frontend/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="{{ URL::to('public/frontend/assets/plugins/fancybox/source/jquery.fancybox.pack.js') }}"
        type="text/javascript"></script><!-- pop up -->
    <script src="{{ URL::to('public/frontend/assets/plugins/owl.carousel/owl.carousel.min.js') }}"
        type="text/javascript">
    </script><!-- slider for products -->
    <script src='{{ URL::to('public/frontend/assets/plugins/zoom/jquery.zoom.min.js') }}' type="text/javascript">
    </script><!-- product zoom -->
    <script src="{{ URL::to('public/frontend/assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js') }}"
        type="text/javascript"></script><!-- Quantity -->

    <script src="{{ URL::to('public/frontend/assets/corporate/scripts/layout.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('public/frontend/assets/pages/scripts/bs-carousel.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();
            Layout.initOWL();
            Layout.initImageZoom();
            Layout.initTouchspin();
            Layout.initTwitter();
        });
    </script>
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>
    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>
    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "102191541727483");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>
    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v13.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</body>

</html>
