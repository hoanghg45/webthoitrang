<?php

namespace App\Http\Controllers;
use App\Models\Order as ModelsOrder;
use App\Models\DetailOrder as OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as RootController;

class OrderController extends Controller
{
    //
    public function all_order()
    {
        # code...
        (new RootController)-> AuthLogin();
        $order = ModelsOrder::join('tbl_user','tbl_user.user_id', '=', 'orders.customer_id')
        ->orderBy('order_id','DESC')->limit(5);
 
         return view('admin.all_order')->with('order',$order);
    }
    public function detail_order($order_id)
    {
        # code...
        $detail_order = OrderDetails::where('order_id',$order_id)->get();
        
        return view('admin.detail_order')->with('detail_order',$detail_order);
    }
}
