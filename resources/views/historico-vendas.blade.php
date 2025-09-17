<x-app-layout>
    <div>
        <div class="flex justify-center p-10">
            <p class="font-black text-white text-2xl">Histórico de Vendas</p>
        </div>
        <div>
            <div class="flex justify-center">
                <table class="w-5/6 text-center items-center h-full">
                    <tr class="bg-purple-500 w-60 text-white">
                        <th>ID Venda</th>
                        <th>PRODUTO</th>
                        <th>IMAGEM</th>
                        <th>COMPRADOR</th>
                        <th>VENDEDOR</th>
                        <th>VALOR</th>
                        <th>DATA DA VENDA</th>
                    </tr>
                    <tbody class="p-7">
                        @if ($vendas->count() === 0)
                            <tr>
                                <td class="py-5 text-white">Nenhuma venda encontrada</td>
                            </tr>
                        @endif
                        @foreach ($vendas as $venda)
                            <tr class="w-full bg-white border-b-2">
                                <td class="py-3.5">{{ $venda->id }}</td>
                                <td>{{ $venda->produto->nome }}</td>
                                <td>
                                    <img src="{{ asset($venda->produto->foto) }}" alt="{{ $venda->produto->nome }}"
                                        class="h-16 w-16 mx-auto rounded">
                                </td>
                                <td>{{ $venda->comprador->name }}</td>
                                <td>{{ $venda->vendedor->name }}</td>
                                <td> R$ {{ $venda->valor }}</td>
                                <td>{{ $venda->data_venda }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class=" mx-32 my-6">
                <h1 class="flex text-white font-black text-2xl">
                    Gere um pdf das transações
                </h1>
                <form method="POST" action="{{ route('vendas.gerarPDF') }}">
                    @csrf
                    <div class="">
                        <span>
                            <label class="text-white">Data inicio</label>
                            <input type="date" name ="data_inicio" value="{{ request('data_inicio') }}">
                        </span>
                        <span>
                            <label class="text-white">Data final</label>
                            <input type="date" name="data_final" value="{{ request('data_final') }}">
                        </span>
                    </div>
                    <div class="flex justify-end mb-7 my-7">
                        <button type="submit">
                            <span class=" bg-purple-500 p-3 rounded w-fit">
                                GERAR PDF
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex justify-center mt-4 p-10">
            {{ $vendas->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>
