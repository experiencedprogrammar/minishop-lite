<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Show checkout page
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
     * Store a new order (handles both checkout Blade + API)
     */
    public function store(Request $request)
    {
        // Prefer the updated cart from the checkout form if it exists
        $cart = [];

        if ($request->filled('updated_cart')) {
            $decoded = json_decode($request->input('updated_cart'), true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                foreach ($decoded as $productId => $item) {
                    $cart[$productId] = [
                        'id'       => (int) $productId,
                        'quantity' => (int)($item['quantity'] ?? 1),
                        'price'    => (float)($item['price'] ?? 0),
                        'subtotal' => (float)($item['subtotal'] ?? 0),
                    ];
                }
            }
        }

        // Fallback: if form didn’t include updated_cart, use session cart
        if (empty($cart)) {
            $cart = Session::get('cart', []);
        }

        if (empty($cart)) {
            return redirect()->route('view.cart')->with('error', 'Cart is empty.');
        }

        DB::beginTransaction();

        try {
            $total = 0;

            // Validate and calculate total
            foreach ($cart as $item) {
                $qty = (int) $item['quantity'];
                $price = (float) $item['price'];
                $subtotal = $price * $qty;
                $total += $subtotal;

                // Check stock
                $product = Product::find($item['id']);
                if (!$product) {
                    throw new \Exception("Product not found for ID {$item['id']}.");
                }

                if ($product->stock < $qty) {
                    throw new \Exception("Not enough stock for {$product->name}.");
                }
            }

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total'   => $total,
            ]);

            // Create order items & decrement stock
            foreach ($cart as $item) {
                $qty = (int) $item['quantity'];
                $price = (float) $item['price'];
                $subtotal = $price * $qty;

                $product = Product::find($item['id']);

                OrderItem::create([
                    'order_id'   => $order->id,
                    'user_id'    => auth()->id(),
                    'product_id' => $item['id'],
                    'qty'        => $qty,
                    'unit_price' => $price,
                    'line_total' => $subtotal,
                ]);

                // Decrement safely
                $product->decrement('stock', $qty);
            }

            DB::commit();

            // Clear session + optionally updated_cart
            Session::forget('cart');
            $request->session()->forget('updated_cart');

            // ✅ Optional: if this was triggered via AJAX (JSON expected)
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order placed successfully!',
                    'order_id' => $order->id,
                ]);
            }

            return redirect()->route('home')->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 422);
            }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
