<?php

namespace SamiSistemas\SamiERPCore\Middleware;

use Closure;
use Illuminate\Http\Request;
use SamiSistemas\SamiERPCore\Actions\DatabaseConnect;

class DatabaseConnectMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        DatabaseConnect::run();

        return $next($request);
    }
}
