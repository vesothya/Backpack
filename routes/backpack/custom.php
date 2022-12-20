<?php

use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\Admin\ProductCrudController;
use App\Http\Controllers\Admin\StudentCrudController;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('student', 'StudentCrudController');
    Route::crud('subject', 'SubjectCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::get('dashboard', 'AdminController@dashboard')->name('backpack.dashboard');
    Route::post('product/import', [ProductCrudController::class, 'import']);    
}); // this should be the absolute last line of this file
    // Route::get('/', [TelegramBotController::class],'sendMessage');
    // Route::post('/send-message', [TelegramBotController::class],'storeMessage');
    // Route::get('/send-photo', [TelegramBotController::class],'sendPhoto');
    // Route::post('/store-photo', [TelegramBotController::class],'storePhoto');
    Route::get('/updated-activity', [TelegramBotController::class],'updatedActivity');