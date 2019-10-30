@extends('layout')
@section('content')


<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				<li class="active">Thanh toan giỏ  </li>
			</ol>
		</div><!--/breadcrums-->

		

		<div class="register-req">
			<p>Lamf ơn đăng kí tài khoản để sử dụng các tính năng hưu ích hơn </p>
		</div><!--/register-req-->

		<div class="shopper-informations">
			<div class="row">
				
				<div class="col-sm-10 clearfix">
					<div class="bill-to">
						<p> Điền thông tin khách hàng</p>
						<div class="form-one">
							<form action="{{URL::to('/save-checkout-customer')}}" method="POST">
								{{ csrf_field() }}
								<input type="text" name="shipping_email" placeholder="Email">
								<input type="text" name="shipping_name" placeholder="Họ và tên">
								<input type="text" name="shipping_address" placeholder="Địa chỉ">
								<input type="text" name="shipping_phone" placeholder="Phone">
								<textarea  name="shipping_notes"  placeholder="Ghi chú đơn hàng" rows="16"></textarea>
								<input type="submit" value="Gửi" name="send_oder" class="btn btn-primary btn-sm">
							</form>
						</div>
						<div class="form-two">
							{{--  --}}
						</div>
					</div>
				</div>
				{{-- <div class="col-sm-4">
					<div class="order-message">
						<p>GHi chú gửi hàng</p>
						<textarea name="message"  placeholder="Ghi chú đơn hàng" rows="16"></textarea>
					</div>	
				</div> --}}					
			</div>
		</div>
		<div class="review-payment">
			<h2>Xem lại giỏ hàng</h2>
		</div>

		<div class="table-responsive cart_info">
			{{--  --}}
		</div>
		<div class="payment-options">
			<span>
				<label><input type="checkbox"> Direct Bank Transfer</label>
			</span>
			<span>
				<label><input type="checkbox"> Check Payment</label>
			</span>
			<span>
				<label><input type="checkbox"> Paypal</label>
			</span>
		</div>
	</div>
</section> <!--/#cart_items-->


@endsection