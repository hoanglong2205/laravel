@extends('layouts.layout')
@section('head')
@parent
<link href="{{ asset('css/style.css') }}" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pricing Tables Design ,Flat Pricing Tables Design ,Popup Pricing Tables Design,Clean Pricing Tables Design "./>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!--webfonts-->
<link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts-->
</head>
@endsection

@section('content')
<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
<script type="text/javascript" src="js/modernizr.custom.53451.js"></script> 

 <script>
		$(document).ready(function() {
		$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
																		
		});
</script>							
<div class="pricing-plans">
	<div class="wrap">
		<div class="pricing-grids">
		<div class="pricing-grid1 col-sm-offset-1">
			<div class="price-value">
				<h2><a href="#">The Dark side of the Force</a></h2>
				@if (Session::has('product1'))
				<h5><span>$ {{Session::get('product1')->price}}</span></h5>
				<div class="sale-box">
				</div>
			</div>
			<div class="price-bg">
			<ul>
				<li><img src="{{asset('images/' . Session::get('product1')->image)}}"></li>
				<li><a href="{{ route('product.show',Session::get('product1')->id) }}">{{Session::get('product1')->name}} </a></li>
				<li class="whyt"><a href="{{ route('product.show',Session::get('product1')->id) }}">{{Session::get('product1')->description}}</a></li>
			</ul>
			<div class="cart1">
				<a class="popup-with-zoom-anim" href="{{ route('addCart', Session::get('product1')->id) }}">Add to cart</a>
			</div>
			<div class="cart2">
				<a class="popup-with-zoom-anim" href="{{ route('remvoveFromCompare', Session::get('product1')->id) }}">Remove from compare</a>
			</div>
			@endif
			</div>
		</div>
		<!-- <div class="pricing-grid2">
			<div class="price-value two">
				<h3><a href="#">STANDARD</a></h3>
				<h5><span>$ 29.99</span><lable> / month</lable></h5>
				<div class="sale-box two">
			<span class="on_sale title_shop">NEW</span>
			</div>

			</div>
			<div class="price-bg">
			<ul>
				<li class="whyt"><a href="#">10GB Disk Space </a></li>
				<li><a href="#">20 Domain Names</a></li>
				<li class="whyt"><a href="#">10 E-Mail Address </a></li>
				<li><a href="#">100GB Monthly Bandwidth </a></li>
				<li class="whyt"><a href="#">Fully Support</a></li>
			</ul>
			<div class="cart2">
				<a class="popup-with-zoom-anim" href="#small-dialog">Purchase</a>
			</div>
			</div>
		</div> -->
		<div class="pricing-grid3 col-sm-offset-2">
			<div class="price-value three">
				<h4><a href="#">The Light side of the Force</a></h4>
				@if (Session::has('product2'))
				<h5><span>$ {{Session::get('product2')->price}}</span></h5>
				<div class="sale-box three">
				</div>
			</div>
			<div class="price-bg">
			<ul>
				<li><img src="{{asset('images/' . Session::get('product2')->image)}}"></li>
				<li><a href="{{ route('product.show',Session::get('product2')->id) }}">{{Session::get('product2')->name}} </a></li>
				<li class="whyt"><a href="{{ route('product.show',Session::get('product2')->id) }}">{{Session::get('product2')->description}}</a></li>
			</ul>
			<div class="cart3">
				<a class="popup-with-zoom-anim" href="{{ route('addCart', Session::get('product2')->id) }}">Add to cart</a>
			</div>
			<div class="cart2">
				<a class="popup-with-zoom-anim" href="{{ route('remvoveFromCompare', Session::get('product2')->id) }}">Remove from compare</a>
			</div>
			@endif
			</div>
		</div>
		<div class="clear"> </div>
			
		<div class="clear"> </div>

	</div>

</div>
@endsection

@section('script')
@parent
<script src='https://preview.w3layouts.com/demos/flat_pricing_tables_design/web/js/jquery.magnific-popup.js'></script>
<script src='https://preview.w3layouts.com/demos/flat_pricing_tables_design/web/js/modernizr.custom.53451.js'></script>
@endsection
