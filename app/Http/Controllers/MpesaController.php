<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MpesaTransactions;
use App\Models\DemoPlans;
use App\Models\DemoPlanUser;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Mpesa;
use Illuminate\Support\Facades\Http;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;

class MpesaController extends Controller
{
    protected $consumerKey;
    protected $consumerSecret;
    protected $passkey;
    protected $shortcode;
    protected $callbackUrl;
    protected $environment;

    public function __construct()
    {
        $this->consumerKey = config('services.mpesa.consumer_key');
        $this->consumerSecret = config('services.mpesa.consumer_secret');
        $this->passkey = config('services.mpesa.passkey');
        $this->shortcode = config('services.mpesa.shortcode');
        $this->callbackUrl = config('services.mpesa.callback_url');
        $this->environment = config('services.mpesa.environment');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mpesa_transactions=MpesaTransactions::get();
        return view('admin.mpesa_transactions')->with( 'mpesa_transactions' , $mpesa_transactions);
    }

    public function getAccessToken()
    {
        $url = $this->environment === 'sandbox' 
            ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
            : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
            ->get($url);

        return $response->json()['access_token'] ?? null;
    }

    public function lipaNaMpesaPassword(){
        $timestamp=Carbon::rawParse('now')->format('YmdHms');
        $passKey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $businessShortcode="174379";
        $mpesaPassword= base64_encode($businessShortcode.$passKey.$timestamp);
        return $mpesaPassword;
    }
 

