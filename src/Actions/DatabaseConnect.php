<?php

namespace SamiSistemas\SamiERPCore\Actions;

use Illuminate\Support\Facades\Config;
use SamiSistemas\SamiERPCore\Models\{Customer, CustomerRelease};

class DatabaseConnect extends Action
{
    public function handle(?string $database = null): void
    {
        if ($database) {
            session()->put('Empresa', ['Sigla' => $database]);

            if (env('APP_ENV') !== 'production') {
                session()->put('NomeBanco', $database);
            }
        }

        if (!Config::get('database.connections.mysql.web_customer') || !Config::get('database.connections.mysql.local_customer')) {
            Config::set('database.connections.customer_release', [
                'driver'    => 'mysql',
                'host'      => env('DB_HOST_INSTITUTIONAL_ALFA', '170.244.220.66'),
                'port'      => env('DB_PORT_INSTITUTIONAL_ALFA', '3309'),
                'database'  => env('DB_DATABASE_INSTITUTIONAL_ALFA', '_institucional_alfa'),
                'username'  => env('DB_USERNAME_INSTITUTIONAL_ALFA', 'root'),
                'password'  => env('DB_PASSWORD_INSTITUTIONAL_ALFA'),
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
                'strict'    => false,
                'engine'    => null,
            ]);

            $devConfig = [
                'driver'    => 'mysql',
                'host'      => env('DB_HOST_DEV', '170.244.220.66'),
                'port'      => env('DB_PORT_DEV', '3309'),
                'database'  => session('NomeBanco'),
                'username'  => env('DB_USERNAME_DEV', 'root'),
                'password'  => env('DB_PASSWORD_DEV'),
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
                'strict'    => false,
                'engine'    => null,
            ];
            Config::set('database.connections.web_customer', $devConfig);
            Config::set('database.connections.local_customer', $devConfig);

            if (env('APP_ENV') === 'production') {
                Config::set('database.connections.customer_release', [
                    'driver'    => 'mysql',
                    'host'      => env('DB_HOST_INSTITUTIONAL_MASTER', 'bdinst.whmsam.com.br'),
                    'port'      => env('DB_PORT_INSTITUTIONAL_MASTER', '3306'),
                    'database'  => env('DB_DATABASE_INSTITUTIONAL_MASTER', 'dbinstitucional_master'),
                    'username'  => env('DB_USERNAME_INSTITUTIONAL_MASTER', 'root'),
                    'password'  => env('DB_PASSWORD_INSTITUTIONAL_MASTER'),
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => '',
                    'strict'    => false,
                    'engine'    => null,
                ]);

                $betaCustomer = CustomerRelease::where([
                    ['Tag_Liberacao', 'BETA'],
                    ['Sigla_Liberacao', session('Empresa')['Sigla']],
                ])->first();

                if ($betaCustomer) {
                    Config::set('database.connections.customer_release', [
                        'driver'    => 'mysql',
                        'host'      => env('DB_HOST_INSTITUTIONAL_BETA', 'bdinst.whmsam.com.br'),
                        'port'      => env('DB_PORT_INSTITUTIONAL_BETA', '3306'),
                        'database'  => env('DB_DATABASE_INSTITUTIONAL_BETA', 'dbinstitucional_beta'),
                        'username'  => env('DB_USERNAME_INSTITUTIONAL_BETA', 'root'),
                        'password'  => env('DB_PASSWORD_INSTITUTIONAL_BETA'),
                        'charset'   => 'utf8',
                        'collation' => 'utf8_unicode_ci',
                        'prefix'    => '',
                        'strict'    => false,
                        'engine'    => null,
                    ]);
                }

                $customer = Customer::where('SIGLA', session('Empresa')['Sigla'])->first();

                if (!Config::get('database.connections.mysql.web_customer')) {
                    Config::set('database.connections.web_customer', [
                        'driver'    => 'mysql',
                        'host'      => $customer->HostingSami,
                        'port'      => $customer->Porta,
                        'database'  => $customer->NomeBancoDados,
                        'username'  => $customer->usuarioMySQLSami,
                        'password'  => $customer->senhaMySQLSami,
                        'charset'   => 'utf8',
                        'collation' => 'utf8_unicode_ci',
                        'prefix'    => '',
                        'strict'    => false,
                        'engine'    => null,
                    ]);
                }

                if (!Config::get('database.connections.mysql.local_customer')) {
                    Config::set('database.connections.local_customer', [
                        'driver'    => 'mysql',
                        'host'      => $customer->HostingCliente,
                        'port'      => $customer->PortaCliente,
                        'database'  => $customer->NomeBancoDados,
                        'username'  => $customer->UsuarioMysqlCliente,
                        'password'  => $customer->SenhaMySQLCliente,
                        'charset'   => 'utf8',
                        'collation' => 'utf8_unicode_ci',
                        'prefix'    => '',
                        'strict'    => false,
                        'engine'    => null,
                    ]);
                }
            }
        }
    }
}
