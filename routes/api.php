<?php

use App\Http\Controllers\Admin\ChatbotInteractionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/chatbots/{chatbotId}/chat', [ChatbotInteractionController::class, 'Chat']);