<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Thư viện khi bạn muốn dung Session
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();



//Thư viện  Yeu cầu suwr dụng DB
use DB;

class AdminController extends Controller
{
    //
    public function index()
    {
    	# code...
    	return view('admin_login');
    }
    public function show_dashboard()
    {
    	# code...
    	return view('admin.dashboard');
    }



    // Tinhs năng đăng nhập chú ý 
    public function dashboard(Request $request)
    {
        # code...

        // Lấy 2 email và pass ở form kia vào biến 
        $admin_email = $request->admin_email;
        $admin_password= md5($request->admin_password);

        // đi vào db dể kiểm tra từng bảng . first(); là lấy giới hạn 1 user
        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        //return view('admin.dashboard');
        if( $result){
            Session::put('admin_name', $result->admin_name);
             Session::put('admin_id', $result->admin_id);
             return Redirect::to('/dashboard');
        }else{
             Session::put('message', 'Mật khẩu hoặc tài khoản bị sai. Làm ơn bạn nhập lại');
             return Redirect::to('/admin');
        }
    }

     public function logout()
    {
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }

}
