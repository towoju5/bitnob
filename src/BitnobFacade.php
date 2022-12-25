<?php

namespace Towoju5\Bitnob;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Towoju5\Bitnob\Skeleton\SkeletonClass
 */
class BitnobFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bitnob';
    }
}
