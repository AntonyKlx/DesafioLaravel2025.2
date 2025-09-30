<x-app-layout>
    <div class="flex justify-center pt-5">
        <div class="flex flex-col w-1/2 bg-slate-800 p-10 rounded-xl">
            <div class="mx-auto text-white text-2xl font-bold my-3">
                <h1>Enviar email para usuário</h1>
            </div>
            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4 flex justify-center">
                    {{ session('success') }}
                </div>
            @endif
            <form action="enviar-email" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-4">
                    <div class="w-full">
                        <label for="user_email" class="flex text-white">Email do usuário</label>
                        <input id="user_email" name="user_email" type="text" placeholder="Email do usuário"
                            class="w-full rounded-lg">
                    </div>

                    <div class="w-full">
                        <label for="conteudo" class="flex text-white">Conteúdo do email</label>
                        <textarea id="conteudo" name="conteudo" type="text" placeholder="Escreva aqui" class="w-full rounded-lg"></textarea>
                    </div>
                    <button type="submit" class="bg-purple-500 p-3 px-7 rounded-md flex justify-center">
                        Enviar
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
