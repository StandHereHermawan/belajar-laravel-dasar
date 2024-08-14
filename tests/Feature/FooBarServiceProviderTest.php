<?php

namespace Tests\Feature;

use App\Data\{Foo, Bar};
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FooBarServiceProviderTest extends TestCase
{

    public function testServiceProvider()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertSame($foo1, $foo2);

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($bar1, $bar2);

        self::assertSame($bar1->getFoo(), $foo1);
        self::assertSame($bar2->getFoo(), $foo2);
    }

    public function testPropertySingleton()
    {
        $helloService1 = $this->app->make(HelloService::class);
        $helloService2 = $this->app->make(HelloService::class);

        self::assertNotNull($helloService1);
        self::assertNotNull($helloService2);
        self::assertSame($helloService1, $helloService2);

        self::assertEquals('Halo Terry!', $helloService1->hello('Terry'));
    }

    public function testProvider()
    {
        self::assertTrue(true);
    }
}
