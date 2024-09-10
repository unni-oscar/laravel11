<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController; 
// Route::get('/', function () {
//     return inertia('Index/Index');
// });


Route::get('/', [IndexController::class, 'index']);
Route::get('/hello', [IndexController::class, 'show']);
