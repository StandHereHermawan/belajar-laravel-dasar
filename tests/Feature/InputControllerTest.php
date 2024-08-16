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

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Arief',
            'married' => 'false',
            'birth_date' => '2003-03-12'
        ])->assertSeeText('Arief')->assertSeeText('false')->assertSeeText('2003-03-12');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Arief",
                "middle" => "Karditya",
                "last" => "Hermawan"
            ]
        ])->assertSeeText("Arief")->assertSeeText("Hermawan")->assertDontSeeText("Karditya");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "hermawan",
            "admin" => "true",
            "password" => "rahasia"
        ])->assertSeeText("hermawan")->assertSeeText("rahasia")->assertDontSeeText("admin");
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "hermawan",
            "admin" => "true",
            "password" => "rahasia"
        ])->assertSeeText("hermawan")->assertSeeText("rahasia")->assertSeeText("admin")->assertSeeText("false");
    }
}
