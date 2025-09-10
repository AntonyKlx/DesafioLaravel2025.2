<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaginaInicialController;
use App\Http\Controllers\ProdutoPageController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('adm')->group(callback: function (){
    Route::get('/dashboard', action: function (){
        return view('admin.dashboard');
    })->middleware('admin')->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/produtos', [PaginaInicialController::class, 'index'])->name('produtos.index');

Route::get('/categorias/{id}', [PaginaInicialController::class, 'categoria'])->name('produtos.categoria');

Route::get('/pagina-inicial', function () {
    if (Auth::guard('web')->check() || Auth::guard('adm')->check()) {
        return app(PaginaInicialController::class)->__invoke();
    }
    return redirect()->route('login');
})->name('pagina-inicial');

Route::get('/produto-page/{id}', [ProdutoPageController::class, 'detalhes'])->name('produto.page');

Route::get('gerenciador-produtos', [ProdutosController::class, 'index'])->name('gerenciador.produtos');

Route::get('gerenciador-produtos/{id}', [ProdutosController::class, 'show'])->name('gerenciador.show');

Route::get('create-produto', [ProdutosController::class, 'create'])->name('produto.create');
Route::post('create-produto', [ProdutosController::class, 'store']);

Route::get('edit-produto/{produto}', [ProdutosController::class, 'edit'])->name('produto.edit');
Route::put('edit-produto/{produto}', [ProdutosController::class, 'update'])->name('produto.update');

Route::delete('delete-produto/{id}', [ProdutosController::class, 'destroy'])->name('produto.delete');

require __DIR__.'/auth.php';
