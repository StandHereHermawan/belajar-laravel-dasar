<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInputSimple() # Mengambil input
    {
        $this->get('/input/hello?name=Davis')
            ->assertSeeText("Hello Davis");

        $this->post('/input/hello', ['name' => 'Davis'])
            ->assertSeeText("Hello Davis");
    }

    public function testInputNested() # Mengambil input nested
    {
        $this->post('/input/hello/first', ['name' => ['first' => 'Davis']])
            ->assertSeeText("Hello Davis");
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'firstName' => 'Arief',
                'lastName' => 'Hermawan'
            ]
        ])->assertSeeText("name")->assertSeeText("firstName")->assertSeeText("Arief")
            ->assertSeeText("lastName")->assertSeeText("Hermawan");
    }

    public function testArrayInput()
    {
        $this->post('/input/hello/array', [
            'products' => [
                [
                    'name' => 'Apple Mac Book Pro',
                    'price' => 30000000
                ],
                [
                    'name' => 'Samsung Galaxy',
                    'price' => 15000000
                ]
            ]
        ])->assertSeeText("Mac Book")->assertSeeText("Samsung");
    }
}
