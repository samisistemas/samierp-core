<?php

namespace SamiSistemas\SamiERPCore\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\{Cookie, Redirect, URL};

class LogoutController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        request()->session()->flush();

        return Redirect::to(
            env('APP_URL_LOGIN')
                . '?acao=sair&continue=' . base64_encode(URL::to('/'))
                . '&id=' . Cookie::get('samierp_session')
        );
    }
}
