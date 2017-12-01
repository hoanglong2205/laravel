<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Cart;

use Auth;
use Session;
use Redirect;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $orders = Order::all()->where('user_id', $user->id);
        return view('orders.index')->with('orders',$orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Session::has('cart')){
            return Redirect::to('/');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('orders.create')->with('cart',$cart);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $order = new Order;
        $order->user_id = $user->id;
        $order->status = 'new';
        $order->description = $request->description;
        $order->save();
        //save in pivot
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        foreach ($cart->items as $product) {
            $order->products()->attach($product['item']['id'], ['quantity'=> $product['quantity']]);
        }
        Session::forget('cart');
        return Redirect::to('orders/' . $order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $totalPrice = 0;
        foreach ($order->products()->get() as $product) {
            $totalPrice += $product->price * $product->pivot->quantity;
        }
        return view('orders.show')->with('order',$order)->with('totalPrice', $totalPrice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
