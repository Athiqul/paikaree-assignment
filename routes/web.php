<?php

use App\Http\Controllers\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', [Product::class,'product']);
Route::get('/product/{image}',[Product::class,'showImage'])->name('image.show');
