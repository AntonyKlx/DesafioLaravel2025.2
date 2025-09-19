<x-app-layout>
    <div>
        <div class="flex justify-center p-10">
            <p class=" font-black text-white text-2xl">Gerenciar usuários</p>
        </div>
            <div class="flex justify-end mx-36 mb-7">
                <a href="{{route('user.create')}}">
                    <span class=" bg-purple-500 p-3 rounded w-fit">
                        Criar
                    </span>
                </a>
            </div>
        <div>
            <div class="flex justify-center">
                <table class=" w-5/6 text-center items-center h-full">
                    <tr class=" bg-purple-500 w-60 text-white">
                        <th>ID</th>
                        <th>NOME</th>
                        <th>EMAIL</th>
                        <th class="w-1/4">AÇÕES</th>
                    </tr>
                    <tbody class=" p-7">
                        @if ($users->count() === 0)
                            <div>
                                Nenhum produto encontrado
                            </div>
                        @endif
                        @foreach ($users as $user)
                            <tr class="w-full bg-white border-b-2">
                                <td class="py-3.5">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="flex gap-5 justify-center my-1">
                                    <a href="{{ route('user.show', ['id' => $user->id]) }}" class=" bg-purple-500 text-white rounded px-3 py-2">Visualizar</a>
                                    <a href="{{ route('user.edit', $user) }}" class=" bg-purple-500 text-white rounded px-3 py-2">Editar</a>
                                    <form action="{{route('user.delete', $user->id)}}" method="POST">
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
            {{ $users->appends(request()->query())->links() }}
        </div>

    </div>
</x-app-layout>
