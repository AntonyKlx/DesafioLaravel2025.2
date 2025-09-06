<?php

namespace App\Http\Controllers;
use App\Models\Produto;

use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index(Request $request){
        $termoDePesquisa = $request->input('pesquisa');
        $query = Produto::query();

        if($termoDePesquisa){
            $query->where('nome', 'like', '%' . $termoDePesquisa . '%');
        }

        $produto = $query->orderByDesc('created_at')->paginate(9);

        return view('gerenciador-produtos', [
            'produtos' => $produto,
        ]);
    }

};
