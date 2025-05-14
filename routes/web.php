<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarrinhoController;

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
//a
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('carrinho')->group(function () {
    Route::post('/adicionar/{id}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
    Route::delete('/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
    Route::get('/mostrar', [CarrinhoController::class, 'mostrar'])->name('carrinho.mostrar');
});
