<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-white text-red leading-tight">
            {{ __('Bem vindo de volta '). \Auth::guard(name: 'web')->user()->name }}
        </h2> --}}
    </x-slot>



    <div class=" border flex justify-center">
        <div class="border border-red-500 w-full">
            <form action="{{ route('produtos.index') }}">
                <span class="flex justify-center pt-5">
                    <input type="text" name="pesquisa" placeholder="Pesquisar produto..."
                        class=" p-2 w-1/2 rounded-l-lg">
                    <button type="submit" class= "text-white font-bold p-2 bg-blue-600 rounded-r-lg">Pesquisar</button>
                </span>
                <h1 class="text-white justify-center flex font-black m-3">Categorias</h1>
                <div class="flex justify-center gap-4 border border-green-600 ">
                    <a href="{{ route('pagina-inicial') }}" class="p-2 bg-gray-200 rounded-lg">Todas</a>
                    @foreach ($categorias as $categoria)
                        <a href="{{ route('produtos.categoria', ['id' => $categoria->id_categoria]) }}"
                            class="p-2 bg-gray-200 rounded-lg">
                            {{ $categoria->nome }}
                        </a>
                    @endforeach
                </div>
            </form>
        </div>
    </div>

    <div class=" pt-6 mx-auto flex justify-center">
        <span class=" text-white font-bold text-2xl p-1">
            <h1>Produtos</h1>
        </span>
    </div>
    <div class="px-20 border-t-2 border-gray-600">
        <div class=" flex flex-wrap gap-x-20">
            @foreach ($produtos as $produto)
                <div class=" py-4 border border-slate-600 text-center w-1/4 mx-auto my-4 fill bg-slate-800 rounded-xl">
                    <div class="text-black justify-center items-center border-2 border-red-600 mx-auto">
                            <img class="w-full h-full" src="{{ $produto->foto }}" alt="foto">
                    </div>
                        <h3 class=" font-extrabold text-xl">{{ $produto->nome }}</h3>
                        <p>Preço:
                            <span class="font-bold text-lg"> R${{ $produto->preco }}</span>
                        </p>
                        <div class="flex justify-center mt-4">
                            <a href="{{ route('produto.page', ['id' => $produto->id]) }}">
                                <span class=" bg-slate-200 p-2 text-lg font-bold rounded">
                                    Visulizar
                                </span>
                            </a>
                        </div>
                    @if (Auth::guard('web')->check())
                        <div class="flex justify-center my-7">
                            <a href="">
                                <span class="bg-lime-500 p-4 font-extrabold text-white rounded">
                                    Comprar
                                </span>
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
            </div>
        </div>
        <div class="flex justify-center mt-4 p-10">
            {{ $produtos->appends(request()->query())->links() }}
        </div>
    </div>

</x-app-layout>
