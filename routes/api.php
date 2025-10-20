<?php

declare(strict_types=1);


use App\Http\Controllers\API\ActorController;

Route::group(['prefix' => 'actors', 'middleware' => ['auth']], function () {
    Route::get('prompt-validation', [ActorController::class, 'promptValidation']);
});
