<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ 
    OrgController, 
    PortfolioController,
    UserController,
    ProductController,
    ServiceController,
    TeamController,
    RoleController,
};

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'getAll']);
    Route::get('/{id}', [UserController::class, 'getById']);
    Route::post('/', [UserController::class, 'create']);
    Route::patch('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'delete']);
});

Route::prefix('org')->group(function () {
    Route::get('/', [OrgController::class, 'getAll']);
    Route::get('/{id}', [OrgController::class, 'getById']);
    Route::post('/', [OrgController::class, 'create']);
    Route::patch('/{id}', [OrgController::class, 'update']);
    Route::delete('/{id}', [OrgController::class, 'delete']);
});

Route::prefix('org/{org_id}/pfl')->group(function () {
    Route::get('/', [PortfolioController::class, 'getAll']);
    Route::get('/{id}', [PortfolioController::class, 'getById']);
    Route::post('/', [PortfolioController::class, 'create']);
    Route::patch('/{id}', [PortfolioController::class, 'update']);
    Route::delete('/{id}', [PortfolioController::class, 'delete']);
});

Route::prefix('org/{org_id}/pfl/{pfl_id}/prod')->group(function () {
    Route::get('/', [ProductController::class, 'getAll']);
    Route::get('/{id}', [ProductController::class, 'getById']);
    Route::post('/', [ProductController::class, 'create']);
    Route::patch('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
});

Route::prefix('org/{org_id}/pfl/{pfl_id}/prod/{prod_id}/svc')->group(function () {
    Route::get('/', [ServiceController::class, 'getAll']);
    Route::get('/{id}', [ServiceController::class, 'getById']);
    Route::post('/', [ServiceController::class, 'create']);
    Route::patch('/{id}', [ServiceController::class, 'update']);
    Route::delete('/{id}', [ServiceController::class, 'delete']);
});

Route::prefix('org/{org_id}/teams')->group(function () {
    Route::get('/', [TeamController::class, 'getAll']);
    Route::get('/{id}', [TeamController::class, 'getById']);
    Route::post('/', [TeamController::class, 'create']);
    Route::patch('/{id}', [TeamController::class, 'update']);
    Route::delete('/{id}', [TeamController::class, 'delete']);
});

Route::prefix('org/{org_id}/teams/{team_id}/role')->group(function () {
    Route::get('/', [RoleController::class, 'getAll']);
    Route::get('/{id}', [RoleController::class, 'getById']);
    Route::post('/', [RoleController::class, 'create']);
    Route::patch('/{id}', [RoleController::class, 'update']);
    Route::delete('/{id}', [RoleController::class, 'delete']);
});
