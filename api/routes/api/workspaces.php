<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Workspaces;
use Illuminate\Support\Facades\Route;

Route::get('/', Workspaces\IndexController::class)->name('index');
