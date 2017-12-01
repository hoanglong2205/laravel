<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{ 
    public function show($id)
    {
        $category = Category::find($id);
        $products = Product::where('category_id',$category->id)->paginate(6);
        return view('categories.show')->with('products',$products);
    }
}
