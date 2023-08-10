<?php

use App\Http\Controllers\Api\{
    AuthController,
    CategoryController,
    CompanyController,
    StateCitiesController,
};

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'jwt.middleware'], function ($router) {

    // Auth
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::get('me', [AuthController::class, 'me']);
    });

    // Empresas
    Route::get('companies', [CompanyController::class, 'index']);
    Route::get('companies/{id}', [CompanyController::class, 'show']);
    Route::post('companies', [CompanyController::class, 'store']);

    // categories
    Route::get('categories', [CategoryController::class, 'index']);


    // Helper:Estados/cidades
    Route::get('state-cities/states', [StateCitiesController::class, 'states']);

    //state-cities/cities?state_id=22
    Route::get('state-cities/cities', [StateCitiesController::class, 'cities']);

    //state-cities/city?latitude=45&longitude=45
    Route::get('state-cities/city', [StateCitiesController::class, 'city']);
});
