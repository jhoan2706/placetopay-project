<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /* public function __construct()
    {
        $this->middleware('auth');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $product=[
            'name'=>'Producto #1',
            'detail'=>'Detalle Producto',
            'price'=>15500,
        ];
        session(['producto'=>$product]);
        return view('home',compact('product'));
    }
}
