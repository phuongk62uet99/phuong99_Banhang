<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

//Thư viện  Yeu cầu suwr dụng DB
use DB;
use Cart;


class CheckoutController extends Controller
{
    //
	public function login_checkout()
	{
    	# code...
		$cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
		$brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
		return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product);
	}
	public function add_customer(Request $request)
	{
        # code...
        // Bước lấy cơ sở dữ liệu vào mảng data các trường dữ liệu sau đó hiển thị lên bảng
		$data = array();
		$data['customer_name'] = $request->customer_name;
		$data['customer_phone'] = $request->customer_phone;
		$data['customer_email'] = $request->customer_email;
		$data['customer_password'] = md5($request->customer_password);

		$customer_id = DB::table('tbl_customers')->insertGetId($data);
		
		Session::put('customer_id',$customer_id );
		Session::put('customer_name', $request->customer_name);
		return Redirect::to('/checkout');



	}
	public function checkout()
	{
		# code...

		$cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
		$brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
		return view('pages.checkout.show_checkout')->with('category', $cate_product)->with('brand', $brand_product);

	}
	public function save_checkout_customer(Request $request)
	{
        # code...
        // Bước lấy cơ sở dữ liệu vào mảng data các trường dữ liệu sau đó hiển thị lên bảng
		$data = array();

		$data['shipping_name'] = $request->shipping_name;
		$data['shipping_phone'] = $request->shipping_phone;
		$data['shipping_email'] = $request->shipping_email;
		$data['shipping_notes'] = $request->shipping_notes;
		$data['shipping_address'] = $request->shipping_address;


		// <input type="text" name="shipping_email" placeholder="Email">
		// <input type="text" name="shipping_name" placeholder="Họ và tên">
		// <input type="text" name="shipping_address" placeholder="Địa chỉ">
		// <input type="text" name="shipping_phone" placeholder="Phone">
		// <textarea  name="shipping_notes"  placeholder="Ghi chú đơn hàng" rows="16"></textarea>
		// <input type="submit" value="Gửi" name="send_oder" class="btn btn-primary btn-sm">

		$shipping_id = DB::table('tbl_shipping')->insertGetId($data);

		Session::put('shipping_id',$shipping_id );
		return Redirect::to('/payment');
	}
	public function payment()
	{
		# code...
	}

	public function logout_checkout()
	{

	# code...
		Session::flush();
		return Redirect::to('/login-checkout');

	}
	public function login_customer(Request $request)
	{
		# code...
		
		$email = $request->email_account;
		$password = md5($request->password_account);
		$result = DB::table('tbl_customers')->where('customer_email', $email)->where('customer_password', $password)->first();
		if($request){
			Session::put('customer_id',$request->customer_id );
			return Redirect::to('/checkout');
		}
		else 
			return Redirect::to('/login-checkout');
	}

}
