<?php

namespace App\Components\mod_customer;

use Illuminate\Support\Facades\Facade;

class CustomerRouteMethods extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'customer';
    }

    public function routes()
    {
        return function ($options = []) {
            $this->resource('clientes', 'mod_customer\CustomerController');
        };
    }
}
