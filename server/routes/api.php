<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FieldController;

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

Route::get("/list", [FieldController::class, "list"]);

Route::get("/view/{id}", [FieldController::class, "view"]);

Route::post("/create", [FieldController::class, "create"]);

Route::put("/edit/{id}", [FieldController::class, "edit"]);
