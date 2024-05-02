<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::as('api:')->group(static function (): void {
    Route::middleware(['auth:sanctum'])->group(static function (): void {
        Route::get('user', App\Http\Controllers\Api\Auth\UserController::class)->name('user');

        Route::prefix('users')->as('users:')->group(base_path(
            path: 'routes/api/users.php',
        ));

        Route::prefix('workspaces')->as('workspaces:')->group(base_path(
            path: 'routes/api/workspaces.php',
        ));
    });
});
