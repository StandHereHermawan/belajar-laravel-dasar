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
}
