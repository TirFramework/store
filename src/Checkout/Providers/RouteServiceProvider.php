<?php

namespace Tir\Store\Checkout\Providers;

use Tir\Store\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $namespace = 'Tir\Store\Checkout\Http\Controllers';

    /**
     * Get public routes.
     *
     * @return string
     */
    protected function public()
    {
        return __DIR__ . '/../Routes/public.php';
    }
}
