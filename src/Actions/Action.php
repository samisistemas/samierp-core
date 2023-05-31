<?php

namespace SamiSistemas\SamiERPCore\Actions;

abstract class Action
{
    /**
     * Execute the action and return a result.
     *
     * @return mixed
     */
    abstract public function handle();

    /**
     * @see static::handle()
     *
     * @return mixed
     */
    public static function run(mixed ...$arguments): mixed
    {
        return app(static::class)->handle(...$arguments);
    }
}
