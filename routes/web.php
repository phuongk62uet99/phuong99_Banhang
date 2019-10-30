<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


*/

// Route::get('/', function () {
//     return view('layout');
// });

// Route::get('/trang-chu', function () {
//     return view('layout');
// });

// Font end 



Route::get('/', 'HomeController@index');
Route::get('/trang-chu', 'HomeController@index');
Route::post('/tim-kiem', 'HomeController@search');

// Danh Mục sản phẩm trang chủ
// ---------------------------------------------------------
Route::get('/danh-muc-san-pham/{category_id}', 'CategoryProduct@show_category_home');

Route::get('/thuong-hieu-san-pham/{brand_id}', 'BrandProduct@show_brand_home');
// chi tiết sản phẩm 
Route::get('/chi-tiet-san-pham/{product_id}', 'ProductController@details_product');


// -------------------------------------------------------------------------
// Backend 
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
// Đăng nhập 
Route::post('/admin-dashboard', 'AdminController@dashboard');
// Đăng xuất 
Route::get('/logout', 'AdminController@logout');

// Chú thích về Hàm Route::get('/_Đường dẫn ở trong html', '_COntroller mà bạn đã tạo để gọi hàm@Hàm mà bạn muốn gọi đến');
// Thì 'all'
//---------------------------------------------------------------------------------------------------------------------
// 1 Category Product// Chính 
Route::get('/all-category-product', 'CategoryProduct@all_category_product');
Route::get('/add-category-product', 'CategoryProduct@add_category_product');
// Hàm sửa và xóa 
//Lấy ID thì nó biết sửa xóa ở đâu , lấy ở hàm All line 84 89
Route::get('/edit-category-product/{category_product_id}', 'CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_category_product');

// Sử lý hiệu ứng like và dislike
// Khai báo biến ID như /{category_product_id} tên ntn cũng được chứ ý không sử dụng $ vì no là tham số 
//không phải biến nếu không sẽ bị sai
Route::get('/unactive-category-product/{category_product_id}', 'CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'CategoryProduct@active_category_product');

Route::post('/save-category-product', 'CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}', 'CategoryProduct@update_category_product');


// -------------------------------------------------------------------------------------------------------
// 2 brand Product// Chính 
Route::get('/all-brand-product', 'BrandProduct@all_brand_product');
Route::get('/add-brand-product', 'BrandProduct@add_brand_product');
// Hàm sửa và xóa 
//Lấy ID thì nó biết sửa xóa ở đâu , lấy ở hàm All line 84 89
Route::get('/edit-brand-product/{brand_product_id}', 'BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}', 'BrandProduct@delete_brand_product');

// Sử lý hiệu ứng like và dislike
// Khai báo biến ID như /{brand_product_id} tên ntn cũng được chứ ý không sử dụng $ vì no là tham số 
//không phải biến nếu không sẽ bị sai
Route::get('/unactive-brand-product/{brand_product_id}', 'BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}', 'BrandProduct@active_brand_product');

Route::post('/save-brand-product', 'BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}', 'BrandProduct@update_brand_product');


// -------------------------------------------------------------------------------------------------------
// 3  Product// Chính /// Sản phẩm
Route::get('/all-product', 'ProductController@all_product');
Route::get('/add-product', 'ProductController@add_product');
// Hàm sửa và xóa 
//Lấy ID thì nó biết sửa xóa ở đâu , lấy ở hàm All line 84 89
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');

// Sử lý hiệu ứng like và dislike
// Khai báo biến ID như /{product_id} tên ntn cũng được chứ ý không sử dụng $ vì no là tham số 
//không phải biến nếu không sẽ bị sai

Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product');

Route::post('/save-product', 'ProductController@save_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');


// -----------------------------------------------------------------------
// Lamf rỏ hàng 
Route::post('/save-cart', 'CartController@save_cart');
Route::post('/update-cart-quantity', 'CartController@update_cart_quantity');


Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');

// ------------------------------------------------------------
// Checkout



Route::get('/login-checkout', 'CheckoutController@login_checkout');
Route::get('/logout-checkout', 'CheckoutController@logout_checkout');
Route::post('/add-customer', 'CheckoutController@add_customer');
Route::post('/login-customer', 'CheckoutController@login_customer');
Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/save-checkout-customer', 'CheckoutController@save_checkout_customer');
