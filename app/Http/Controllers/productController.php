<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        return view('home.products.products', compact('products'));
    }

    public function single(Product $product)
    {
        return view('home.products.single' , compact('product'));
    }
}
