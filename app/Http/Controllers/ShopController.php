<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('shop.index', ['products' => $products]);
    }

    public function singleProduct($id)
    {
        $product = Product::find($id);

        return view('shop.singleProduct', ['product' => $product]);
    }

    public function orderProduct($id)
    {
        $product = Product::find($id);
    }
}
