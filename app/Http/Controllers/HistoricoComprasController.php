<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class HistoricoComprasController extends Controller
{
    public function index()
    {
        $query = Venda::query();
        $user = Auth::user();

        if(isAdminLoggedIn()){
            $vendas = $query->orderByDesc('created_at')->paginate(9);
        } else {
            $vendas = Venda::where('comprador_id', $user->id)->paginate(9);
        }
        return view('historico-compras', [
            'vendas' => $vendas,
        ]);
    }


    public function gerarPdf(Request $request)
    {
        $data_inicio = Carbon::parse($request->input('data_inicio'))->startOfDay();
        $data_final = Carbon::parse($request->input('data_fim'))->endOfDay();


        $vendas = Venda::with(['produto.categoria', 'comprador', 'vendedor'])->whereBetween('data_venda', [$data_inicio, $data_final])->where('comprador_id', Auth::id())->orderBy('data_venda','asc')->get();

        $pdf = Pdf::loadView('relatorio-pdf', [
            'data' => "De " . $data_inicio->format('d/m/Y') .  " a " . $data_final-> format('d/m/Y'),
            'vendas' => $vendas,
            'usuarioLogado' => auth::user()->name,
            'dataGeracao' => now()->format('d/m/Y H:i'),
        ]);

        return $pdf->stream('historico-compras');
    }
}
