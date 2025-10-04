<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show all products for customers (frontend home page).
     */
    
    /**
     * Show all products for customers (frontend home page).
     */
    public function home()
    {
        $products = Product::orderBy('created_at', 'desc')
                       ->take(8) // limit to 8 items for homepage
                       ->paginate(8); // 8 items per page -> 4 per row (col-lg-3)
                           // get() returns collection of objects
                       
        return view('home', compact('products'));
    }
    
}
