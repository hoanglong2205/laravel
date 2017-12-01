@extends('layouts.layout')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">My Order</a></li>
				  <li class="active">Order {{ $order->id }}</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Order Details</h2>
			</div>

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form>
								<input type="text" value="{{ Auth::user()->name }}" disabled>
								<input type="text" value="{{ Auth::user()->email }}" disabled>
							</form>
						</div>
					</div>
					<div class="col-sm-5 clearfix">
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order/ Description</p>
							<textarea disabled>{{ $order->description }}</textarea>
						</div>
					</div>					
				</div>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($order->products()->get() as $product)
							<tr>
								<td class="cart_product">
									<a href=""><img src="{{asset('images/' . $product->image)}}" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{$product->name}}</a></h4>
								</td>
								<td class="cart_price">
									<p>${{$product->price}}</p>
								</td>
								<td class="cart_quantity">
				                    <div class="cart_quantity_button">
				                      <input class="cart_quantity_input" type="text" name="quantity" value="{{$product->pivot->quantity}}" autocomplete="off" size="2" disabled >
				                    </div>
				                </td>
								<td class="cart_total">
									<p class="cart_total_price">${{ $product->price * $product->pivot->quantity }}</p>
								</td>
							</tr>
						@endforeach

						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>${{$totalPrice}}</td>
									</tr>
									<tr>
										<td>Tax</td>
										<td>${{$totalPrice / 100 * 5 }}</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>${{$totalPrice /100 * 105}}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
@endsection