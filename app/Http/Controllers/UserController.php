<?php

namespace App\Http\Controllers;
use App\Models\Category as ModelsCategory;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
            'password' => 'required|confirmed|min:6',
            'name' => 'required|min:3|max:50',
            'email' => 'email',
            
        ]);
       
        $data = $request->all();
        $user = new ModelsUser();
        $user->user_name = $data['user_name'];
        $user->user_email = $data['user_email'];
        $user->user_password = Crypt::encrypt($data['password']);
        $user->save();
        
    }
}