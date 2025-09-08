<?php

namespace App\Http\Controllers;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index(Request $request){
        // $termoDePesquisa = $request->input('pesquisa');
        $query = Produto::query();
        // if($termoDePesquisa){
        //     $query->where('nome', 'like', '%' . $termoDePesquisa . '%');
        // }
        $user = Auth::user();

        if(isAdminLoggedIn()){
        $produto = $query->orderByDesc('created_at')->paginate(9);
        } else {
            $produtos = Produto::where('anunciante_id', $user->id)->paginate(9);
        }

        return view('gerenciador-produtos', [
            'produtos' => $produtos,
        ]);
    }

};
