<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Redirect;
use Storage;
use File;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(5);
        return view('admin.order.index')->with('orders',$orders);
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
        $total = 0;
        foreach ($order->products as $product) {
            $total = $total + $product->pivot->quantity * $product->price;
        }
        return view('admin.order.show')->with('order',$order)->with('total',$total);
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
        $order = Order::find($id);
        if ($order->status == 'checkouted'){
            $order->status = 'delivered';
            $order->save();
        }
        return redirect()->back();
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        if ($order->status != 'checkouted'){
            $order->status = 'canceled';
            $order->save();
        }
        return redirect()->back();
    }
}
