<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product;
Route::post('/product/update/{id}',[Product::class,'updateItem']);
Route::get('/product/status/{id}',[Product::class,'status']);

Route::resource('products',Product::class);
