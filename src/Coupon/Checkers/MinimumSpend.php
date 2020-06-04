<?php

namespace Tir\Store\Coupon\Checkers;

use Closure;
use Tir\Store\Coupon\Exceptions\MinimumSpendException;

class MinimumSpend
{
    public function handle($coupon, Closure $next)
    {
        if ($coupon->didNotSpendTheRequiredAmount()) {
            throw new MinimumSpendException($coupon->minimum_spend);
        }

        return $next($coupon);
    }
}
