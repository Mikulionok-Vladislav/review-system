<?php

use App\Kernel\Router\Route;
use App\Controllers\HomeController;
use App\Controllers\HotelController;
use App\Controllers\RegisterController;
use App\Controllers\LoginController;
use App\Controllers\AdminController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use App\Controllers\ReviewController;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/register', [RegisterController::class, 'index']),
    Route::post('/register', [RegisterController::class, 'register']),
    Route::get('/login', [LoginController::class, 'index']),
    Route::post('/login', [LoginController::class, 'login']),
    Route::post('/logout', [LoginController::class, 'logout']),
    Route::get('/admin', [AdminController::class, 'index']),
    Route::get('/admin/hotels/add', [HotelController::class, 'add']),
    Route::post('/admin/hotels/add', [HotelController::class, 'store']),
    Route::post('/admin/hotels/destroy', [HotelController::class, 'destroy']),
    Route::get('/admin/hotels/update', [HotelController::class, 'edit']),
    Route::post('/admin/hotels/update', [HotelController::class, 'update']),
    Route::get('/hotel', [HotelController::class, 'show']),
    Route::post('/reviews/add', [ReviewController::class, 'store']),
];