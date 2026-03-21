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

use Illuminate\Support\Facades\Auth;

class MpesaController extends Controller
{
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

    public function newAccessToken(){
        $consumer_key="nE26oHlS4hF5aZiwDdmVRDXjpgpyw6ji";
        $consumer_secret="HlFF2Gr2CBHIjgTw";
        $credentials=base64_encode($consumer_key.":".$consumer_secret);
        $url="https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials. "Content-Type:application/json"));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $curl_response = curl_exec($curl);
        $access_token=json_decode($curl_response);
        curl_close($curl);
        return $access_token->access_token;

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
}
