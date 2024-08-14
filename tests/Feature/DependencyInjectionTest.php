<?php

namespace Tests\Feature;

use App\Data\{Foo, Bar};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DependencyInjectionTest extends TestCase
{
    /**
     * @test
     */
    public function dependencyInjection()
    {
        $foo = new Foo();
        $bar = new Bar($foo);

        TestCase::assertNotNull($foo);
        TestCase::assertNotNull($bar);
        TestCase::assertEquals("Foo and Bar", $bar->bar());
    }
}
