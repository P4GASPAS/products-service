<?php

use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function() {

    Route::apiResource('products', ProductController::class);
    Route::post('products/group', [ProductController::class, 'groupStore']);

});
