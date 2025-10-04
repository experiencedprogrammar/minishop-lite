<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use Safaricom\Mpesa\Mpesa;

class PaymentController extends Controller
{
    public function stkPush(Request $request)
    {
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $product->decrement('stock', $item['quantity']);
            }
        }
        // 1. Collect customer and cart data
        $phone   = $request->input('phone');
        $address = $request->input('address');
        $email   = $request->input('email');
        $name    = $request->input('name');  

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Cart is empty!'], 400);
        }

        // Calculate subtotal, shipping, total
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $shipping = $subtotal > 50000 ? 0 : 70;
        $total = $subtotal + $shipping;

        // 2. Save order in DB
        $order = Order::create([
            'user_id' => auth()->id() ?? null,
            'order_id' => 'ORD-' . strtoupper(uniqid()),
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
            'constituency' => $request->input('constituency') ?? null,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'status' => 'pending', // default
            'items' => $cart, // Save cart items as JSON
        ]);

        // 3. Trigger STK Push
        $mpesa = new \Safaricom\Mpesa\Mpesa();

        $BusinessShortCode = '174379';
        $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $TransactionType = 'CustomerPayBillOnline';
        $PartyB = '174379';
        $CallBackURL = 'https://yourdomain.com/api/mpesa/callback'; // ✅ must be reachable
        $Remarks = 'Order Payment';
        $accountReference = $order->order_id;
        $transactionDesc = 'Payment for Order ' . $order->order_id;
        $PartyA = $phone;

        try {
            $stkPushSimulation = $mpesa->STKPushSimulation(
                $BusinessShortCode,
                $LipaNaMpesaPasskey,
                $TransactionType,
                $total,
                $PartyA,
                $PartyB,
                $PartyA,
                $CallBackURL,
                $accountReference,
                $transactionDesc,
                $Remarks
            );

            // If successful request sent to Safaricom
            if (isset($stkPushSimulation->ResponseCode) && $stkPushSimulation->ResponseCode == '0') {
                // ✅ Clear the cart since order saved
                Session::forget('cart');

                return response()->json([
                    'success' => true,
                    'message' => 'Payment request sent. Complete on phone.',
                    'order_id' => $order->order_id
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'M-Pesa Error: ' . ($stkPushSimulation->errorMessage ?? 'Unknown error'),
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ✅ Callback to update order status
    public function mpesaCallback(Request $request)
    {
        $data = $request->all();
        
        if (isset($data['Body']['stkCallback']['ResultCode']) && $data['Body']['stkCallback']['ResultCode'] == 0) {
            // Payment successful
            $orderId = $data['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'] ?? null;

            if ($orderId) {
                Order::where('order_id', $orderId)->update(['status' => 'processed']);
            }
        } else {
            // Payment failed → optionally mark as cancelled
        }

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Callback received successfully']);
    }
}
