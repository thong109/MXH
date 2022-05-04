<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\FreeShip;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

// session_start();

class CheckoutController extends Controller
{
    public function check()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout(Request $request)
    {
        $meta_desc = "Chuyên bán máy ảnh và phụ kiện máy ảnh";
        $meta_keywords = "may anh, máy ảnh, phụ kiện,phu kien, phụ kiện máy ảnh, phu kien may anh";
        $url_canonical = $request->url();
        $meta_title = "LJShop.vn | Đăng nhập";
        $cate_product = DB::table('tbl_category')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $auth = Session::get('customer_id');
        if(!$auth){
            return view('pages.checkout.login_checkout')->with('category', $cate_product)->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'));
        }else{
            return redirect('trang-chu');
        }
    }
    //THêm customer khi đăng kí
    public function add_customer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $exitEmail = Customer::where('customer_email', $request->customer_email)->where('customer_phone',$request->customer_phone)->first();
        // dd($exitEmail);
        if (!$exitEmail) {
            $customer_id = Customer::insertGetId($data);
            Session::put('customer_id', $customer_id);
            Session::put('customer_name', $request->customer_name);
            return Redirect::to('/checkout');
        } else {
            return redirect()->back()->with('message', 'Tên email hoặc số điện thoại đã tồn tại');
        }
    }
    //Quản trị viên đăng ký Customer
    public function LayoutCustomer(){
        return view('admin.customer.add_customer');
    }
    public function addCustomer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $exitEmail = Customer::where('customer_email', $request->customer_email)->where('customer_phone',$request->customer_phone)->first();
        // dd($exitEmail);
        if (!$exitEmail) {
            $customer_id = Customer::insertGetId($data);
            Session::put('customer_id', $customer_id);
            Session::put('customer_name', $request->customer_name);
            return Redirect::to('/customer-list');
        } else {
            return redirect()->back()->with('message','Tên email hoặc số điện thoại đã tồn tại');
        }
    }
    //
    public function checkout(Request $request)
    {
        $city = City::orderBy('matp', 'asc')->get();
        $meta_desc = "Chuyên bán máy ảnh và phụ kiện máy ảnh";
        $meta_keywords = "may anh, máy ảnh, phụ kiện,phu kien, phụ kiện máy ảnh, phu kien may anh";
        $url_canonical = $request->url();
        $meta_title = "LJShop.vn | Thanh toán";
        $cate_product = DB::table('tbl_category')->where('category_status', '0')->orderBy('category_id', 'desc')->get();

        return view('pages.checkout.checkout')->with('category', $cate_product)->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'city'));
    }
    public function save_checkout(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_note'] = $request->shipping_note;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }
    public function payment()
    {
        $cate_product = DB::table('tbl_category')->where('category_status', '0')->orderBy('category_id', 'desc')->get();

        return view('pages.checkout.payment')->with('category', $cate_product);
    }
    public function logout_checkout(Request $request)
    {
        $meta_desc = "Chuyên bán máy ảnh và phụ kiện máy ảnh";
        $meta_keywords = "may anh, máy ảnh, phụ kiện,phu kien, phụ kiện máy ảnh, phu kien may anh";
        $url_canonical = $request->url();
        $meta_title = "LJShop.vn | Đăng nhập";
        Session::flush();
        return Redirect::to('/login-checkout')->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'));
    }
    public function login_customer(Request $request)
    {
        $meta_desc = "Chuyên bán máy ảnh và phụ kiện máy ảnh";
        $meta_keywords = "may anh, máy ảnh, phụ kiện,phu kien, phụ kiện máy ảnh, phu kien may anh";
        $url_canonical = $request->url();
        $meta_title = "LJShop.vn | Đăng nhập";
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = Customer::where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            return redirect()->back();
        } else {
            return Redirect::to('/login-checkout')->with(compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'))->with('message','Email hoặc mật khẩu không đúng !!!');
        }
    }
    public function order_place(Request $request)
    {
        //insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lí';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lí';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        //isert order_details
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if ($data['payment_method'] == 1) {
            echo 'Thanh toán online';
        } elseif ($data['payment_method'] == 2) {
            Cart::destroy();
            $cate_product = DB::table('tbl_category')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
            return view('pages.checkout.handcast')->with('category', $cate_product);
        }


        // return Redirect::to('/payment');
    }
    //Order admin

    public function view_order($orderId)
    {
        $this->check();
        $order_by_id = DB::table('tbl_order')
            ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
            ->select('tbl_order.*', 'tbl_customer.*', 'tbl_shipping.*', 'tbl_order_details.*')->where('tbl_order.order_id', $orderId)->first();

        $manager_order_by_id = view('admin.manager.view_order')->with('order_by_id', $order_by_id);
        return view('admin_layout')->with('admin.manager.view_order', $manager_order_by_id);
    }
    public function select_delivery_home(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = Province::where('matp', $data['ma_id'])->orderBy('maqh', 'asc')->get();
                $output .= '<option value="">---Chọn quận huyện---</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderBy('xaid', 'asc')->get();
                $output .= '<option value="">---Chọn xã phường---</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
        }
        echo $output;
    }
    public function caculate_fee(Request $request)
    {
        $data = $request->all();
        if ($data['matp']) {
            $feeship = FreeShip::where('fee_matp', $data['matp'])->where('fee_maqh', $data['maqh'])->where('fee_xaid', $data['xaid'])->get();
            if ($feeship) {
                $count_feeship = $feeship->count();
                if ($count_feeship > 0) {
                    foreach ($feeship as $key => $fee) {
                        Session::put('fee', $fee->fee_feeship);
                        Session::save();
                    }
                } else {
                    Session::put('fee', 20000);
                    Session::save();
                }
            }
        }
    }
    public function del_fee()
    {
        Session::forget('fee');
        return redirect()->back();
    }
    public function confirm_order(Request $request)
    {
        $data = $request->all();
        if (Session::get('cart') == true) {
            foreach (Session::get('cart') as $key => $cart) {
                $id = $cart['product_id'];
                // $coupon = $data['order_coupon'];
                // $fee = $data['order_fee'];
            }
            $checkProduct = Product::where('product_id', $id)->where('product_status', 0)->first();
            if (!$checkProduct) {
                 // $request->session()->forget('fee');
                // $request->session()->forget('coupon');
                // $request->session()->forget('cart');
                // $meta_desc = "Chuyên bán máy ảnh và phụ kiện máy ảnh";
                // $meta_keywords = "may anh, máy ảnh, phụ kiện,phu kien, phụ kiện máy ảnh, phu kien may anh";
                // $meta_title = "LJShop.vn | Trang chủ";
                // $url_canonical = $request->url();
                // $category = Category::where('category_status', '0')->orderBy('category_id', 'desc')->get();
                // $all_product = Product::where('product_status', '0')->orderBy('product_id', 'desc')->limit(12)->get();
                // $all_product_sale = Product::where('product_status', '0')->orderBy('product_price', 'asc')->limit(12)->get();
                // $all_banner = DB::table('tbl_banner')->where('banner_status', '0')->orderBy('banner_id', 'desc')->limit(4)->get();
                // $all_slider = DB::table('tbl_slider')->where('slider_status', '0')->orderBy('slider_id', 'desc')->limit(5)->get();
                // $all_sponsor = DB::table('tbl_sponsor')->where('sponsor_status', '0')->orderBy('sponsor_id', 'desc')->limit(4)->get();
                // $all_course = DB::table('tbl_course')->where('course_status', '0')->orderBy('course_id', 'desc')->limit(6)->get();
                // $all_activity = Activity::where('activity_status', '0')->orderBy('activity_id', 'desc')->limit(6)->get();
                // return view('pages.home')->with(compact('all_product_sale', 'category', 'all_product', 'all_banner', 'all_slider', 'all_sponsor', 'all_course', 'all_activity', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical'));
                dd('ko ton tai');
            } elseif ($cart['product_qty'] > $checkProduct->product_quantity) {
                $meta_desc = "Chuyên bán máy ảnh và phụ kiện máy ảnh";
                $meta_keywords = "may anh, máy ảnh, phụ kiện,phu kien, phụ kiện máy ảnh, phu kien may anh";
                $meta_title = "LJShop.vn | Trang chủ";
                $url_canonical = $request->url();
                // dd($url_canonical);
                $category = Category::where('category_status', '0')->orderBy('category_id', 'desc')->get();
                // $request->session()->forget('fee');
                return response()->json([
                    'status' => false
                ]);
                // $request->session()->forget('coupon');
                // $request->session()->forget('cart');
                return view('cart.cart_ajax', compact('meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'category'))->with('error', 'Trong kho không đủ số lượng bạn cần mua');
                // dd('KO du so luong');
                // $checkout = view('cart.cart_ajax',[
                //     'status'=>'Ko đủ số lượng',
                // ])->with(compact('meta_desc','meta_keywords','meta_title','url_canonical','category'))->render();
                // return response()->json(['view'=>$checkout]);
            } else {
                // // get coupon
                // if ($data['order_coupon'] != 'no') {
                //     $coupon = Coupon::where('coupon_code', $data['order_coupon'])->first();
                //     $coupon->coupon_used = $coupon->coupon_used . ',' . Session::get('customer_id');
                //     $coupon->coupon_times = $coupon->coupon_times - 1;
                    // $coupon_mail = $coupon->coupon_code;
                //     $coupon_condition = $coupon->coupon_condition;
                //     $coupon_number = $coupon->coupon_number;
                //     $coupon->save();
                // } else {
                //     $coupon_mail = 'Không có';
                // }
                // //get vận chuyển
                // $shipping = new Shipping();
                // $shipping->shipping_name = $data['shipping_name'];
                // $shipping->shipping_address = $data['shipping_address'];
                // $shipping->shipping_phone = $data['shipping_phone'];
                // $shipping->shipping_email = $data['shipping_email'];
                // $shipping->shipping_notes = $data['shipping_notes'];
                // $shipping->shipping_method = $data['shipping_method'];
                // $shipping->save();
                // $shipping_id = $shipping->shipping_id;
                // $checkout_code = substr(md5(microtime()), rand(0, 25), 9);
                // //get order
                // $order = new Order();
                // $order->customer_id = Session::get('customer_id');
                // $order->shipping_id = $shipping_id;
                // $order->order_status = 1;
                // $order->order_code  = $checkout_code;
                // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
                // $date_order = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
                // $order->created_at = $today;
                // $order->order_date = $date_order;
                // $order->save();
                // if (Session::get('cart') == true) {
                //     foreach (Session::get('cart') as $key => $cart) {
                //         $order_details = new OrderDetail();
                //         $order_details->order_code = $checkout_code;
                //         $order_details->product_id = $cart['product_id'];
                //         $order_details->product_name = $cart['product_name'];
                //         $order_details->product_price = $cart['product_price'];
                //         $order_details->product_sales_quantity = $cart['product_qty'];
                //         $order_details->product_coupon = $data['order_coupon'];
                //         $order_details->product_feeship = $data['order_fee'];
                //         $order_details->save();
                //     }
                // }
                dd('Thanh cong');
                //     $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
                //     //     $title_mail = "Đơn hàng xác nhận" . ' ' . $now;
                //     //     $customer = Customer::find(Session::get('customer_id'));
                //     //     $data['email'][] = $customer->customer_email;
                //     //     if (Session::get('cart') == true) {
                //     //         foreach (Session::get('cart') as $key => $cart_mail) {
                //     //             $cart_array[] = array(
                //     //                 'product_name' => $cart_mail['product_name'],
                //     //                 'product_price' => $cart_mail['product_price'],
                //     //                 'product_qty' => $cart_mail['product_qty'],
                //     //             );
                //     //         }
                //     //     }
                //     //     if (Session::get('fee') == true) {
                //     //         $fee = Session::get('fee');
                //     //     } else {
                //     //         $fee = 20000;
                //     //     }

                //     //     $shipping_array = array(
                //     //         'fee' => $fee,
                //     //         'customer_name' => $customer->name,
                //     //         'shipping_name' => $data['shipping_name'],
                //     //         'shipping_email' => $data['shipping_email'],
                //     //         'shipping_phone' => $data['shipping_phone'],
                //     //         'shipping_address' => $data['shipping_address'],
                //     //         'shipping_notes' => $data['shipping_notes'],
                //     //         'shipping_method' => $data['shipping_method'],
                //     //     );
                //     //     $ordercode_mail = array(
                //     //         'coupon_code' => $coupon_mail,
                //     //         'order_code' => $checkout_code,
                //     //         // 'coupon_number'=> $coupon_number,
                //     //         // 'coupon_condition'=> $coupon_condition,
                //     //     );
                //     //     Mail::send('pages.mail.mail_order', ['cart_array' => $cart_array, 'shipping_array' => $shipping_array, 'code' => $ordercode_mail], function ($message) use ($title_mail, $data) {
                //     //         $message->to($data['email'])->subject($title_mail);
                //     //         $message->from($data['email'], $title_mail);
                //     //     });
                //     //     Session::forget('coupon');
                //     //     Session::forget('fee');
                //     //     Session::forget('cart');
            }
        }
    }
    public function mailOrder()
    {
        return view('pages.mail.mail_order');
    }
}
