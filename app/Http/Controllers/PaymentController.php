<?php
namespace App\Http\Controllers;
use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;
use Mpesa;

class PaymentController extends Controller
{
    public function stkPush(Request $request)
    {
        $mpesa = new \Safaricom\Mpesa\Mpesa();
        // Extract data from the incoming AJAX request
        $phone = $request->input('phone');
        $amount = $request->input('amount');
        $accountReference = 'FrelaMed Pharmacuticals'; // or a dynamic value
        $transactionDesc = 'OrderPayment';       
        $BusinessShortCode = '174379';
        $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $TransactionType = 'CustomerPayBillOnline';
        $PartyB = '174379';
        $CallBackURL = 'https://87d65d350de0.ngrok-free.app/project/callback.php';
        $Remarks = 'Remarks';
        $PartyA = $phone ;

        try {
            $stkPushSimulation = $mpesa->STKPushSimulation(
                $BusinessShortCode, 
                $LipaNaMpesaPasskey, 
                $TransactionType, 
                $amount, 
                $PartyA, 
                $PartyB, 
                $PartyA, // Use PartyA for PhoneNumber as well
                $CallBackURL, 
                $accountReference, 
                $transactionDesc, 
                $Remarks
            );
                
            
            // Check M-Pesa API response for success code
            // The Safaricom Mpesa SDK returns an object, so check for its specific response code
            if (isset($stkPushSimulation->ResponseCode) && $stkPushSimulation->ResponseCode == '0') {
                 // Return success JSON
                 return response()->json([
                    'success' => true,
                    'message' => 'Payment request sent successfully. Please complete the transaction on your phone.'
                ]);
            } else {
                 // Handle M-Pesa API error response
                $errorMessage = $stkPushSimulation->errorMessage ?? 'Unknown M-Pesa error.';
                 return response()->json([
                    'success' => false,
                    'message' => 'M-Pesa API error: ' . $errorMessage
                ]);
            }
        } catch (\Exception $e) {
            // Handle network or other unexpected exceptions
            return response()->json([
                'success' => false,
                'message' => 'An unexpected server error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
