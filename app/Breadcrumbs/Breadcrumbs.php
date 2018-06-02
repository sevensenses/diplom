<?php 

namespace App\Breadcrumbs;

use Illuminate\Support\Facades\Facade;

class Breadcrumbs extends Facade {
	/**
     * Get the name of the class registered in the Application container.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'breadcrumbs';
    }
}