 public function stkSimulation($id)
 {

$mpesa= new \Safaricom\Mpesa\Mpesa();
$user = Auth::user();
$plan = DemoPlans::find($id);
$phone_number=$user->phone_number;
$output = substr($phone_number, 1);
    
$BusinessShortCode=174379;
$LipaNaMpesaPasskey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$TransactionType="CustomerPayBillOnline";
$Amount=$plan->price;
$PartyA=$output;
$PartyB=$BusinessShortCode;
$PhoneNumber=$output;
$AccountReference="WABE DIGITAL AGENCY";
// $CallBackURL="https://a7a8-196-216-82-202.ngrok.io/api/stk/push/callback/url";

$CallBackURL=env('MPESA_TEST_URL'). '/api/stk/push/callback/url';
$TransactionDesc="Lipa na Mpesa From The web";
$Remarks="Thank you for, Keep Browsing to enjoy our Products";

    $stkPushSimulation=$mpesa->STKPushSimulation(
        $BusinessShortCode, 
        $LipaNaMpesaPasskey,
        $TransactionType, 
        $Amount,
        $PartyA,
        $PartyB,
        $PhoneNumber,
        $CallBackURL, 
        $AccountReference, 
        $TransactionDesc,
        $Remarks);

    dd( $stkPushSimulation);
       


        // if ($mpesaT){

        //     return redirect()->back()->with('status','Success Purchase completed successfully !');

        // }
        // else{
        //     return redirect()->back()->with('status1','Failed Your Purchase was not successful, Please try again !');
        // } 

    

        
        //dd($curl_response);
}

public function mpesaResponse(Request $request){

        $response =json_decode($request->getContent());

        Log::info(json_encode($response));

        $resData =$response->Body->stkCallback->CallbackMetadata;
        //return response()->json($resData);
        $resCode = $response->Body->stkCallback->ResultCode;
        $resMessage=$response->Body->stkCallback->ResultDesc;
        
        $amountPaid=$resData->Item[0]->Value;
        $MpesaTransactionId=$resData->Item[1]->Value;
        //return response()->json($amountPaid);
        $paymentPhoneNumber=$resData->Item[3]->Value;
        $formattedPhone =str_replace("254", "0", $paymentPhoneNumber);

        // $response= $request->getContent();
        // $data =json_decode($response, true);
        // Log::info($response);


        // $processedData = $data['Body']['stkCallback'];
       

        // $merchantRID = $processedData["MerchantRequestID"]; 
        // $checkoutRID = $processedData["CheckoutRequestID"];
        // $responseCode = $processedData["ResultCode"];
        // $resultDesc = $processedData["ResultDesc"];

        // $callbackMD = $processedData['CallbackMetadata']['Item'];
        // $amount = $callbackMD[0]['Value'];
        // $trn_ID =  $callbackMD[1]['Value'];
        // $trn_date = $callbackMD[2]['Value'];
        // $trn_phone = $callbackMD[3]['Value'];


        $trn=new MpesaTransactions;
        $trn->amount = $amountPaid;
        $trn->mpesa_receipt_number= $MpesaTransactionId;
        $trn->phone_number=$formattedPhone;


        // $trn = new MpesaTransactions;
        // $trn->result_desc = $resultDesc;
        // $trn->result_post ="hjijkjghhj";
        // $trn->merchant_request_id = $merchantRID;
        // $trn->checkout_request_id = $checkoutRID;
        // $trn->amount = $amount;
        // $trn->mpesa_receipt_number = $trn_ID;
        // $trn->transaction_date = $trn_date;
        // $trn->phone_number = $trn_phone;

         $trn->save();
    
        

}

public function c2bPaymentRequest()
{

    $mpesa= new \Safaricom\Mpesa\Mpesa();
    $b2bTransaction=$mpesa->c2b(
        $ShortCode, 
        $CommandID, 
        $Amount, 
        $Msisdn, 
        $BillRefNumber 
    );

}

public function initiateSTKPush(Request $request)
{
    try {
        $request->validate([
            'phoneNumber' => 'required',
            'amount' => 'required|numeric',
            'items' => 'required|array'
        ]);

        $phoneNumber = $request->phoneNumber;
        $amount = $request->amount;
        $items = $request->items;

        // Format phone number to required format (254XXXXXXXXX)
        $phoneNumber = $this->formatPhoneNumber($phoneNumber);

        // Generate timestamp
        $timestamp = date('YmdHis');
        
        // Generate password
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        $accessToken = $this->getAccessToken();

        if (!$accessToken) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get access token'
            ], 500);
        }

        $url = $this->environment === 'sandbox'
            ? 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest'
            : 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $response = Http::withToken($accessToken)
            ->post($url, [
                'BusinessShortCode' => $this->shortcode,
                'Password' => $password,
                'Timestamp' => $timestamp,
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $phoneNumber,
                'PartyB' => $this->shortcode,
                'PhoneNumber' => $phoneNumber,
                'CallBackURL' => $this->callbackUrl,
                'AccountReference' => 'WabeStudio',
                'TransactionDesc' => 'Payment for order'
            ]);

        if ($response->successful()) {
            $responseData = $response->json();
            
            // Create order in database
            $order = Order::create([
                'payment_method' => 'mpesa',
                'payment_id' => $responseData['CheckoutRequestID'],
                'total_amount' => $amount,
                'status' => 'pending',
                'items' => json_encode($items),
                'user_id' => auth()->id(), // Add user_id to the order
                // Add other necessary fields
            ]);

            return response()->json([
                'success' => true,
                'data' => $responseData
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to initiate STK push',
            'data' => $response->json()
        ], 500);

    } catch (\Exception $e) {
        Log::error('M-Pesa STK Push Error: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while processing your request'
        ], 500);
    }
}

public function callback(Request $request)
{
    Log::info('M-Pesa Callback:', $request->all());

    // Process the callback
    // This is where you'll verify the payment status
    // and update your database accordingly

    return response()->json([
        'ResultCode' => 0,
        'ResultDesc' => 'Success'
    ]);
}

protected function formatPhoneNumber($phone)
{
    // Remove any non-numeric characters
    $phone = preg_replace('/[^0-9]/', '', $phone);
    
    // If the number starts with 0, replace it with 254
    if (substr($phone, 0, 1) === '0') {
        $phone = '254' . substr($phone, 1);
    }
    
    // If the number starts with +, remove it
    if (substr($phone, 0, 1) === '+') {
        $phone = substr($phone, 1);
    }
    
    return $phone;
}
}
