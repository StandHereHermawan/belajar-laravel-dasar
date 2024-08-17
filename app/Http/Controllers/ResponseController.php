<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(Request $request): Response
    {
        return response("Hello Response");
    }

    public function header(Request $request): Response
    {
        $body  = ['firstName' => 'Terry', 'lastName' => "Davis"];
        return response(json_encode($body), 200)
            ->header('Content-Type', 'application/json')
            ->withHeaders([
                'Author' => 'Arief Karditya Hermawan',
                'Tutor' => 'Programmer Zaman Now',
                'App' => 'Belajar Laravel'
            ]);
    }

    public function responseView(Request $request): Response
    {
        return response()
            ->view('Hello', ['name' => 'Terry']); # dari file blade template hello.blade.php di direktori resources/views
    }

    public function responseJson(Request $request): JsonResponse
    {
        $body  = ['firstName' => 'Terry', 'lastName' => "Davis"];
        return response()
            ->json($body);
    }

    public function responseFile(Request $request): BinaryFileResponse
    {
        return response()
            ->file(storage_path('app/public/pictures/Screenshot from 2023-12-31 18-42-45.png'));
    }

    public function responseDownload(Request $request): BinaryFileResponse
    {
        return response()
            ->download(storage_path('app/public/pictures/Screenshot from 2023-12-31 18-42-45.png'), 'Screenshot from 2023-12-31 18-42-45.png');
    }
}
