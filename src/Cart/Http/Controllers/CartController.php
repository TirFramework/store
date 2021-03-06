<?php

namespace Tir\Store\Cart\Http\Controllers;

use Tir\Store\Support\Country;
use Tir\Store\Cart\Facades\Cart;
use Illuminate\Routing\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::instance();
        $countries = Country::supported();
        return view(config('crud.front-template').'::public.cart.index', compact('cart', 'countries'));
    }
}
