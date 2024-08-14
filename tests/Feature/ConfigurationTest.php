<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * @test
     */
    public function configContoh()
    {
        $firstName = config('contoh.author.first');
        $lastName = config('contoh.author.last');
        $email = config('contoh.email');
        $akunGithub = config('contoh.github');

        TestCase::assertEquals("Arief", $firstName);
        TestCase::assertEquals("Hermawan", $lastName);
        TestCase::assertEquals("arief.hermawan@example.com", $email);
        TestCase::assertEquals("https://github.com/StandHereHermawan/belajar-laravel-dasar", $akunGithub);
    }
}
