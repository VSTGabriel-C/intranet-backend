<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/create', [AuthController::class, 'create']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    // User Routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/update', [AuthController::class, 'update']);
    Route::delete('/delete', [AuthController::class, 'delete']);

    // Cards Routes
    Route::post('/cards/create', [CardController::class, 'create']);
    Route::put('/cards/update/{card_id}', [CardController::class, 'update']);
    Route::get('/cards/show', [CardController::class, 'show_card']);
    Route::get('/cards/delete_cards/{card_id}', [CardController::class, 'delete_card']);

    // Sections Routes
    Route::post('/sections/create', [SectionController::class, 'create']);
    Route::put('/sections/update/{section_id}', [SectionController::class, 'update']);
    Route::get('/sections/show', [SectionController::class, 'show_section']);
    Route::get('/sections/delete_section/{section_id}', [SectionController::class, 'delete_section']);

});
