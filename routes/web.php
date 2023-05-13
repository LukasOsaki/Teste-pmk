<?php

use App\Http\Controllers\CadastroController;
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

Route::get('/', [CadastroController::class, 'index'])->name('index');
Route::resource('cadastros', CadastroController::class);
Route::get('/cadastro/insert', [CadastroController::class, 'cadastrar'])->name('cadastrar');
Route::post('/cadastro/insert', [CadastroController::class, 'create'])->name('cadastro.create');


