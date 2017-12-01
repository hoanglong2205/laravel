@extends('layouts.layout')
@section('content')
	<section>
        <section>
        	<div class="container">
                <div class="row">
                	<div class="col-sm-12">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">Your Wishlist</h2>
                            @foreach ($products as $product)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{ asset('images/'. $product->image) }}" alt="" />
                                                <h2>${{$product->price}}</h2>
                                                <p>{{$product->name}}</p>
                                                <a href="{{ route('addCart', $product->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <a href="{{ route('product.show', $product->id) }}">
                                                        <h2>${{$product->price}}</h2>
                                                        <p>{{$product->name}}</p>
                                                    </a>
                                                    <a href="{{ route('addCart', $product->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                        @if (Auth::user())
                                            @if (!Auth::user()->products()->where('product_id',$product->id)->exists())
                                                <li><a href="{{ route('addToWishList',$product->id) }}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            @else
                                                <li><a href="{{ route('removeFromWithList',$product->id) }}"><i class="fa fa-minus-square"></i>Remove from wishlist</a></li>
                                            @endif
                                        @else
                                            <li><a href="{{ route('addToWishList',$product->id) }}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        @endif
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div><!--features_items-->
                        <div class="text-center">
                            {{$products->links()}}
                        </div>
                        <!-- <div class="category-tab">
                            
                            <div class="col-sm-12">
                                <ul class="nav nav-tabs">
                                @foreach (App\Category::all() as $category)
                                    @if ($category->id == App\Category::first()->id)
                                    <li class="active">
                                    @else
                                    <li>
                                    @endif
                                    <a href="#{{$category->id}}" data-toggle="tab">{{$category->name}}</a></li>
                                @endforeach
                                </ul>
                            </div>
                            <div class="tab-content">
                            @foreach (App\Category::all() as $category)
                                    @if ($category->id == App\Category::first()->id)
                                    <div class="tab-pane fade active in" id="{{$category->id}}" >
                                    @else
                                    <div class="tab-pane fade" id="{{$category->id}}" >
                                    @endif
                                
                                    @foreach ($category->products->take(4) as $product)
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{asset('images/'. $product->image)}}" alt="" />
                                                    <h2>${{$product->price}}</h2>
                                                    <p>{{$product->description}}</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endforeach
                            </div>
                        </div> -->
                        
                    </div>
                </div>
            </div>
        </section>
    </section>


@endsection