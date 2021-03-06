<?php

namespace Tir\Store\Order\Entities;

use Tir\Store\Support\Money;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProductOptionValue extends Pivot
{
    public function getPriceAttribute($price)
    {
        return Money::inDefaultCurrency($price);
    }
}
