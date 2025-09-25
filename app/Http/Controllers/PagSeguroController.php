<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PagSeguroController extends Controller
{
    public function createCheckout(Request $request)
    {
        $url = config('services.pagseguro.checkout_url');
        $token = config('services.pagseguro.token');


        $produto = json_decode($request->comprar, true);

        $compra = [
            'name' => $produto['nome'],
            'quantity' => 1,
            'unit_amount' => $produto['preco'] * 100,
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json'
        ])->withoutVerifying()->post($url, [
            'reference_id' => uniqid(),
            'items' => [$compra]
        ]);

        if($response->successful()){
            Order::create([
                'reference_id' => $response['reference_id'],
                'status' => 1
            ]);
            $pay_link = data_get($response->json(), 'links.1.href');
            return redirect()->away($pay_link);
        }

    }
}
