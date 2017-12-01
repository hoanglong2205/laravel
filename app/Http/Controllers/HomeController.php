<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;

use Redirect;
use Session;
use Mail;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['only' => ['getAddToCart', 'getCart', 'addToWishList']]);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->exists('search')){
            $search = $request->get('search');
            $products = Product::where('name', 'like', '%' . $search . '%')->orderBy('name')->paginate(6);
            return view('home')->with('products',$products);
        }
        $products = Product::paginate(6);
        $data = $request->session()->all();
        return view('home')->with('products',$products)->with('data',$data);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('product_details')->with('product',$product);
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null ;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function getCart()
    {
        if (!Session::has('cart')){
            return view('cart_details');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('cart_details')->with('products', $cart->items)->with('totalPrice',$cart->totalPrice);
    }

    public function changeQuantity(Request $request, $product_id, $num)
    {
        $product = Product::find($product_id);
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->changeQuantity($product, $num);
        $request->session()->put('cart', $cart);
        return redirect()->route('cartDetails');
    }

    public function removeFromCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->remove($product);
        $request->session()->put('cart',$cart);
        return redirect()->route('cartDetails');
    }

    public function getContact()
    {
        return view('contact_us');
    }

    public function postContact(Request $request)
    {
        // $this->validate($request, array(
        //         'name' => 'required',
        //         'email'=> 'required|email',
        //         'subject' => 'min:5',
        //         'message' => 'min:10',
        //     ));

        $data = array(
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'bodyMessage' => $request->message
            );
        Mail::send('email.send', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('hoangnm@ows.vn');
            $message->subject($data['subject']);
        });
        return Redirect::to('/');
    }

    public function addToWishList($id)
    {
        $user = Auth::user();
        if (!$user->products()->where('product_id',$id)->exists()){
            $user->products()->attach($id);
        }
        return redirect()->back();
    }

    public function getWithList()
    {
        $user = Auth::user();
        $products = $user->products()->paginate(6);
        return view('wishlist')->with('products',$products);
    }

    public function removeFromWithList($id)
    {
        $user = Auth::user();
        if ($user->products()->where('product_id',$id)->exists()){
            $user->products()->detach($id);
        }
        return redirect()->back();
    }

    public function addToCompare(Request $request, $id)
    {

        $product = Product::find($id);
        if (!Session::has('product1')){
            $request->session()->put('product1', $product);
        }else if (!Session::has('product2')){
            $request->session()->put('product2',$product);
        } else {
            $request->session()->put('product1',$product);
            Session::forget('product2');
        }
        return redirect()->back();
    }

    public function compare()
    {
        return view('compare');
    }

    public function remvoveFromCompare(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product == Session::get('product1')){
            Session::forget('product1');
        } elseif ($product == Session::get('product2')) {
            Session::forget('product2');
        } 
        return redirect()->back();
    }

}
