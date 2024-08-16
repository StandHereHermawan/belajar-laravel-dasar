<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileSystemTest extends TestCase
{
    public function testStorageLocal()
    {
        $fileSystem = Storage::disk("local");
        $fileSystem->put("file.txt", "Put your content here");

        self::assertEquals("Put your content here", $fileSystem->get("file.txt"));
    }

    public function testStoragePublic()
    {
        $fileSystem = Storage::disk("public");
        $fileSystem->put("file.txt", "Put your content here");

        self::assertEquals("Put your content here", $fileSystem->get("file.txt"));
    }
}
