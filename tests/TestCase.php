<?php

namespace Tests;

use Illuminate\Config\Repository;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function defineEnvironment($app)
    {
        tap($app->make('config'), function (Repository $config) {
            $config->set('database.default', 'testbench');

            $config->set('database.connections.testbench', [
                'driver'   => 'sqlite',
                'database' => ':memory:',
                'prefix'   => '',
            ]);
        });
    }

    public function ignorePackageDiscoveriesFrom()
    {
        return [];
    }
}
