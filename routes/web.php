<?php

use App\Actions\Auth\AuthenticateAction;
use App\Actions\Reservation\CreateReservationAction;
use Illuminate\Support\Facades\Route;


Route::post('/authenticate', AuthenticateAction::class);

Route::middleware('auth')->group(function () {
    Route::post('/reservation', CreateReservationAction::class);
});