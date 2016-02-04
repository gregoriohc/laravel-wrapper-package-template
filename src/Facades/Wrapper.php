<?php

namespace Vendor\Package\Facades;

use Illuminate\Support\Facades\Facade;

class Wrapper extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'packagename'; }

}