<?php

namespace App\Http\Controllers;
use App\Models\Category as ModelsCategory;
use Illuminate\Support\Facades\Session;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException as DbErr;
class UserController extends Controller
{
    //
    public function sign_up()
    {   
        $category = ModelsCategory::where('category_status','1')->orderBy('category_id')->get();
        # code...
        return view('pages.user.sign_up')->with('category',$category);
    }
    public function register(Request $request)
    {
        # code...
         $request->validate([
            'password' => 'confirmed|min:6',
            'name' => 'min:3|max:50',
            'email' => 'email',
            'phone' => 'digits:10'
            
        ]);
        try{
       
        $data = $request->all();
       
        $user = new ModelsUser();
        $user->user_name = $data['name'];
        $user->user_email = $data['email'];
        $user->user_phone = $data['phone'];
        $user->user_password = Crypt::encrypt($data['password']);
        $user->save();
        }
        catch (DbErr $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                Session::put('error', 'Email đã có người sử dụng!');
                return redirect()->back();
            }
        }
        Session::put('message', 'Đăng ký thành công!');
        return Redirect::to('/homepage');
    }
    public function sign_in()
    {
        $category = ModelsCategory::where('category_status','1')->orderBy('category_id')->get();
        # code...
        return view('pages.user.sign_in')->with('category',$category);
    }
    public function login(Request $request)
    { 
        $request->validate([
        'password' => 'min:6',
        'email' => 'email', 
    ]);
      $data= $request->all();
     $user_email = $data['email'];
     $user_password = $data['password'];

     $result = ModelsUser::where('user_email',$user_email)->first();
     if($result){
        $password = $result->user_password;
        if(Crypt::decrypt($password)==$user_password)
        {
        Session::put('user_name',$result->user_name);
        Session::put('user_email',$result->user_email);      
        Session::put('user_phone',$result->user_phone);    

        Session::put('message', 'Đăng nhập thành công!');
        return Redirect::to('/homepage');
        }
        else{
            Session::put('error', 'Mật khẩu chưa chính xác, vui lòng kiểm tra lại!');
            return redirect()->back();
        }

     }else{
        Session::put('error', 'Tài khoản không tồn tại, vui lòng kiểm tra lại!');
        return redirect()->back();
     }

    }

    public function log_out()
    {
        # code...
        Session::put('user_name',null);
        Session::put('user_email',null); 
        Session::put('user_phone',null); 
        return Redirect::to('/homepage');
    }
    
}