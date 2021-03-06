<?php

namespace Tir\Store\Account\Http\Controllers;

use Illuminate\Routing\Controller;

class AccountWishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = auth()->user()
            ->wishlist()
            ->paginate(15);

        return view(config('crud.front-template').'::public.account.wishlist.index', compact('products'));
    }

    public function destroy($productId)
    {
        auth()->user()->wishlist()->detach($productId);

        return back()->withSuccess(trans('account::messages.product_removed_from_wishlist'));
    }
}
