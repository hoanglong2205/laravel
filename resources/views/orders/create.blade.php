@extends('layouts.layout')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
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
						{{ Form::open(array('route' => 'orders.store')) }}
						<div class="order-message">
							<p>Shipping Order/ Description</p>
							{{Form::textarea('description', null, array('placeholder' => 'Description...', 'rows'=>'16', 'required'))}}
						</div>
						{{Form::submit('Continue', array('class' => 'btn btn-primary'))}}
						{{ Form::close() }}
					</div>					
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
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
						@foreach ($cart->items as $product)
							<tr>
								<td class="cart_product">
									<a href=""><img src="{{asset('images/' . $product['item']['image'])}}" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{$product['item']['name']}}</a></h4>
								</td>
								<td class="cart_price">
									<p>${{$product['item']['price']}}</p>
								</td>
								<td class="cart_quantity">
				                    <div class="cart_quantity_button">
				                      <input class="cart_quantity_input" type="text" name="quantity" value="{{$product['quantity']}}" autocomplete="off" size="2" disabled >
				                    </div>
				                </td>
								<td class="cart_total">
									<p class="cart_total_price">${{$product['price']}}</p>
								</td>
							</tr>
						@endforeach

						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>${{$cart->totalPrice}}</td>
									</tr>
									<tr>
										<td>Tax</td>
										<td>${{$cart->totalPrice / 100 * 5 }}</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>${{$cart->totalPrice /100 * 105}}</span></td>
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