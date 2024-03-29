<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Bai 6 tao controller va sử dụng hàm sẽ ở web.php ( nó ở views)


use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

//Thư viện  Yeu cầu suwr dụng DB
use DB;


class HomeController extends Controller
{
    //
    public function index()
    {
    	# code...
    	 // Nó lấy ra tất cả danh mục 
        // Lấy mảng $cate_product ở csdl lưu vào $cate_product
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        //  $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        // ->orderby('tbl_product.product_id', 'desc')->get();


          $all_product = DB::table('tbl_product')->where('product_status', '0')->orderby('product_id', 'desc')->limit(5)->get();
    	return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product);
    	// Trong laravel thif dungf . 
    }
    public function search(Request $request)
    {
        $keywords = $request->keywords_submit;
           $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        //  $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        // ->orderby('tbl_product.product_id', 'desc')->get();


          $search_product = DB::table('tbl_product')->where('product_name', 'like', '%'.$keywords.'%')->get();
        return view('pages.sanpham.search')->with('category', $cate_product)->with('brand', $brand_product)->with('search_product', $search_product);
    }
}
