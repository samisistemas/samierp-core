<?php

namespace SamiSistemas\SamiERPLib;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SamiSistemas\SamiERPLib\Skeleton\SkeletonClass
 */
class SamiERPLib extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'samierp-lib';
    }
}
