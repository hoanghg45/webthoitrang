<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    //
    public function show_checkout()
    {
        # code...
        return view('pages.checkout.view_checkout');
    }
}
