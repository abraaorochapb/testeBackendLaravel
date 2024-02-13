<?php

use App\Http\Controllers\ToolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tools', [ToolController::class, 'handleToolRequest'])->name('tools.handleRequest');
Route::get('/tools/{id}', [ToolController::class, 'show'])-> name('tools.show');
Route::post('/tools', [ToolController::class, 'store'])-> name('tools.store');
Route::put('/tools/{id}', [ToolController::class, 'update'])-> name('tools.update');
Route::delete('/tools/{id}', [ToolController::class, 'destroy'])-> name('tools.destroy');