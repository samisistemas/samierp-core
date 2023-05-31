<?php

namespace SamiSistemas\SamiERPCore\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $HostingSami IP do espelhamento
 * @property string $Porta Porta do espelhamento
 * @property string $usuarioMySQLSami Usuário do espelhamento
 * @property string $senhaMySQLSami Senha do espelhamento
 * @property string $HostingCliente IP do cliente
 * @property string $PortaCliente Porta do cliente
 * @property string $UsuarioMysqlCliente Usuário do cliente
 * @property string $SenhaMySQLCliente Senha do cliente
 * @property string $NomeBancoDados Nome do banco de dados
 */
class Customer extends Model
{
    protected $connection = 'institutional';

    protected $table = 'clientes';
}
