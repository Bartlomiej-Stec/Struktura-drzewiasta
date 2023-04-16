<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('tree');
});

Route::get('get-tree', [\App\Http\Controllers\TreeController::class, 'getTree']);
Route::post('add-node', [\App\Http\Controllers\TreeController::class, 'addNode']);
Route::post('remove-node', [\App\Http\Controllers\TreeController::class, 'removeNode']);
Route::post('move-node', [\App\Http\Controllers\TreeController::class, 'moveNode']);
Route::post('update-name', [\App\Http\Controllers\TreeController::class, 'updateNodeName']);


