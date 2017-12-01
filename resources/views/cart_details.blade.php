@extends('layouts.layout')
@section('content')
  @if(Session::has('cart'))
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
                <th class="image">Item</th>
                <th class="description"></th>
                <th class="price">Price</th>
                <th class="quantity">Quantity</th>
                <th class="total">Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
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
                      <a href="{{ route('changeQuantity', [$product['item']['id'],-1]) }}" class="cart_quantity_up"> - </a>
                      <input class="cart_quantity_input" type="text" name="quantity" value="{{$product['quantity']}}" autocomplete="off" size="2">
                      <a class="cart_quantity_down" href="{{ route('changeQuantity', [$product['item']['id'],1]) }}"> + </a>
                    </div>
                  </td>
                  <td class="cart_total">
                    <p class="cart_total_price">${{$product['price']}}</p>
                  </td>
                  <td class="cart_delete">
                    <a class="cart_quantity_delete" href="{{ route('removeProduct', $product['item']['id']) }}"><i class="fa fa-times"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
      <div class="container">
        <div class="heading">
          <h3>What would you like to do next?</h3>
          <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="chose_area">
              <ul class="user_option">
                <li>
                  <input type="checkbox">
                  <label>Use Coupon Code</label>
                </li>
                <li>
                  <input type="checkbox">
                  <label>Use Gift Voucher</label>
                </li>
                <li>
                  <input type="checkbox">
                  <label>Estimate Shipping & Taxes</label>
                </li>
              </ul>
              <ul class="user_info">
                <li class="single_field">
                  <label>Country:</label>
                  <select>
                    <option>United States</option>
                    <option>Bangladesh</option>
                    <option>UK</option>
                    <option>India</option>
                    <option>Pakistan</option>
                    <option>Ucrane</option>
                    <option>Canada</option>
                    <option>Dubai</option>
                  </select>
                  
                </li>
                <li class="single_field">
                  <label>Region / State:</label>
                  <select>
                    <option>Select</option>
                    <option>Dhaka</option>
                    <option>London</option>
                    <option>Dillih</option>
                    <option>Lahore</option>
                    <option>Alaska</option>
                    <option>Canada</option>
                    <option>Dubai</option>
                  </select>
                
                </li>
                <li class="single_field zip-field">
                  <label>Zip Code:</label>
                  <input type="text">
                </li>
              </ul>
              <a class="btn btn-default update" href="">Get Quotes</a>
              <a class="btn btn-default check_out" href="">Continue</a>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="total_area">
              <ul>
                <li>Cart Sub Total <span>${{$totalPrice}}</span></li>
                <li>Tax 5%<span>${{$totalPrice / 100 * 5 }}</span></li>
                <li>Shipping Cost <span>Free</span></li>
                <li>Total <span>${{$totalPrice /100 * 105}}</span></li>
              </ul>
                <a class="btn btn-default update" href="">Update</a>
                <a class="btn btn-default check_out" href="{{ route('orders.create') }}">Check Out</a>
            </div>
          </div>
        </div>
      </div>
    </section><!--/#do_action-->
  @else

  @endif
@endsection
