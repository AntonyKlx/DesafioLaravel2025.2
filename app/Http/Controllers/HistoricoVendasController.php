<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoricoVendasController extends Controller
{
    public function index()
    {
        $query = Venda::query();
        $user = Auth::user();

        if(isAdminLoggedIn()){
            $vendas = $query->orderByDesc('created_at')->paginate(9);
        } else {
            $vendas = Venda::where('vendedor_id', $user->id)->paginate(9);
        }
        return view('historico-vendas', [
            'vendas' => $vendas,
        ]);
    }
}
