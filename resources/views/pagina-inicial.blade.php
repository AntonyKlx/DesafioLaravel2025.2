
<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-white text-red leading-tight">
            {{ __('Bem vindo de volta '). \Auth::guard(name: 'web')->user()->name }}
        </h2> --}}
    </x-slot>

    <div>
        <form action="{{route ('produtos.index') }}">
            <span class="flex justify-center">
                <input type="text" name="pesquisa" placeholder="Pesquisar produto..." class=" p-2 m-2">
                <button type="submit" class= "text-white font-bold p-2">Pesquisar</button>
            </span>
        </form>
    </div>

  <div class="py-12 mx-auto flex justify-center">
        <span class=" text-white font-bold text-2xl p-4">{{ __('Produtos') }}</span>
  </div>
  <div>
        @foreach($produtos as $produto)
            <div class="flex py-4">
                <div class="text-black justify-center items-center border mx-auto bg-white p-2">
                        <img src="{{$produto->foto}}" alt="foto">
                        <h3 >{{ $produto->nome }}</h3>
                        <p>Preço:
                            <span class="font-bold text-lg"> R${{($produto->preco) }}</span>
                        </p>
                        <span class="bg-blue-500 text-lg font-bold">
                            <a href="">
                                Visulizar
                            </a>
                        </span>
                </div>
                @if (Auth::guard('web')->check())
                    <span >
                        <a class="bg-white p-4" href="">Comprar</a>
                    </span>
                @endif
            </div>
        @endforeach
  </div>

</x-app-layout>

