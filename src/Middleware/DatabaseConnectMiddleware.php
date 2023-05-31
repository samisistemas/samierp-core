<?php

namespace SamiSistemas\SamiERPCore\Middleware;

use SamiSistemas\SamiERPCore\Actions\DatabaseConnect;

class DatabaseConnectMiddleware
{
    public function handle($request, $next): mixed
    {
        DatabaseConnect::run();

        return $next($request);
    }
}
