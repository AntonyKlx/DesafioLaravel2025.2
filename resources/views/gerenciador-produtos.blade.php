<x-app-layout>
    <div>
        <div class="flex justify-center p-10">
            <p class=" font-black text-white text-2xl">Gerenciar produtos</p>
        </div>

        @if (isUserLoggedIn())
            <div class="flex justify-end mx-36 mb-7">
                <a href="{{route('produto.create')}}">
                    <span class=" bg-purple-500 p-3 rounded w-fit">
                        Criar
                    </span>
                </a>
            </div>
        @endif
        <div>
            <div class="flex justify-center">
                <table class=" w-5/6 text-center items-center h-full">
                    <tr class=" bg-purple-500 w-60 text-white">
                        <th>ID</th>
                        <th>NOME</th>
                        <th>ANUNCIANTE</th>
                        <th class="w-1/4">AÇÕES</th>
                    </tr>
                    <tbody class=" p-7">
                        @if ($produtos->count() === 0)
                            <div>
                                Nenhum produto encontrado
                            </div>
                        @endif
                        @foreach ($produtos as $produto)
                            <tr class="w-full bg-white border-b-2">
                                <td class="py-3.5">{{ $produto->id }}</td>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->user->name }}</td>
                                <td class="flex gap-5 justify-center my-1">
                                    <a href="{{ route('gerenciador.show', ['id' => $produto->id]) }}" class=" bg-purple-500 text-white rounded px-3 py-2">Visualizar</a>
                                    <a href="{{ route('produto.edit', $produto) }}" class=" bg-purple-500 text-white rounded px-3 py-2">Editar</a>
                                    <form action="{{route('produto.delete', $produto->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" href="" class=" bg-purple-500 text-white rounded px-3 py-2">Apagar</button>
                                    </form>
                                </td>
                            </tr>
                            <tr></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-center mt-4 p-10">
            {{ $produtos->appends(request()->query())->links() }}
        </div>

        @if (isAdminLoggedIn())
        <div class="flex w-2/3 mx-auto">
            {!! $chart->renderHtml() !!}
            {!! $chart->renderChartJsLibrary() !!}
            {!! $chart->renderJs() !!}
        </div>
        @endif
    </div>
</x-app-layout>
