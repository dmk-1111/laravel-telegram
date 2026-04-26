<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/update', function () { // Get Group Id
    $token = env('TELEGRAM_BOT_TOKEN');
    $response = Http::get("https://api.telegram.org/bot{$token}/getUpdates");

    // ✅ CORRECT
    dd($response->json());
});

Route::get('/send-message', function () {
    $token = env('TELEGRAM_BOT_TOKEN');
    $chat_id = env('TELEGRAM_CHAT_ID');
    $message = [
        'Hello, this is a message from Laravel Telegram Bot!',
        'This bot is working perfectly.',
        'Have a great day!'
    ];
    Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
        'chat_id' => $chat_id,
        'text' => implode("\n", $message),
        'parse_mode' => 'HTML'
    ]);
    return "Message sent!";
});
