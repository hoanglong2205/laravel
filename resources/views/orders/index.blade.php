@extends('layouts.layout')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
	          <ol class="breadcrumb">
	            <li><a href="#">Home</a></li>
	            <li class="active">Shopping Cart</li>
	          </ol>
	        </div>
	        <div class="table-responsive cart_info">
	        	<table class="table table-condensed">
	        		<thead>
		              <tr class="cart_menu">
		                <th>Id (Order Number)</th>
		                <th></th>
		                <th>Description</th>
		                <th></th>
		                <th>Status</th>
		              </tr>
		            </thead>
		            <tbody>
		            	@foreach ($orders as $order)
		            		<tr>
		            			<td><a href="{{ route('orders.show',$order->id) }}">{{$order->id}}</a></td>
		            			<td></td>
		            			<td>{{$order->description}}</td>
		            			<td></td>
		            			<td>{{$order->status}}</td>
		            		</tr>
		            	@endforeach
		            </tbody>
	        	</table>
	        </div>
		</div>
	</section>
@endsection