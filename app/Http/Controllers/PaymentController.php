<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{    
    /**
     * Show the default booking page
     * 
     * @return \Illuminate\Http\Response
     */
    public function prepareCheckout()
    {

        dd("checking out this cool thaang!!!");
    }

    public function doPeachPrepareRequest(Request $request) {

        // This is the consultation amount
        $amount = $request->input('amount');

        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174e735d0c014e78cf26461790" .
                "&amount={$amount}" .
                "&currency=ZAR" .
                "&paymentType=DB";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0ZTczNWQwYzAxNGU3OGNmMjY2YjE3OTR8cXl5ZkhDTjgzZQ=='
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $responseData = curl_exec($ch);
        
        if (curl_errno($ch)) {
            return curl_error($ch);
        }

        curl_close($ch);

        return $responseData;
    }

    public function getPaymentStatus(Request $request) {

        $checkoutId = $request->input('checkout_id');

        $url = "https://test.oppwa.com/v1/checkouts/{$checkoutId}/payment";
        $url .= "?entityId=8a8294174e735d0c014e78cf26461790";
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGE4Mjk0MTc0ZTczNWQwYzAxNGU3OGNmMjY2YjE3OTR8cXl5ZkhDTjgzZQ=='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $responseData = curl_exec($ch);
        
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        
        curl_close($ch);
        return $responseData;
    }
}
