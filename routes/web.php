<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*"
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
})->name('home');

Route::get('/login', [App\Http\Controllers\LoginController::class, 'showLogin'])->name('login');
Route::post('/login/check', [App\Http\Controllers\LoginController::class, 'checkLogin'])->name('login.check');

Route::group(
    ['middleware' => ['auth']],
    function () {
        Route::get('/menu', [App\Http\Controllers\MenuController::class, 'show'])->name('menu');
        Route::get('/usuario', [App\Http\Controllers\UsuarioController::class, 'show'])->name('usuario');
        Route::get('/cliente', [App\Http\Controllers\ClienteController::class, 'show'])->name('cliente');
        Route::get('/produto', [App\Http\Controllers\ProdutoController::class, 'show'])->name('produto');
        Route::get('/pedido', [App\Http\Controllers\PedidoController::class, 'show'])->name('pedido');

        Route::post('/usuario', [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuario.create');
        Route::post('/cliente', [App\Http\Controllers\ClienteController::class, 'create'])->name('cliente.create');
        Route::post('/produto', [App\Http\Controllers\ProdutoController::class, 'create'])->name('produto.create');
        Route::post('/pedido', [App\Http\Controllers\PedidoController::class, 'create'])->name('pedido.create');
        Route::post('/pedidoproduto', [App\Http\Controllers\PedidoProdutoController::class, 'create'])->name('pedidoproduto.create');

        Route::get('/usuario/edit/{id}', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuario.edit');
        Route::get('/cliente/edit/{id}', [App\Http\Controllers\ClienteController::class, 'edit'])->name('cliente.edit');
        Route::get('/produto/edit/{id}', [App\Http\Controllers\ProdutoController::class, 'edit'])->name('produto.edit');
        Route::get('/pedidoproduto/edit/{pedido}/{produto}', [App\Http\Controllers\PedidoProdutoController::class, 'edit'])->name('pedidoproduto.edit');

        Route::put('/usuario/update', [App\Http\Controllers\UsuarioController::class, 'update'])->name('usuario.update');
        Route::put('/cliente/update', [App\Http\Controllers\ClienteController::class, 'update'])->name('cliente.update');
        Route::put('/produto/update', [App\Http\Controllers\ProdutoController::class, 'update'])->name('produto.update');
        Route::put('/pedidoproduto/update', [App\Http\Controllers\PedidoProdutoController::class, 'update'])->name('pedidoproduto.update');

        Route::delete('/usuario', [App\Http\Controllers\UsuarioController::class, 'delete'])->name('usuario.delete');
        Route::delete('/cliente', [App\Http\Controllers\ClienteController::class, 'delete'])->name('cliente.delete');
        Route::delete('/produto', [App\Http\Controllers\ProdutoController::class, 'delete'])->name('produto.delete');
        Route::delete('/pedido', [App\Http\Controllers\PedidoController::class, 'delete'])->name('pedido.delete');
        Route::delete('/pedidoproduto', [App\Http\Controllers\PedidoProdutoController::class, 'delete'])->name('pedidoproduto.delete');

        Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
    }
);
