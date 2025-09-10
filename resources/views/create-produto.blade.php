<x-app-layout>
    <div class="flex justify-center pt-5">
        <p class="font-black text-white text-2xl">Cadastrar Produto</p>
    </div>

    <div class="flex justify-center mx-auto px-4">
        <div class="py-3 flex bg-slate-800 m-5 rounded-xl gap-6 w-2/3 px-7">
            <form action="create-produto" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                <div class="w-full">
                    <label for="nome" class="flex">Nome</label>
                    <input id="nome" name="nome" type="text" placeholder="Nome do produto" class="w-full">
                </div>

                <div>
                    <label for="preco" class="flex">Preco</label>
                    <input id="preco" name="preco" type="text" placeholder="Preço do produto">
                </div>

                <div>
                    <label for="descricao" class="flex">Descrição</label>
                    <textarea id="descricao" name="descricao" type="text" placeholder="Descrição do produto" class="w-full"></textarea>
                </div>

                <div>
                    <label fFor="quantidade" class="flex">Quantidade</label>
                    <input id="quantidade" name="quantidade" type="number" placeholder="Quantidade do produto">
                </div>

                <div>
                    <label for="categoria" class="flex">Categoria</label>
                    <select id="categoria" name="categoria_id" class="border rounded p-2">

                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}">{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="foto" class="font-medium">Foto do Produto</label>
                    <input type="file" name="foto" id="foto"
                        class="w-full text-sm text-white file:py-2 file:px-4 file:rounded font-semibold file:bg-purple-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-purple-500 p-3 px-7 rounded-md flex justify-center">
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
