@extends('admin_layout')
@section('admin_content')


<style>
   span.fa-thumb-styling.fa.fa-thumbs-down {
    font-size: 23px;
    color: red;
}
	 span.fa-thumb-styling.fa.fa-thumbs-up {
    font-size: 23px;
    color: green;
}
    i.fa.fa-pencil-square-o.text-success.text-active {
    font-size: 22px;
}
    i.fa.fa-times.text-danger.text {
    font-size: 22px;
}
    </style>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê  sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">

      <?php
            $message = Session::get('message');
            if($message){
              echo '<span class = "text-alert">' .$message. '</span>';
              //Gán cho message bằng null
              Session::put('message', null);
            }
          ?>


      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên Sản phẩm</th>
             <th>Giá Sản phẩm</th>
              <th>Hình ảnh  Sản phẩm</th>
               <th>Danh mục Sản phẩm</th>
                <th>Thương hiệu Sản phẩm</th>

            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
			@foreach($all_product as $key=> $pro)
		        <tr>
		            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                {{-- Tên sản phẩm --}}
		            <td>{{$pro->product_name}}</td>
{{--                 Giá sản phẩm  --}}
                 <td>{{$pro->product_price}}</td>
                 {{-- Hình ảnh sản phẩm --}}
                  <td><img src="public/uploads/product/{{$pro->product_image}}" height="100" width="100"></td>
                {{--   <td><img src="{{URL::to('public/uploads/product'.$pro->product_image)}}" alt="" height="100" width="100"></td> --}}
                  {{-- Danh mục sản phẩm  --}}
                  {{-- XEM LẠI 2 CÁI TÊN NAME NÀY  --}}
                   <td>{{$pro->category_name}}</td>

                  <td>{{$pro->brand_name}}</td>
		            <td><span class="text-ellipsis">
{{-- 		            	Chú ý đoạn gắn link php bên dưới  --}}

		            	<?php
		            		if ($pro->product_status == 0) {
		            			# code...
		            			?>
		            			<a href = "{{URL::to('/unactive-product/'.$pro->product_id)}}"><span class= "fa-thumb-styling fa fa-thumbs-up"></span></a>;
		            			<?php
		            			} else {
		            			# code...
		            			?>
{{--                       XEMMM  LẠI PHẢI SUAE $pro->product_id THÀNH PRO-P_ID) --}}
		            			<a href = "{{URL::to('/active-product/'.$pro->product_id)}}"><span class= "fa-thumb-styling fa fa-thumbs-down"></span></a>;
		            				<?php
		            		}
		            	?>
		            </span></td>
		            <td>
{{--                   thực hiện các thao tác thêm sửa xóa bạn phải lấy ID của nó  --}}
		              <a  href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i></a>
		              	<br>

{{--                     Sẽ đặt câu hỏi khi bạn chắc muốn xóa chứ  --}}
                    <a onclick = "return confirm('Bạn có chắc muốn xóa sản phẩm chứ')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
		              	<i class="fa fa-times text-danger text"></i></a>
		            </td>
		        </tr>
          	@endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

 @endsection