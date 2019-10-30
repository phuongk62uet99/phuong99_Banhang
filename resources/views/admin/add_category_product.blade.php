
@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm danh mục sản phẩm
                        </header>
                        <div class="panel-body">

							<?php
						$message = Session::get('message');
						if($message){
							echo '<span class = "text-alert">' .$message. '</span>';
							//Gán cho message bằng null
							Session::put('message', null);
						}
					?>

                            <div class="position-center">
                                <form role="form" method="post" action="{{URL::to('/save-category-product')}}">
                                	{{ csrf_field()}}
	                                <div class="form-group">
	                                    <label for="exampleInputEmail1">Tên danh mục sản phẩm</label>
	                                    <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
	                                </div>
	                                <div class="form-group">
	                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
	                                    <textarea style="resize: none" rows="10" class="form-control" id="exampleInputPassword1" name="category_product_desc" placeholder="Mô tả danh mục"></textarea>
	                                </div>
	                                <div class="form-group">
	                                	<label for="exampleInputEmail1">Hiển thị</label>
{{-- 	                                	Cac form đều có name để truy suất csdl --}}
	                                   <select name="category_product_status" class="form-control input-sm m-bot15">
			                                <option value="0">Ẩn</option>
			                                <option value = "1">Hiển thi</option>
			                            </select>
	                                </div>
                                
                               	 	<button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                            	</form>
                            </div>

                        </div>
                    </section>
            </div>
 @endsection