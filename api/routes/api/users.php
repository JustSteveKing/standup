<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Controllers\Api\Users\IndexController::class)->name('index')->middleware([
    'permission:users.list',
]);
