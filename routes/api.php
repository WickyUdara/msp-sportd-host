<?php

use App\Http\Controllers\Dash\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/events',[EventController::class,'all']);
Route::get('/events/status/{status}', [EventController::class, 'eventFilterByStatus']);
Route::get('/events/scores/{id}',[EventController::class,'scores']);
Route::get('/events/category/{category}',[EventController::class,'eventFilterByCategory']);

