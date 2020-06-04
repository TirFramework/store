<?php

namespace Tir\Store\Cart\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tir\Store\Cart\Facades\Cart;
use Tir\Store\Coupon\Exceptions\CouponUsageLimitReachedException;

class CheckCouponUsageLimit
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Cart::coupon()->usageLimitReached($request->customer_email)) {
            throw new CouponUsageLimitReachedException;
        }

        return $next($request);
    }
}
