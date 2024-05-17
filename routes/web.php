<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts' ,[AddressController::class, 'index']);
Route::get('/contacts/{id?}', [AddressController::class, 'show']);
Route::post('/contacts/store', [AddressController::class, 'store']);
Route::put('/contacts/update/{id?}', [AddressController::class, 'update']);
Route::delete('/contacts/delete/{id?}', [AddressController::class, 'destroy']);
Route::get('/search', [AddressController::class, 'search']);