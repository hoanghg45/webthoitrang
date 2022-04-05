<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Category as ModelsCategory;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    //
    public function show_cart(Request $request)
    {
        # code...
        $category = ModelsCategory::all()->sortBy('category_id');
        return view('pages.cart.view_cart')->with('category', $category);
    }
    public function add_to_cart(Request $request)
    {
        # code...

        $data = $request->all();

        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        //  $cart[] = array(
        //         'session_id' => $session_id,
        //         'product_name' => $data['cart_product_name'],
        //         'product_id' => $data['cart_product_id'],
        //         'product_image' => $data['cart_product_image'],
        //         'product_quantity' => $data['cart_product_quantity'],
        //         'product_size' => $data['cart_product_size'],
        //         'product_price' => $data['cart_product_price'],

        //     );
        //     Session::put('cart',$cart);
        //     Session::save();


        $cart = Session::get('cart');
        // Session::flush();
        if ($cart == true) {

            

            $is_avaiable = 0;
            foreach ($cart as $key => $val) {

                if ($val['product_id'] == $data['cart_product_id']) {

                    $is_avaiable++;
                    $cart[$key] = array(
                        'session_id' => $session_id,
                        'product_name' => $val['product_name'],
                        'product_id' => $val['product_id'],
                        'product_image' => $val['product_image'],
                        'product_quantity' => $val['product_quantity']+$data['cart_product_quantity'],
                        'product_size' => $val['product_size'],
                        'product_price' => $val['product_price'],
                    );
                    Session::put('cart', $cart);
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_size' => $data['cart_product_size'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_size' => $data['cart_product_size'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart', $cart);
        }

        Session::save();
    }
    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = session::get('cart');
        if ($cart == true) {
            foreach ($data['cart_quantity'] as $key => $qty) {
                foreach ($cart as $session => $val) {
                    if ($val['session_id'] == $key) {
                        $cart[$session]['product_quantity'] = $qty;
                    }
                }
            }
            session::put('cart', $cart);
            return redirect()->back()->with('message', 'Cập nhật số lượng thành công');
        } else {
            return redirect()->back()->with('message', 'Cập nhật số lượng thất bại');
        }
    }
    public function delete_cart($session_id){
        $cart = Session::get('cart');  
        if($cart == true){
            foreach($cart as $key =>$val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');

        }
    }   
    public function show_cart_quantity()
    {
        # code...
        $cart= count(Session::get('cart'));
        $output='';
        $output.=  '<li class="nav-item">
        <div class="header-card header-icon desktop-cart-wrapper" margin-left="30px">
        <a href="'.url('/cart').'" class="nav-link">
        <i class="fa fa-shopping-bag" aria-hidden="true"></i> (
            <span class="cart-count">'.$cart.'</span>)
        </a>
        </div>
         </li>';
         echo $output;
    }
}
