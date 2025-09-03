<?php

namespace App\Http\Controllers;
use App\Models\User;
use \Illuminate\Support\Facades\Auth;
use App\Models\Produto;

use Illuminate\Http\Request;

class PaginaInicialController extends Controller
{

    public function index(Request $request){
        $termoDePesquisa = $request->input('pesquisa');

        $produto = Produto::where('nome', 'like', '%' . $termoDePesquisa . '%')
            ->orderByDesc('created_at')
            ->get();

        return view('pagina-inicial', [
            'produtos' => $produto,
        ]);
    }

    // faz o metodo que chama a view se o usuario estiver autenticado
    public function __invoke(){
        $user = Auth::user();
        $produtos = Produto::all();
        return view('pagina-inicial',[
            'produtos' => $produtos,
        ]);
    }



};
