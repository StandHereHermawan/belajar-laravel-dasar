<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTemplateTest extends TestCase
{

    public function testTemplate()
    {
        $this->view('hello.world')
            ->assertSeeText('World Blade, Guest');

        $this->view('hello.world', ['name' => 'Davis'])
            ->assertSeeText('World Blade, Davis');

        $this->view('hello', ['name' => 'Davis'])
            ->assertSeeText('Hello Davis');
    }
}
