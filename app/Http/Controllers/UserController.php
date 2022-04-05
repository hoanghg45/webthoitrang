<?php

namespace App\Http\Controllers;
use App\Models\Category as ModelsCategory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function sign_up()
    {   
        $category = ModelsCategory::where('category_status','1')->orderBy('category_id')->get();
        # code...
        return view('pages.user.sign_up')->with('category',$category);
    }
}
