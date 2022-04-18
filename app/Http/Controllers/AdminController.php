<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller as RootController;
use App\Models\Order as ModelsOrder;
use App\Models\OrderDetails as ModelsOrderDetails;
session_start();



class AdminController extends Controller
{
    //
    // public function AuthLogin()
    // {
    //     # code...
    //     $admin_id = Session::get('admin_id');
    //     if ($admin_id) {
    //         # code...
    //       return  Redirect::to('admin.dashboard');
    //     }else{
    //       return  Redirect::to('admin')->send();
    //     }
    // }
    public function index()
    {
        if(Session::get('admin_id')){
            return Redirect::to('dashboard');
        }
        else
        return view('admin_login');
    }
    public  function show_dashboard()
    {
       (new RootController)-> AuthLogin();
       $order = ModelsOrder::join('tbl_user','tbl_user.user_id', '=', 'orders.customer_id')
       ->orderBy('order_id','DESC')->limit(5)->get();

        return view('admin.dashboard')->with('order',$order);
    }
    public function dashboard(Request $request)
    {
        # code...
       
       $admin_email = $request->admin_email;
       $admin_password = $request->admin_password;

       $result = DB::table('tbl_admin')->where('admin_email',$admin_email)
                                        ->where('admin_password',$admin_password)->first();
        if($result){
           Session::put('admin_name',$result->admin_name);
           Session::put('admin_email',$result->admin_email);
           Session::put('admin_id',$result->admin_id); 
           
          return Redirect::to('dashboard');
        }else{
            Session::put('message','Tài khoản hoặc mật khẩu sai, vui lòng nhập lại!');
            return Redirect::to('admin');
        }
    }public function unactive_order($order_id)
    {   
        # code...
        (new RootController)-> AuthLogin();
        $order = ModelsOrder::find($order_id);
        $order->order_status= 0;
        $order->save();
        Session::put('message1','Hủy kích hoạt thành công!');
        return Redirect::to('dashboard');
        
    }
    public function active_order($order_id)
    {
        (new RootController)-> AuthLogin();
        # code...
        // DB::table('tbl_category')->where('category_id',$category_id)->update(['category_status'=> 1]);
        $order = ModelsOrder::find($order_id);
        $order->order_status= 1;
        $order->save();
        
        Session::put('message1','Kích hoạt thành công!');
        
        
        return Redirect::to('dashboard');
    }

    public function log_out(Request $request)
    {
        # code...
        
        Session::put('admin_name',null);
        Session::put('admin_id',null); 
        return Redirect::to('/admin');

    }
}
