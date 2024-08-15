<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Davis')
            ->assertSeeText('Lorem ipsum')
            ->assertSeeText('Lorem, ipsum');

        $this->get('/hello')
            ->assertSeeText('Hello Davis')
            ->assertSeeText('Lorem ipsum')
            ->assertSeeText('Lorem, ipsum');
    }

    public function testNested()
    {
        $this->get('hello-world')
            ->assertSeeText('World Blade,')
            ->assertSeeText('Davis')
            ->assertSeeText('Lorem ipsum')
            ->assertSeeText('Lorem, ipsum');

        $this->get('hello-world-no-name')
            ->assertSeeText('World Blade,')
            ->assertSeeText('Guest')
            ->assertSeeText('Lorem ipsum')
            ->assertSeeText('Lorem, ipsum');
    }
}
