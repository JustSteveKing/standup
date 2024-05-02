<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', static fn () => ['Laravel' => app()->version()]);

Route::middleware([])->group(base_path(
    path: 'routes/web/auth.php',
));

