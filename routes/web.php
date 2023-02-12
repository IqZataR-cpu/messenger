<?php

use Illuminate\Http\Request;
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

Route::get('/', ['App\Http\Controllers\WelcomeController', 'NotAuthenticatedStartPage']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/welcome', ['App\Http\Controllers\WelcomeController', 'AuthenticatedStartPage'])->name('auth.welcome');
    Route::get('chats/{chat}/messages', ['App\Http\Controllers\Api\GetChatMessagesController', 'handle']);
    Route::post('chats/{chat}/sent-message', ['App\Http\Controllers\MessageController', 'sent']);
    Route::post('contacts/search', ['App\Http\Controllers\Api\Contacts\FindContacts', 'get']);
    Route::post('contacts/add', ['App\Http\Controllers\Api\Contacts\AddContact', 'add']);
    Route::post('contacts', ['App\Http\Controllers\Api\Contacts\GetContacts', 'get']);

    Route::post('/me', function (Request $request) {
        return $request->user();
    });
});

require __DIR__ . '/auth.php';
