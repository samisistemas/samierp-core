<?php

namespace SamiSistemas\SamiERPCore\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\{Cookie, Redirect, URL};

class LoginController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        return Redirect::to(
            env('APP_URL_LOGIN')
                . '?continue=' . base64_encode(URL::to('/'))
                . '&id=' . Cookie::get('samierp_session')
                . '&onUpdate=1'
        );
    }
}
