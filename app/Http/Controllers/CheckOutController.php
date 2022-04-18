<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User as ModelsUser;
use App\Models\Order as Order;
use App\Models\DetailOrder as OrderDetails;
use App\Http\Controllers\Controller as RootController;
class CheckOutController extends Controller
{
    //
    public function show_checkout()
    {
        if(Session::get('user_id')&&Session::get('cart')){
        # code...
        return view('pages.checkout.view_checkout');
        }
        else{
            Session::put('error', 'Bạn phải đăng nhập để thực hiện chức năng ngày');
            return Redirect::to('sign-in');
        }
    }
    public function caltotal($cartarr)
    {
        $total = 0;
        # code...
        foreach ($cartarr as $key => $cart) {
            $price = str_replace(',', '', $cart['product_price']);
            $subtotal = (int) $price * $cart['product_quantity'];
            $total += $subtotal;
                    
        }
        return $total;
    }

    public function payment(Request $request)
    {
        if(Session::get('user_id')&&Session::get('cart')){

        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        # code...
        $data = $request->all();
        // $email= $data['email'];
        // $user = ModelsUser::where('user_email',$email)->first();
        

        
        
        $total = $this->caltotal(Session::get('cart'));
        
        
        //add Order
        $order = new Order();
        $order_data  = array();
        $order_data['customer_id'] = Session::get('user_id');
        $order_data ['address'] = $data['address'];
        $order_data ['order_total'] = $total;
        $order_data ['order_status'] = 0;
        
        $order_id = $order->insertGetId($order_data);
        //add DetailOrder
        if (Session::get('cart')) {
            foreach (Session::get('cart') as $key => $cart) {      
                $order_details = new OrderDetails();       
                $image = $cart['product_image'];   
                $order_details->order_id = $order_id;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sale_quantity = $cart['product_quantity'];
                $order_details->product_size =$cart['product_size'];
                $order_details->save();
                
                
               
                
            }
        }
        $checkout[] = array(
            'checkout_id' => $session_id,
            'checkout_name' => $data['name'],
            'checkout_email' => $data['email'],
            'checkout_phone' => $data['phone'],
            'checkout_address' => $data['address'],
            'product_name' => $order_details->product_name,
            'product_price' => $order_details->product_price ,
            'product_image' => $image,
            'product_quantity' => $order_details->product_sale_quantity,
            'product_size' => $order_details->product_size,
            
        );
        $request->session()->forget('cart');
        
        return view('pages.checkout.payment_checkout')->with('checkout',$checkout);
                }
        else{
            Session::put('error', 'Bạn phải đăng nhập để thực hiện chức năng ngày');
            return Redirect::to('sign-in');
        }                                
        
    }
    public function show_payment()
    {
        # code...
        if(Session::get('user_id')&&Session::get('cart')){
            return view('pages.checkout.payment_checkout');
        }
        else{
            Session::put('error', 'Bạn phải đăng nhập để thực hiện chức năng ngày');
            return Redirect::to('sign-in');
        }
        
        
    }
  
}
