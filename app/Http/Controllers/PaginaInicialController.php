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
        $categoriaId = $request->input('categoria');

        $query = Produto::query();


        if($termoDePesquisa){
            $query->where('nome', 'like', '%' . $termoDePesquisa . '%');
        }
        // $produto = Produto::where('nome', 'like', '%' . $termoDePesquisa . '%')
        //     ->orderByDesc('created_at')
        //     ->get();
        if($categoriaId){
            $query->where('id_categoria', $categoriaId);
        }

        $produto = $query->orderByDesc('created_at')->get();
        $categorias = \App\Models\Categoria::all();

        return view('pagina-inicial', [ 'produtos' => $produto, 'categorias' => $categorias]);
    }

    // faz o metodo que chama a view se o usuario estiver autenticado
    public function __invoke(){
        $user = Auth::user();
        $produtos = Produto::all();
        $categorias = \App\Models\Categoria::all();

        return view('pagina-inicial',[
            'produtos' => $produtos,
            'categorias' => $categorias
        ]);
    }

    public function categoria($id){
        $produtos = Produto::where('id_categoria', $id)->get();
        return view ('pagina-inicial', ['produtos' => $produtos]);
    }

};
