<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\Api\CepController;
use App\Http\Controllers\HistoricoVendasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaginaInicialController;
use App\Http\Controllers\PagSeguroController;
use App\Http\Controllers\ProdutoPageController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\UsuariosController;
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

Route::get('/produto-page/{id}', [ProdutoPageController::class, 'detalhes'])->middleware(['auth:web,adm'])->name('produto.page');

Route::get('gerenciador-produtos', [ProdutosController::class, 'index'])->middleware(['auth:web,adm'])->name('gerenciador.produtos');

Route::get('gerenciador-produtos/{id}', [ProdutosController::class, 'show'])->middleware(['auth:web,adm'])->name('gerenciador.show');

Route::get('create-produto', [ProdutosController::class, 'create'])->middleware(['auth:web,adm'])->name('produto.create');
Route::post('create-produto', [ProdutosController::class, 'store']);

Route::get('edit-produto/{produto}', [ProdutosController::class, 'edit'])->middleware(['auth:web,adm'])->name('produto.edit');
Route::put('edit-produto/{produto}', [ProdutosController::class, 'update'])->middleware(['auth:web,adm'])->name('produto.update');

Route::delete('delete-produto/{id}', [ProdutosController::class, 'destroy'])->middleware(['auth:web,adm'])->name('produto.delete');


Route::get('historico-vendas', [HistoricoVendasController::class, 'index'])->middleware(['auth:web,adm'])->name('historico.vendas');

Route::post('gerar-pdf',[HistoricoVendasController::class, 'gerarPdf'])->middleware(['auth:web,adm'])->name('vendas.gerarPDF');


Route::get('gerenciador-usuarios', [UsuariosController::class, 'index'])->middleware(['auth:web,adm'])->name('gerenciador.usuarios');

Route::get('user-show/{id}', [UsuariosController::class, 'show'])->middleware(['auth:web,adm'])->name('user.show');

Route::get('create-user', [UsuariosController::class, 'create'])->middleware(['auth:web,adm'])->name('user.create');
Route::post('create-user', [UsuariosController::class, 'store']);

Route::get('edit-user/{user}', [UsuariosController::class, 'edit'])->middleware(['auth:web,adm'])->name('user.edit');
Route::put('edit-user/{user}', [UsuariosController::class, 'update'])->middleware(['auth:web,adm'])->name('user.update');

Route::delete('delete-user/{id}', [UsuariosController::class, 'destroy'])->middleware(['auth:web,adm'])->name('user.delete');

Route::get('api/cep/{cep}', [CepController::class, 'show']);


Route::get('gerenciador-admins', [AdminsController::class, 'index'])->middleware(['auth:web,adm'])->name('gerenciador.admins');

Route::get('admin-show/{id}', [AdminsController::class, 'show'])->middleware(['auth:web,adm'])->name('admin.show');

Route::get('create-admin', [AdminsController::class, 'create'])->middleware(['auth:web,adm'])->name('admin.create');
Route::post('create-admin', [AdminsController::class, 'store']);

Route::get('edit-admin/{admin}', [AdminsController::class, 'edit'])->middleware(['auth:web,adm'])->name('admin.edit');
Route::put('edit-admin/{admin}', [AdminsController::class, 'update'])->middleware(['auth:web,adm'])->name('admin.update');

Route::delete('delete-admin/{id}', [AdminsController::class, 'destroy'])->middleware(['auth:web,adm'])->name('admin.delete');


Route::post('/checkout', [PagSeguroController::class, 'createCheckout']);

require __DIR__.'/auth.php';
