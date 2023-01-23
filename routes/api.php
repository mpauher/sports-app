<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\PositionController;


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

Route::group([
    'prefix' => 'user'
], function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
});

Route::group([
    'middleware' => ['jwt.verify'],
],function() {

    Route::group([
        'prefix' => 'user',
    ],function(){
        Route::post('logout', [UserController::class, 'logout']);
    });

    Route::group([
        'prefix' => 'auth',
        'middleware' => ["role:manager|admin"]
    ],function(){
        Route::group([
            'prefix' => 'team',
        ],function(){
            Route::get('index', [TeamController::class, 'index']);
            Route::post('create', [TeamController::class, 'create']);
            Route::put('{id}', [TeamController::class, 'update']);
            Route::delete('{id}', [TeamController::class, 'destroy']);
        });

        Route::group([
            'prefix' => 'player',
        ],function(){
            Route::get('index', [PlayerController::class, 'index']);
            Route::post('create', [PlayerController::class, 'create']);
            Route::put('{id}', [PlayerController::class, 'update']);
            Route::delete('{id}', [PlayerController::class, 'destroy']);
        });

        Route::group([
            'prefix' => 'trainer',
        ],function(){
            Route::get('index', [TrainerController::class, 'index']);
            Route::post('create', [TrainerController::class, 'create']);
            Route::put('{id}', [TrainerController::class, 'update']);
            Route::delete('{id}', [TrainerController::class, 'destroy']);
        });
    });

    Route::group([
        'prefix' => 'auth',
        'middleware' => ['role:admin'],
    ],function(){
        Route::group([
            'prefix' => 'sport',
        ],function(){
            Route::get('index', [SportController::class, 'index']);
            Route::post('create', [SportController::class, 'create']);
            Route::put('{id}', [SportController::class, 'update']);
            Route::delete('{id}', [SportController::class, 'destroy']);
        });

        Route::group([
            'prefix' => 'position',
        ],function(){
            Route::get('index', [Position::class, 'index']);
            Route::post('create', [Position::class, 'create']);
            Route::put('{id}', [Position::class, 'update']);
            Route::delete('{id}', [Position::class, 'destroy']);
        });
    });
});



