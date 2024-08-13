<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    /**
     * @test
     */
    public function getEnv()
    {
        $development = env('LOCALHOST');

        self::assertEquals("LOCALHOST_ARIEF", $development);
    }

    /**
     * @test
     */
    public function getDefaultEnv()
    {
        $connection = env('CONNECTION', 'test');
        $version = Env::get('VERSION', '1.0.0'); # Menggunakan namespace Illuminate\Support

        self::assertNotNull($connection);
        self::assertNotNull($version);
        self::assertEquals('test', $connection);
        self::assertEquals('1.0.0', $version);
    }
}
