<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User as ModelsUser;
use App\Models\DetailOrder as OrderDetails;
class CheckOutController extends Controller
{
    //
    public function show_checkout()
    {
        
        # code...
        return view('pages.checkout.view_checkout');
    }

    public function payment(Request $request)
    { 

        
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        # code...
        $data =$request-> all();
        // $email= $data['email'];
        // $user = ModelsUser::where('user_email',$email)->first();
        $checkout[] = array(
            'checkout_id' => $session_id,
            'checkout_name' => $data['name'],
            'checkout_email' => $data['email'], 
            'checkout_phone' => $data['phone'],
            'checkout_address' => $data['address'],
            
        );
        Session::put('checkout', $checkout);
        Session::save();
        if(session::get('cart')){
            foreach(session::get('cart') as $key => $cart){
                $order_details = new OrderDetails();
                
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sale_quantity = $cart['product_qty'];                
                $order_details->save();
            }
        }


        return Redirect::to('/show-payment');
    }
    public function show_payment()
    {
        # code...
        return view('pages.checkout.payment_checkout');
    }

}
