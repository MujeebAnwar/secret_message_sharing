<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Str;
use App\Livewire\Message\Create;
use App\Livewire\Message\Index;
use App\Models\Message;
use Illuminate\Support\Facades\Crypt;

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
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::view('profile', 'profile')->name('profile');
    Route::group(['prefix' => 'messages'],function(){
        Route::get('/', Index::class)->name('messages');
        Route::get('new', Create::class)->name('messages.new');
    });
});
require __DIR__.'/auth.php';