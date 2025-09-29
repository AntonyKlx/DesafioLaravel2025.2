<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

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

        $chart = $this->chart();

        return view('historico-vendas', [
            'vendas' => $vendas,
            'chart' => $chart
        ]);
    }


    public function gerarPdf(Request $request)
    {
        $data_inicio = Carbon::parse($request->input('data_inicio'))->startOfDay();
        $data_final = Carbon::parse($request->input('data_fim'))->endOfDay();

        if(isAdminLoggedIn()){
            $vendas = Venda::with(['produto.categoria', 'comprador', 'vendedor'])->whereBetween('data_venda', [$data_inicio, $data_final])->orderBy('data_venda','asc')->get();
        }
        else{
            $vendas = Venda::with(['produto.categoria', 'comprador', 'vendedor'])->whereBetween('data_venda', [$data_inicio, $data_final])->where('vendedor_id', Auth::id())->orderBy('data_venda','asc')->get();
        }

        $pdf = Pdf::loadView('relatorio-pdf', [
            'data' => "De " . $data_inicio->format('d/m/Y') .  " a " . $data_final-> format('d/m/Y'),
            'vendas' => $vendas,
            'usuarioLogado' => auth::user()->name,
            'dataGeracao' => now()->format('d/m/Y H:i'),
        ]);

        return $pdf->stream('historico-vendas');
    }

    public function chart()
    {

        $userId = Auth::id();

        $chart_options =[
        'chart_title' => 'Gráfico de Vendas',
        'model' => 'App\Models\Venda',
        'chart_type' => 'line',
        'where_raw' => "vendedor_id = $userId",
        'report_type' => 'group_by_date',
        'group_by_field' => 'data_venda',
        'group_by_period' => 'month',
        'chart_color' => '168,85,247',
        ];

        $chart = new LaravelChart($chart_options);

        return $chart;
    }
}
