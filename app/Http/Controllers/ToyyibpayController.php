<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToyyibpayController extends Controller
{
    public function createBill(Request $request){
        $this->validate($request, [

        ]);

        $some_data = array(
            'userSecretKey'=>'secretkey',
            'categoryCode'=>'code',
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
          $result = json_decode($result, true);
      

         $some_data['billCode'] = $result[0]['BillCode'];
         $some_data['paymentURL'] = 'https://dev.toyyibpay.com/' . $result[0]['BillCode'];
           return redirect($some_data['paymentURL']);
                
    }

    public function paymentStatus(Request $request){
        // https://ecom.test/payment?status_id=1&billcode=gi0xsqei&order_id=AFR341DFI&msg=ok&transaction_id=TP74356221515614080821
        if($request->status_id = 1){
          auth()->user()->orders()->create([
            'cart'=>serialize(session()->get('cart')),
          ]);
          session()->forget('cart');
          return redirect(route('view.carts'))->with('message', 'Payment Success. Orders have been recorded.');
        }else {
          return redirect(route('view.carts'))->with('message', 'Payment Failed. Please try again');
        }

    }

    public function callBack(){

    }
}
