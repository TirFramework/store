<?php

namespace Tir\Store\Account\Http\Controllers;

use Illuminate\Routing\Controller;

class AccountReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = auth()->user()
            ->reviews()
            ->with('product')
            ->whereHas('product')
            ->paginate(15);

        return view(config('crud.front-template').'::public.account.reviews.index', compact('reviews'));
    }
}
