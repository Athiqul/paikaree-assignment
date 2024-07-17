<?php

use App\Http\Controllers\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', [Product::class,'product']);
