<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function AuthLogin()
    {
        # code...
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            # code...
          return  Redirect::to('admin.dashboard');
        }else{
          return  Redirect::to('admin')->send();
        }
    }
    public function AuthUser()
    {
        # code...
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            # code...
          return  Redirect::to('admin.dashboard');
        }else{
          return  Redirect::to('admin')->send();
        }
    }

}
