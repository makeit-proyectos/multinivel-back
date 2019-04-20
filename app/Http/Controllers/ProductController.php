<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product()
    {
        $cartItem = Cart::add('293ad', 'Product 1', 1, 9.99, ['size' => 'large']);
        return response()->json($cartItem);
    }
}
