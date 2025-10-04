<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Show checkout page (Blade)
     */
    public function index()
    {
        $cartItems = Session::get('cart', []);
        $subtotal = 0;
        $shipping = 70;

        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        if ($subtotal >= 3000) $shipping = 0;
        $total = $subtotal + $shipping;

        $constituency = '';
        $phone = '';
        $email = '';
        $address = '';
        $amount = $total;

        return view('checkout', compact(
            'cartItems', 'subtotal', 'shipping', 'total',
            'constituency', 'phone', 'email', 'address', 'amount'
        ));
    }

    /**
     * Fetch cart + delivery info and return to checkout view
     */
    public function fetchCart(Request $request)
    {
        $cartItems = Session::get('cart', []);
        $subtotal = 0;

        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = $subtotal >= 20000 ? 0 : 100;
        $total = $subtotal + $shipping;

        $constituency = $request->input('constituency');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $address = $request->input('address');
        $amount = $request->input('amount') ?? $total;

        return view('checkout', compact(
            'cartItems', 'subtotal', 'shipping', 'total',
            'constituency', 'phone', 'email', 'address', 'amount'
        ));
    }
  
    /**
     * Store new order (works for both Blade checkout and API JSON)
     */
    public function store(Request $request)
    {
        $cartItems = Session::get('cart', []);
    
        if (empty($cartItems)) {
            return redirect()->route('view.cart')->with('error', 'Cart is empty.');
        }
    
        DB::beginTransaction();
    
        try {
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item['price'] * $item['quantity'];
    
                // Check stock
                $product = Product::find($item['id']);
                if (!$product) throw new \Exception("Product {$item['name']} not found.");
                if ($product->stock < $item['quantity']) throw new \Exception("Not enough stock for {$item['name']}.");
            }
    
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total'   => $total,
            ]);
    
            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'user_id' => auth()->id(),
                    'product_id' => $item['id'],
                    'qty'        => $item['quantity'],
                    'unit_price' => $item['price'],
                    'line_total' => $item['price'] * $item['quantity'],
                ]);
    
                // Decrement stock
                $product = Product::find($item['id']);
                $product->decrement('stock', $item['quantity']);
            }
    
            DB::commit();
            Session::forget('cart');
    
            return redirect()->route('home')->with('success', 'Order placed successfully!');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
}
