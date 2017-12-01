<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return fractal($categories, new CategoryTransformer);
    }
    
    public function show($id)
    {
        $category = Category::find($id);
        return fractal($category, new CategoryTransformer);
    }
}
