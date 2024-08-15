<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testConfigFacade()
    {
        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first'); # Facade

        self::assertEquals($firstName1, $firstName2);

        var_dump(Config::all());
    }

    public function testConfigDependency()
    {
        $config = $this->app->make('config');
        $firstName3 = $config->get('contoh.author.first');

        $firstName1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstName1, $firstName2);
        self::assertEquals($firstName1, $firstName3);

        self::assertEquals(Config::all(), $config->all());
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.hosting.lokasi')
            ->andReturn('localhost');

        $hostLocation = Config::get('contoh.hosting.lokasi');

        self::assertEquals('localhost', $hostLocation);
    }
}
