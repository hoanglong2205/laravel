@extends('admin')
@section('header-title')
  <section class="content-header">
      <h1>
        Order Details
        <small>Orders number: {{$order->id}}</small>
      </h1>
    </section>
@endsection

@section('content')
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-globe"></i> Order Details
        <small class="pull-right">Day created: {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      User details:
      <address>
        <strong>Name: {{$order->user->name}}</strong><br>
        Email: {{$order->user->email}}<br>
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <br>
      <b>Order ID:</b> {{$order->id}}<br>
      <b>Status:</b> {{$order->status}}<br>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th>Product ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Qty</th>
          <th></th>
          <th>Price</th>
          <th></th>
          <th>Total</th>
        </tr>
        </thead>
        @foreach ($order->products as $product)
        <tbody>
        <tr>
          <td>{{$product->id}}</td>
          <td>{{$product->name}}</td>
          <td>{{$product->description}}</td>
          <td>{{$product->pivot->quantity}}</td>
          <td>x</td>
          <td>${{$product->price}}</td>
          <td>=</td>
          <td>${{$product->pivot->quantity * $product->price}}</td>
        </tr>
        </tbody>
        @endforeach
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-6">
      <p class="lead">Payment Methods:</p>
      <img src="{{asset ('/bower_components/admin-lte/dist/img/credit/visa.png')}}" alt="Visa">
      <img src="{{asset ('/bower_components/admin-lte/dist/img/credit/mastercard.png')}}" alt="Mastercard">
      <img src="{{asset ('/bower_components/admin-lte/dist/img/credit/american-express.png')}}" alt="American Express">
      <img src="{{asset ('/bower_components/admin-lte/dist/img/credit/paypal2.png')}}" alt="Paypal">

      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        {{$order->description}}
      </p>
    </div>
    <!-- /.col -->
    <div class="col-xs-6">
      <p class="lead">Amount</p>

      <div class="table-responsive">
        <table class="table">
          <tr>
            <th style="width:50%">Subtotal:</th>
            <td>${{$total}}</td>
          </tr>
          <tr>
            <th>Tax (5%)</th>
            <td>${{$total/100*5}}</td>
          </tr>
          <tr>
            <th>Total:</th>
            <td>${{$total/100*105}}</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <!-- <div class="row no-print">
    <div class="col-xs-12">
      <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
      <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
      </button>
      <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
        <i class="fa fa-download"></i> Generate PDF
      </button>
    </div>
  </div> -->
</section>
@endsection