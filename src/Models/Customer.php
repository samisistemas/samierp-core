<?php

namespace SamiSistemas\SamiERPCore\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $connection = 'institutional';

    protected $table = 'clientes';
}
