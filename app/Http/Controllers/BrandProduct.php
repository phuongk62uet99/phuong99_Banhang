<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();



//Thư viện  Yeu cầu suwr dụng DB
use DB;


class BrandProduct extends Controller
{
    //

	
    public function add_brand_product()
    {
    	# code...
    	return view('admin.add_brand_product');


    }
    public function all_brand_product()
    {
    	# code...
        // Hiển thị tất cả sản phẩm trên views
        $all_brand_product = DB::table('tbl_brand')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);

    }
    public function save_brand_product(Request $request)
    {
        # code...
        // Bước lấy cơ sở dữ liệu
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        
        // Thêm dữ liệu vào bảng csdl
        DB::table('tbl_brand')->insert($data);
        // đưa ra thông báo 
        Session::put('message', 'Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('add-brand-product');
    }


    public function unactive_brand_product($bran_product_id)
    {
        # code...
        // Là mảng nên để []
        DB::table('tbl_brand')->where('brand_id', $bran_product_id) ->update(['brand_status'=>1]);
        Session::put('message', 'Không kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-bran-product');

            }
    public function active_brand_product($bran_product_id)
    {
        # code...
          DB::table('tbl_brand')->where('brand_id', $bran_product_id) ->update(['brand_status'=>0]);
          Session::put('message', 'kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-bran-product');
    }

    public function edit_brand_product($bran_product_id)
    {
        # code...
         $edit_brand_product = DB::table('tbl_brand')->where('brand_id', $bran_product_id)->get();
         // Lệnh get lấy ra duwx lieeuj sản phảm duy nhất
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);

    }

    public function update_brand_product(Request $request, $brand_product_id)
    {
        # code...
        $data = array();

        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update($data);
         Session::put('message', 'Cập nhật danh mục thương hiệu thành công');
        return Redirect::to('all-brand-product');
    }

    // Request $request lấy yêu cầu dữ liệu 
    public function delete_brand_product($bran_product_id)
    {
        # code...
        DB::table('tbl_brand')->where('brand_id', $bran_product_id)->delete();
        Session::put('message', 'Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }


// -----------------------------------------------------------------------------------------------------
    // Đến phần page hết admin
     public function show_brand_home($brand_id)
    {

        # code...

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
        ->where('tbl_product.brand_id', $brand_id)->get();
         $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id', $brand_id)->limit(1)->get();
        return view('pages.brand.show_brand')->with('category', $cate_product)->with('brand', $brand_product)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name);
    }


}
