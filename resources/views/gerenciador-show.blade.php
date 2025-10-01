<x-app-layout>
    <div class="flex justify-center pt-5">
        <p class="font-black text-white text-2xl">Detalhes do Produto</p>
    </div>

    <div class="flex justify-center mx-auto px-4 w-10/12">
        <div class="p-3 flex flex-row bg-slate-800 w-full m-5 rounded-xl gap-6">

            <div class=" w-4/6 flex flex-col gap-4 ">
                <div class="w-full h-auto rounded ">
                    <img src="{{ asset($produto->foto) }}" alt="{{ $produto->nome }}" class="w-full h-auto object-cover rounded-xl">
                </div>

            </div>

            <div class="w-11/12 bg-slate-700 rounded-xl p-5">
                <h1 class="font-extrabold text-white text-3xl">{{$produto->nome}}</h1>
                <h3 class=" text-yellow-300 font-extrabold text-2xl">{{$produto->preco}}</h3>
                <p class="text-white font-medium mt-5 text-xl"> Categoria: {{$produto->categoria->nome}}</p>
                <p class="text-white font-medium text-xl">Anunciante: {{$produto->user->name}}</p>
                <p class="text-white font-medium text-xl mt-3">Descrição:</p>
                <p class="font-normal text-white">{{$produto->descricao}}</p>
            </div>
        </div>
    </div>
</x-app-layout>
