<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

//Thư viện  Yeu cầu suwr dụng DB
use DB;


class ProductController extends Controller
{
    //  public function add_product() sai , xem lại vì sao sai
    // {
    // 	# code...
    // 	// Lấy mảng $cate_product ở csdl lưu vào $cate_product
    // 	$cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
    // 	$product = DB::table('tbl_product')->orderby('product_id', 'desc')->get();

    //     return view('admin.add_product')->with('cate_product', $cate_product)->with('product', $product);

    // 	return view('admin.add_product');
    // }
   public function add_product()
   {
        # code...
        // Nó lấy ra tất cả danh mục 
        // Lấy mảng $cate_product ở csdl lưu vào $cate_product
    $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
    $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();

    return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);

}
public function all_product()
{
    	# code...
        // Hiển thị tất cả sản phẩm trên views , Họ lấy hàm $all_product sau đó đưa vào lòng lặp foreach để duyệt kia nhé 
    $all_product = DB::table('tbl_product')
    ->join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
    ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
    ->orderby('tbl_product.product_id', 'desc')->get();
    $manager_product = view('admin.all_product')->with('all_product', $all_product);
    return view('admin_layout')->with('admin.all_product', $manager_product);

}
public function save_product(Request $request)
{
        # code...
        // Bước lấy cơ sở dữ liệu vào mảng data các trường dữ liệu sau đó hiển thị lên bảng
    $data = array();
    $data['product_name'] = $request->product_name;
    $data['product_price'] = $request->product_price;
    $data['product_desc'] = $request->product_desc;
    $data['product_content'] = $request->product_content;
        // Chú ý 2 cái này khác 
    $data['category_id'] = $request->product_cate;
    $data['brand_id'] = $request->product_brand;
    $data['product_status'] = $request->product_status;
    $data['product_image'] = $request->product_status;
    $get_image =$request->file('product_image');

    if($get_image){
            //Nó sẽ lấy tên của ảnh lên cho nó chuẩn Ví dụ // phuong.jpg
        $get_name_image = $get_image->getClientOriginalName();
            // Hàm explode('.', string) nó sẽ phân tách chuỗi c. sẽ tách chuỗi , còn curent nó sẽ lấy chuỗi đầu tiên được lấy trong kia 
        $name_image = current(explode('.', $get_name_image));
        	// Hàm này lấy đuôi ảnh mở rộng của các ảnh
        $new_image =$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        	// Upload ảnh lên thư mục public/uploads/product
        $get_image->move('public/uploads/product', $new_image);
        $data['product_image']  = $new_image;

        DB::table('tbl_product')->insert($data);
	        // đưa ra thông báo 
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('add-product');
    }
    $data['product_image'] = '';
        // Thêm dữ liệu vào bảng csdl
    DB::table('tbl_product')->insert($data);
        // đưa ra thông báo 
    Session::put('message', 'Thêm sản phẩm thành công');
    return Redirect::to('all-product');
}


public function unactive_product($product_id)
{
        # code...
       
    DB::table('tbl_product')->where('product_id', $product_id) ->update(['product_status'=>1]);
    Session::put('message', 'Không kích hoạt sản phẩm thành công');
    return Redirect::to('all-product');

}
public function active_product($product_id)
{
        # code...
  DB::table('tbl_product')->where('product_id', $product_id) ->update(['product_status'=>0]);
  Session::put('message', 'kích hoạt sản phẩm thành công');
  return Redirect::to('all-product');
}

public function edit_product($product_id)
{
        # code...
        // Lấy mảng $cate_product ở csdl lưu vào $cate_product , chú ý bắt buộc có 2 hàm này
    $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
    $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        // ----------------------
    $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
         // Lệnh get lấy ra duwx lieeuj sản phảm duy nhất
    $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    return view('admin_layout')->with('admin.edit_product', $manager_product);

}

public function update_product(Request $request, $product_id)
{
        # code...
    $data = array();
    $data['product_name'] = $request->product_name;
    $data['product_price'] = $request->product_price;
    $data['product_desc'] = $request->product_desc;
    $data['product_content'] = $request->product_content;
        // Chú ý 2 cái này khác 
    $data['category_id'] = $request->product_cate;
    $data['brand_id'] = $request->product_brand;
    $data['product_status'] = $request->product_status;
    $get_image = $request->file('product_image');
    if($get_image){
                //Nó sẽ lấy tên của ảnh lên cho nó chuẩn Ví dụ // phuong.jpg
        $get_name_image = $get_image->getClientOriginalName();
                // Hàm explode('.', string) nó sẽ phân tách chuỗi c. sẽ tách chuỗi , còn curent nó sẽ lấy chuỗi đầu tiên được lấy trong kia 
        $name_image = current(explode('.', $get_name_image));
                // Hàm này lấy đuôi ảnh mở rộng của các ảnh
        $new_image =$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                // Upload ảnh lên thư mục public/uploads/product
        $get_image->move('public/uploads/product', $new_image);
        $data['product_image']  = $new_image;

        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
                // đưa ra thông báo 
        Session::put('message', 'cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
            // Thêm dữ liệu vào bảng csdl
    DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            // đưa ra thông báo 
    Session::put('message', 'Cập nhật sản phẩm thành công');
    return Redirect::to('all-product');
}

    // Request $request lấy yêu cầu dữ liệu 
public function delete_product($product_id)
{
        # code...
    DB::table('tbl_product')->where('product_id', $product_id)->delete();
    Session::put('message', 'Xóa sản phẩm thành công');
    return Redirect::to('all-product');
}
    // End admin
public function details_product($product_id)
{
        # code...
   $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
   $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        // Tất cả các sản phẩm lấy ở bảng tbl_product
   $details_product = DB::table('tbl_product')
          // ở bảng danh mục sp , id danh mục sp = id của sản phẩm 
   ->join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
        // ở bảng thương hiệu , id thương hiệu( ở bảng thương hiệu) = id thương hiệu( ở bảng sản phẩm )
   ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        // ở bảng sản phẩm id sản phẩm = id truyền vào 
   ->where('tbl_product.product_id', $product_id)->get();

       foreach($details_product as $key => $value){
        $category_id = $value ->category_id;
        }


        $related_product = DB::table('tbl_product')
                  // ở bảng danh mục sp , id danh mục sp = id của sản phẩm 
        ->join('tbl_category_product','tbl_category_product.category_id', '=', 'tbl_product.category_id')
                // ở bảng thương hiệu , id thương hiệu( ở bảng thương hiệu) = id thương hiệu( ở bảng sản phẩm )
        ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
                // ở bảng sản phẩm id sản phẩm = id truyền vào , chú ý hàm WhereNotIn('tbl_product.product_id', [$product_id]) để trừ ra sản phẩm chính , phải có mảng ở id
        ->where('tbl_category_product.category_id', $category_id)->WhereNotIn('tbl_product.product_id', [$product_id])->get();

        return view('pages.sanpham.show_details')->with('category', $cate_product)->with('brand', $brand_product)->with('product_details', $details_product)->with('relate', $related_product);
        }

}
