<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tickets', TicketController::class);
});
