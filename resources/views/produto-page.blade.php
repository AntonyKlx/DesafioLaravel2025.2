<x-app-layout>
    <div class=" flex justify-center border border-red-700 mx-auto">
        <div class="p-3 flex justify-between bg-slate-800 w-11/12 my-5 rounded-xl h-full">
            <div class="w-11/12 h-auto border border-pink-600">
                <div class="w-full h-auto">
                    <img src="{{ asset($produto->foto) }}" alt="foto" class="">
                    <div class=" font-normal text-base text-white">
                        <p>{{ $produto->descricao }}</p>
                    </div>
                </div>
            </div>
            <div class="border border-green-600 w-full h-full text-white">
                <div class=" p-8 border border-red-400 h-full flex flex-col gap-3">
                    <h1 class=" font-extrabold text-white text-2xl">{{ $produto->nome }}</h1>
                    <h3 class=" text-yellow-300 font-black text-2xl">{{ $produto->preco }}</h3>
                    <p>Quantidade {{ $produto->quantidade }}</p>
                    <div class="">
                        <p>Anunciante: {{ $produto->user->name }}</p>
                        <p>Telefone: {{ $produto->user->telefone }}</p>
                    </div>
                    <p>{{ $produto->categoria->nome }}</p>
                    @if (isUserLoggedIn() == 'user')
                        <form action="/checkout" method="POST">
                            @csrf
                            <input type="hidden" name = "comprar" value="{{json_encode($produto)}}">
                            <input type="hidden" name="quantidade" value="1">
                                <button type="submit" class="bg-lime-500 p-4 font-extrabold text-white rounded">
                                    Comprar
                                </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
