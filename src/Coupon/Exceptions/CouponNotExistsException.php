<?php

namespace Tir\Store\Coupon\Exceptions;

use Exception;

class CouponNotExistsException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return redirect()->route('cart.index')->withInput()
            ->with('error', trans('coupon::messages.not_exists'));
    }
}
