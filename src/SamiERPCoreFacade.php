<?php

namespace SamiSistemas\SamiERPCore;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SamiSistemas\SamiERPCore\Skeleton\SkeletonClass
 */
class SamiERPCore extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'samierp-core';
    }
}
