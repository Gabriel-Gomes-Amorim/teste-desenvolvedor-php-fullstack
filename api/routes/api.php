<?php

use App\Http\Controllers\FornecedorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('fornecedor/criar', [FornecedorController::class, 'store']);
Route::get('fornecedor/{id}', [FornecedorController::class, 'show']);
Route::get('fornecedor', [FornecedorController::class, 'index']);
Route::put('fornecedor/atualizar/{id}', [FornecedorController::class, 'update']);
Route::delete('fornecedor/deletar/{id}', [FornecedorController::class, 'destroy']);
