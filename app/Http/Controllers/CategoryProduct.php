<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

//Thư viện  Yeu cầu suwr dụng DB
use DB;

class CategoryProduct extends Controller
{
    //

    public function add_category_product()
    {
    	# code...
    	return view('admin.add_category_product');


    }
    public function all_category_product()
    {
    	# code...
        // Hiển thị tất cả sản phẩm trên views
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);

    }
    public function save_category_product(Request $request)
    {
        # code...
        // Bước lấy cơ sở dữ liệu
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        
        // Thêm dữ liệu vào bảng csdl
        DB::table('tbl_category_product')->insert($data);
        // đưa ra thông báo 
        Session::put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }


    public function unactive_category_product($category_product_id)
    {
        # code...
        // Là mảng nên để []
        DB::table('tbl_category_product')->where('category_id', $category_product_id) ->update(['category_status'=>1]);
        Session::put('message', 'Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');

    }
    public function active_category_product($category_product_id)
    {
        # code...
      DB::table('tbl_category_product')->where('category_id', $category_product_id) ->update(['category_status'=>0]);
      Session::put('message', 'kích hoạt danh mục sản phẩm thành công');
      return Redirect::to('all-category-product');
  }

  public function edit_category_product($category_product_id)
  {
        # code...
   $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
         // Lệnh get lấy ra duwx lieeuj sản phảm duy nhất
   $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
   return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);

}

public function update_category_product(Request $request, $category_product_id)
{
        # code...
    $data = array();
    $data['category_name'] = $request->category_product_name;
    $data['category_desc'] = $request->category_product_desc;
    DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
    Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
    return Redirect::to('all-category-product');
}

    // Request $request lấy yêu cầu dữ liệu 
public function delete_category_product($category_product_id)
{
        # code...
    DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
    Session::put('message', 'Xóa danh mục sản phẩm thành công');
    return Redirect::to('all-category-product');
}
    // --------------------------------------------------------------------------------------------
    // Kết thức hàm của admin , đến hàm của Page
public function show_category_home($category_id)
{
        # code...

    $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
    $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        // Lấy nó sẽ chỉ lấy 1 tên danh mục sản phẩm 
    $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id', $category_id)->limit(1)->get();
    $category_by_id = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
    ->where('tbl_product.category_id', $category_id)->get();

    
    
    return view('pages.category.show_category')->with('category', $cate_product)->with('brand', $brand_product)->with('category_by_id', $category_by_id)->with('category_name', $category_name);
}

}
