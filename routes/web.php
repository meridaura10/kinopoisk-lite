<?php

use App\Controllers\Admin\AdminCategoryController;
use App\Controllers\Admin\AdminHomeController;
use App\Controllers\Admin\AdminMovieController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\logoutController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\HomeController;
use App\Controllers\MovieController;
use App\Kernel\Router\Route;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\QuestMiddleware;

return [
    Route::get('/', HomeController::class),
    Route::get('/movie', [MovieController::class, 'show']),

    Route::get('/auth/register', [RegisterController::class, 'index'])->setMiddlewares(([QuestMiddleware::class])),
    Route::post('/auth/register', [RegisterController::class, 'register'])->setMiddlewares(([QuestMiddleware::class])),

    Route::get('/auth/login', [LoginController::class, 'index'])->setMiddlewares(([QuestMiddleware::class])),
    Route::post('/auth/login', [LoginController::class, 'login'])->setMiddlewares(([QuestMiddleware::class])),
    Route::post('/auth/logout', [logoutController::class, 'logout'])->setMiddlewares(([AuthMiddleware::class])),

    Route::get('/admin', AdminHomeController::class),

    Route::get('/admin/categories/create', [AdminCategoryController::class, 'create']),
    Route::post('/admin/categories/create', [AdminCategoryController::class, 'store']),
    Route::get('/admin/categories/edit', [AdminCategoryController::class, 'edit']),
    Route::post('/admin/categories/update', [AdminCategoryController::class, 'update']),
    Route::post('/admin/categories/delete', [AdminCategoryController::class, 'delete']),

    Route::get('/admin/movies/create', [AdminMovieController::class, 'create']),
    Route::post('/admin/movies/create', [AdminMovieController::class, 'store']),
    Route::get('/admin/movies/edit', [AdminMovieController::class, 'edit']),
    Route::post('/admin/movies/update', [AdminMovieController::class, 'update']),
    Route::post('/admin/movies/delete', [AdminMovieController::class, 'delete']),
];
