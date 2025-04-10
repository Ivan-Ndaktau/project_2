<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\TicketController;
Route::get('/', function () {
    return redirect('/flights');
});

Route::get('/flights', [FlightController::class, 'index']);
Route::get('/flights/ticket/{id}', [FlightController::class, 'show']);
Route::put('/ticket/board/{id}', [TicketController::class, 'boardPassenger']);
Route::delete('/ticket/delete/{id}', [TicketController::class, 'deletePassenger']);
Route::get('/flights/book/{id}', [FlightController::class, 'book']);
Route::post('/ticket/submit',[TicketController::class, 'submit']);