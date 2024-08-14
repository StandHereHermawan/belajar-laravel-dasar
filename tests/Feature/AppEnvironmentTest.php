<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AppEnvironmentTest extends TestCase
{

    /**
     * @test
     */
    public function environmentTry()
    {
        var_dump(App::environment());
        if (App::environment("testing")) {
            self::assertNotNull(App::environment("testing"));
            echo "LOGIC IN TESTING ENV" . PHP_EOL;
            self::assertTrue(true);
        }
    }

    /**
     * @test
     */
    public function appEnv()
    {
        if (App::environment(["testing", "prod", "dev"])) {
            self::assertTrue(true);
        }
    }
}
