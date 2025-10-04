<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
 use App\Models\Product; 
use App\Http\Controllers\ProductController;

class CartController extends Controller
{
    public function viewCart()
    {
        $cartItems = Session::get('cart', []);
        $subtotal = 0;

        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = $subtotal > 50000 ? 0 : 70;
        $total = $subtotal + $shipping;

        return view('cart', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

 
public function addToCart(Request $request, $id)
{
    // Fetch product from database
    $product = Product::find($id);

    if (!$product) {
        abort(404); // product not found
    }

    // Get existing cart from session
    $cart = Session::get('cart', []);

    // If product already in cart, increase quantity
    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            'id' => $product->id, 
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image,  
            "description" => $product->description,
            'stock'       => $product->stock
        ];
    }

    Session::put('cart', $cart);

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'cartCount' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    return redirect()->back()->with('success', $product->name.' added to cart!');
}


    public function updateCart(Request $request)
{
    $id = $request->product_id;
    $cart = Session::get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] = max(1, (int) $request->quantity);
        Session::put('cart', $cart);
    }

    return response()->json([
        'success' => true,
        'cartCount' => array_sum(array_column($cart, 'quantity')),
    ]);
}


    public function removeFromCart(Request $request, $id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'cartCount' => array_sum(array_column($cart, 'quantity'))
            ]);
        }

        return redirect()->back()->with('success', 'Item removed!');
    }
    public function clearCart(Request $request)
    {
        Session::forget('cart');

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'cartCount' => 0
            ]);
        }

        return redirect()->back()->with('success', 'Cart cleared!');
    }

    
    }
