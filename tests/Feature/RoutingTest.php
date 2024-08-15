<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/author')
            ->assertStatus(200)
            ->assertSeeText("Hello Guest! from author Arief");
    }

    public function testRedirect()
    {
        $this->get('/pemilik')
            ->assertRedirect('/author');
    }

    public function testFallBack()
    {
        $this->get('/tidakada')
            ->assertSeeText('404 Not Found')
            ->assertSeeText("Arief Karditya")
            ->assertSeeText("Programmer Zaman Now");

        $this->get('/tidakadalagi')
            ->assertSeeText('404 Not Found')
            ->assertSeeText("Arief Karditya")
            ->assertSeeText("Programmer Zaman Now");

        $this->get('/ups')
            ->assertSeeText('404 Not Found')
            ->assertSeeText("Arief Karditya")
            ->assertSeeText("Programmer Zaman Now");
    }

    public function testRouteParameterNormal()
    {
        $this->get('/products/1')
            ->assertSeeText("Product 1");

        $this->get('/products/2')
            ->assertSeeText("Product 2");

        $this->get('/products/1/items/XXX')
            ->assertSeeText("Product 1, Item XXX");

        $this->get('/products/2/items/YYY')
            ->assertSeeText("Product 2, Item YYY");
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/100')
            ->assertSeeText("Category 100");

        $this->get('/categories/salah')
            ->assertSeeText("404")
            ->assertSeeText("Arief Karditya");
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/davis')
            ->assertSeeText("User davis");

        $this->get('/users')
            ->assertSeeText("User 404");
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/budi')->assertSeeText("Conflict budi");

        $this->get('/conflict/arief')->assertSeeText("Conflict Arief Hermawan");
    }

    public function testNamedRoute()
    {
        $this->get('/produk/12345')
            ->assertSeeText('Link http://localhost/products/12345');

        $this->get('/produk-redirect/12345')
            ->assertRedirect('/products/12345');
    }
}
