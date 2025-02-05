<?php

use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('ticket')->group(function () {
    Route::get('/', [TicketController::class, 'index']);
    Route::get('edit/{id}', [TicketController::class, 'edit']);
    Route::post('add', [TicketController::class, 'store']);
    Route::put('update/{id}', [TicketController::class, 'update']);
    Route::delete('delete/{id}', [TicketController::class, 'destroy']);
});

Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => 'Route not found'
    ], 404);
});