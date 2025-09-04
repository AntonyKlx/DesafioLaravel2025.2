<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaginaInicialController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;

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

// Route::get('/pagina-inicial', PaginaInicialController::class, function (){
// })->middleware('auth', 'verified')->name('pagina-inicial');

Route::get('/pagina-inicial', function () {
    if (Auth::guard('web')->check() || Auth::guard('adm')->check()) {
    // if (isUserLoggedIn() || isAdminLoggedIn()) {
        return app(PaginaInicialController::class)->__invoke();
    }
    return redirect()->route('login');
})->name('pagina-inicial');



require __DIR__.'/auth.php';
