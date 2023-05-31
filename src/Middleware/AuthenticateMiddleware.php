<?php

namespace SamiSistemas\SamiERPCore\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Cache,
    Config
};

class AuthenticateMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (!session('Logado')) {
            return redirect('/login');
        }

        $prefix = session('NomeBanco') . '_' . session('UsuarioId') . '_';

        if (strpos(Config::get('cache.prefix'), $prefix) === false) {
            Config::set('cache.prefix', Config::get('cache.prefix') . $prefix);
            Cache::forgetDriver();
        }

        Config::set('discord-logger.from.name', session('Empresa')['Sigla'] . ' - ' . session('UsuarioNome'));

        return $next($request);
    }
}
