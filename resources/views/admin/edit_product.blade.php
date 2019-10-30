
@extends('admin_layout')
@section('admin_content')

<div class="row">

            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật sản phẩm
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
                            	@foreach( $edit_product as $key => $pro)
                            	{{-- Lấy ID để update --}}
                                <form role="form" method="post" action="{{URL::to('/update-product/'.$pro->product_id)}}" enctype="multipart/form-data">
                                	{{ csrf_field()}}
	                                <div class="form-group">
	                                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>{{-- 
	                                    value sẽ đưa tên sp vào  --}}
	                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}">
	                                </div>
	                                <div class="form-group">
	                                    <label for="exampleInputEmail1">Giá Sản Phẩm</label>
	                                    <input type="text" value="{{$pro->product_price}}" name="product_price" class="form-control" id="exampleInputEmail1" >
	                                </div>
	                                <div class="form-group">
	                                    <label for="exampleInputEmail1">Hình ảnh Sản Phẩm</label>
	                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" >
	                                    {{-- Lấy hỉnh ảnh gán vào product_image --}}
	                                    <img src="{{URL::to('public/uploads/product'.$pro->product_image)}}" alt="" height="100" width="100">
	                                </div>

	                           
	                                <div class="form-group">
	                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
	                                    <textarea style="resize: none" rows="8" class="form-control" id="exampleInputPassword1" name="product_desc" >{{$pro->product_desc}}</textarea>
	                                </div>
	                                <div class="form-group">
	                                    <label for="exampleInputPassword1">Nội dung Sản Phẩm</label>
	                                    <textarea style="resize: none" rows="10" class="form-control" id="exampleInputPassword1" name="product_content" placeholder="Nội dung sản phẩm">{{$pro->product_content}}</textarea>
	                                </div>
	                                {{-- <div class="form-group">
	                                    <label for="exampleInputPassword1">Hiển thị</label>
	                                    <textarea style="resize: none" rows="10" class="form-control" id="exampleInputPassword1" name="product_status" placeholder="Mô tả danh mục"></textarea>
	                                </div> --}}
	                                 <div class="form-group">
	                                	<label for="exampleInputEmail1">Danh mục sản phẩm</label>
{{-- 	                                	Cac form đều có name để truy suất csdl --}}
	                                   <select name="product_cate" class="form-control input-sm m-bot15">
			                                @foreach($cate_product as $key => $cate)
												@if($cate ->category_id == $pro->category_id)
				                                <option selected value = "{{$cate -> category_id}}">{{$cate -> category_name}}</option>
												@else
												<option value = "{{$cate -> category_id}}">{{$cate -> category_name}}
													@endif
			                                @endforeach
			                            </select>
	                                </div>
	                                 <div class="form-group">
	                                	<label for="exampleInputEmail1">Thương hiệu</label>
{{-- 	                                	Cac form đều có name để truy suất csdl --}}
	                                   <select name="product_brand" class="form-control input-sm m-bot15">
	                                   	 	@foreach($brand_product as $key => $brand)
	                                   	 		@if($cate ->category_id == $pro->category_id)
			                                	<option selected value="{{$brand -> brand_id}}">{{$brand -> brand_name}}</option>
			                                	@else 
			                                	<option value="{{$brand -> brand_id}}">{{$brand -> brand_name}}</option>
			                                	@endif
			                                @endforeach
			                            </select>
	                                </div>
	                                <div class="form-group">
	                                	<label for="exampleInputEmail1">Hiển thị</label>
{{-- 	                                	Cac form đều có name để truy suất csdl --}}
	                                   <select name="product_status" class="form-control input-sm m-bot15">
			                                <option value="0">Ẩn</option>
			                                <option value = "1">Hiển thi</option>
			                            </select>
	                                </div>
                                
                               	 	<button type="submit" name="add_product" class="btn btn-info">Cập nhật sản Phẩm</button>
                            	</form>
                            	@endforeach
                            </div>

                        </div>
                    </section>
            </div>
 @endsection