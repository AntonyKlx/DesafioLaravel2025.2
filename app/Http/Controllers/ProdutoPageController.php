<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoPageController extends Controller
{
    public function detalhes($id){
        $produto = Produto::where('id', $id)->first();
            return view('produto-page', [
                'produto' => $produto
            ]);
    }
}
