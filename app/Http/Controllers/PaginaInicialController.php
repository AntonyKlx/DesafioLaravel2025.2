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
        if($categoriaId){
            $query->where('id_categoria', $categoriaId);
        }

        $produto = $query->orderByDesc('created_at')->paginate(9);
        $categorias = \App\Models\Categoria::all();

        return view('pagina-inicial', [
            'produtos' => $produto,
            'categorias' => $categorias,
            'categoriaSelecionada' => $categoriaId
        ]);
    }

    // faz o metodo que retorna a view carregando 9 produtos mais recentes
    public function __invoke(){
        $user = Auth::user();
        $produtos = Produto::orderByDesc('created_at')->paginate(9);
        $categorias = \App\Models\Categoria::all();

        return view('pagina-inicial',[
            'produtos' => $produtos,
            'categorias' => $categorias
        ]);
    }


    //to usando para filtrar por categoria
    public function categoria($id){
        $produtos = Produto::where('categoria_id', $id)->paginate(9);
        $categorias = \App\Models\Categoria::all();

        return view ('pagina-inicial', [
            'produtos' => $produtos,
            'categorias' => $categorias
        ]);
    }

};
