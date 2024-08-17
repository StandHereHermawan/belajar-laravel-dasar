<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText("Hello Response");
    }

    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText("Terry")->assertSeeText("Davis")
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'Arief Karditya Hermawan')
            ->assertHeader('Tutor', 'Programmer Zaman Now')
            ->assertHeader('App', 'Belajar Laravel');
    }

    public function testView() # dari file blade template hello.blade.php di direktori resources/views
    {
        $this->get('/response/type/view')
            ->assertSeeText('Hello Terry');
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson(['firstName' => 'Terry', 'lastName' => 'Davis']);
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/png');
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('Screenshot from 2023-12-31 18-42-45.png');
    }
}
