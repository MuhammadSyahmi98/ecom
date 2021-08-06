<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToyyibpayController extends Controller
{
    public function createBill(Request $request){
        $this->validate($request, [

        ]);

        $some_data = array(
            'userSecretKey'=>'3y02klwx-0axz-459f-8ryy-wfnq9wve8tei',
            'categoryCode'=>'468g03ck',
            'billName'=>'Car Rental WXX123',
            'billDescription'=>'Car Rental WXX123 On Sunday',
            'billPriceSetting'=>1,
            'billPayorInfo'=>1,
            'billAmount'=>100,
            'billCallbackUrl'=> route('callBack'),
            'billReturnUrl'=> route('paymentStatus'),
            
            'billExternalReferenceNo' => 'AFR341DFI',
            'billTo'=>'John Doe',
            'billEmail'=>'syahmijalil.my@gmail.com',
            'billPhone'=>'0196399925',
            'billSplitPayment'=>0,
            'billSplitPaymentArgs'=>'',
            'billPaymentChannel'=>'0',
            'billContentEmail'=>'Thank you for purchasing our product!',
            'billChargeToCustomer'=>1
          );  
        
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_POST, 1);
          curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');  
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);
        
          $result = curl_exec($curl);
          $info = curl_getinfo($curl);  
          curl_close($curl);
          $obj = json_decode($result);
          echo $result;
                
    }

    public function paymentStatus(){

    }

    public function callBack(){

    }
}
