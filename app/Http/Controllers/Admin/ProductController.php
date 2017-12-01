<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Redirect;
use Image;
use Storage;
use File;

class ProductController extends Controller
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
        $products = Product::paginate(5);
        return view('admin.product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        return view('admin.product.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name'          =>'required',
            'category_id'   =>'required',
            'price'         =>'required|integer',
            ));
        $product = new Product;
        $product->name = $request->name;
        $product->category_id = $request->category_id[0];
        $product->description = $request->description;
        $product->price = $request->price;

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(200, 100)->save($location);
            $product->image = $filename;
        }

        $product->save();

        return Redirect::to('admin/products/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('admin.product.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }
        return view('admin.product.edit')->withProduct($product)->withCategories($cats);
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
        $validator = Validator::make($request->all(), [
            'name'          =>'required',
            'category_id'   =>'required',
            'price'         =>'required|integer',
        ]);

        if ($validator->fails()) {
            return Redirect::to('admin/products/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $product = Product::find($id);
            $product->name        = $request->get('name');
            $product->price       = $request->get('price');
            $product->category_id = $request->get('category_id');
            $product->description      = $request->get('description');

            if($request->image){
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/' . $filename);
                Image::make($image)->resize(200, 100)->save($location);
                $oldFilename = $product->image;

                $product->image = $filename;
                File::delete('images/' . $oldFilename);

            }
            $product->save();

            // redirect
            return Redirect::to('admin/products/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        File::delete('images/' . $product->image);
        $product->delete();
        return Redirect::to('admin/products/');
    }
}
