<x-app-layout>
    <div>
        <div class="flex justify-center p-10">
            <p class=" font-black text-white text-2xl">Gerenciar produtos</p>
        </div>
        @if(isUserLoggedIn())
        <div class="flex justify-end mx-36 mb-7">
            <a href="">
                <span class=" bg-purple-500 p-3 rounded w-fit">
                    Criar
                </span>
            </a>
        </div>
        @endif
        <div>
            <div class="flex justify-center">
                <table class=" w-5/6 text-center items-center h-full">
                    <tr class=" bg-purple-500 w-60">
                        <th>ID</th>
                        <th>NOME</th>
                        <th>ANUNCIANTE</th>
                        <th class="w-1/4">AÇÕES</th>
                    </tr>
                    <tbody class=" p-7">
                        @if ($produtos->isEmpty())
                            <div>
                                Nenhum produto encontrado
                            </div>
                        @endif
                        @foreach ($produtos as $produto)
                            <tr class="w-full bg-white border-b-2">
                                <td class="py-3.5">{{ $produto->id }}</td>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->user->name }}</td>
                                <td>
                                    <a href="" class=" bg-purple-500 text-white rounded px-3 py-2">Visualizar</a>
                                    <a href="" class=" bg-purple-500 text-white rounded px-3 py-2">Editar</a>
                                    <a href="" class=" bg-purple-500 text-white rounded px-3 py-2">Apagar</a>
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

    </div>
</x-app-layout>
