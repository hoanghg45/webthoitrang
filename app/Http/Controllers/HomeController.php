<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Category as ModelsCategory;
use App\Models\Product as ModelsProduct;
use App\Http\Controllers\Controller as RootController;

class HomeController extends Controller
{
    //
    public function index()


    {
        
        $category = ModelsCategory::where('category_status','1')->orderBy('category_id')->get();
        $all_product =  ModelsProduct::where('product_status','1')
                            ->orderBy('created_at','desc')
                            ->limit(4)
                            ->get();
        return view('pages.home')->with('category',$category)->with('product',$all_product);
    }
}