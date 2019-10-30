{{-- Mục tiêu là để sửa danh mục  --}}
@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật danh mục sản phẩm
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

							@foreach($edit_category_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" method="post" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}">
                                	{{ csrf_field()}}
	                                <div class="form-group">
	                                    <label for="exampleInputEmail1">Tên danh mục sản phẩm</label>{{-- 
	                                    Lấy za tên  --}}
	                                    <input type="text" value="{{$edit_value->category_name}}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
	                                </div>
	                                <div class="form-group">
	                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
	                                    <textarea style="resize: none" rows="10" class="form-control" id="exampleInputPassword1" name="category_product_desc" placeholder="Mô tả danh mục">
	                                    	{{-- Lấy za mô tả sản phẩm  --}}
	                                    	{{$edit_value->category_desc}}
	                                    </textarea>
	                                </div>
                                
                               	 	<button type="submit" name="updata_category_product" class="btn btn-info">Cập nhật danh mục</button>
                            	</form>
                            </div>
							@endforeach
                        </div>
                    </section>
            </div>
 @endsection