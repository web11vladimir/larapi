<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Document;
use App\Http\Controllers\API\V1\DocumentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// маршруты index, store, show, update
Route::apiResource('document', DocumentController::class)->except(['destroy']);

// маршрут публикации документа
Route::post('document/{document}/publish', [DocumentController::class, 'publish']);