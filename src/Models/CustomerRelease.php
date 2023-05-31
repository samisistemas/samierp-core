<?php

namespace SamiSistemas\SamiERPCore\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerRelease extends Model
{
    protected $connection = 'institutional';

    protected $table = 'div_clienteliberacao';
}
