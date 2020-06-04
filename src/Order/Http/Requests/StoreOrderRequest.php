<?php

namespace Tir\Store\Order\Http\Requests;

use Illuminate\Http\Request;
use Tir\Store\Support\Country;
use Illuminate\Validation\Rule;
use Tir\Store\Payment\Facades\Gateway;
//use Tir\Store\Core\Http\Requests\Request;
use Tir\Store\Shipping\Facades\ShippingMethod;

class StoreOrderRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'storefront::checkout.tabs.attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_email' => ['required', 'email', $this->emailUniqueRule()],
            'billing.first_name' => 'required',
            'billing.last_name' => 'required',
            'billing.address_1' => 'required',
            'billing.city' => 'required',
            'billing.zip' => 'required',
            'billing.country' => ['required', Rule::in(Country::supportedCodes())],
            'billing.state' => 'required',
            'create_an_account' => 'boolean',
            'password' => 'required_if:create_an_account,1',
            'ship_to_different_address' => 'boolean',
            'shipping.first_name' => 'required_if:ship_to_a_different_address,1',
            'shipping.last_name' => 'required_if:ship_to_a_different_address,1',
            'shipping.address_1' => 'required_if:ship_to_a_different_address,1',
            'shipping.city' => 'required_if:ship_to_a_different_address,1',
            'shipping.zip' => 'required_if:ship_to_a_different_address,1',
            'shipping.country' => ['required_if:ship_to_a_different_address,1', Rule::in(Country::supportedCodes())],
            'shipping.state' => 'required_if:ship_to_a_different_address,1',
            'payment_method' => ['required', Rule::in(Gateway::names())],
            'shipping_method' => ['required', Rule::in(ShippingMethod::names())],
            'terms_and_conditions' => 'accepted',
        ];
    }

    private function emailUniqueRule()
    {
        return $this->create_an_account ? Rule::unique('users', 'email') : null;
    }
}