<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/author', function () {
    return "Hello Guest! from author Arief";
});

Route::redirect('/pemilik', '/author');

Route::fallback(function () {
    return "<h1>404</h1> <h2>Not Found</h2> <h2>Controller Not Found.</h2> <p>by Programmer Zaman Now</p> <p>Implementation by Arief Karditya Hermawan</p>";
});

Route::view('/hello', 'hello', ['name' => 'Davis']);

Route::get('/hello-again', function () {
    return view('hello', ['name' => 'Davis']);
});

Route::get('/hello-world', function () {
    return view('hello.world', ['name' => 'Davis']);
});

Route::get('/hello-world-no-name', function () {
    return view('hello.world', []);
});
