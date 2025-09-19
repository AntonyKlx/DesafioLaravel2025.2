<x-app-layout>
    <div class="flex justify-center pt-5">
        <p class="font-black text-white text-2xl">Criar usuário</p>
    </div>

    <div class="flex justify-center mx-auto px-4">
        <div class="py-3 bg-slate-800 m-5 rounded-xl gap-6 w-2/3 px-7">
            <form action="create-user" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                <div class="flex justify-between w-full border">
                    <div class="w-2/3">
                        <div class="w-full">
                            <label for="name" class="flex">Nome</label>
                            <input id="name" name="name" type="text" placeholder="Nome do usuário"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="email" class="flex">Email</label>
                            <input id="email" name="email" type="text" placeholder="Email do usuário"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="password" class="flex">Senha</label>
                            <input id="password" name="password" type="password" placeholder="Senha do usuário"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="cep" class="flex">Cep</label>
                            <input id="cep" name="cep" type="text" placeholder="Cep do usuário"
                                class="w-full">
                        </div>
                    </div>

                    <div class=" w-1/3">
                        <div class="w-full">
                            <label for="logradouro" class="flex">Logradouro</label>
                            <input id="logradouro" name="logradouro" type="text" placeholder="Logradouro do usuário"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="bairro" class="flex">Bairro</label>
                            <input id="bairro" name="bairro" type="text" placeholder="Bairro do usuário"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="cidade" class="flex">Cidade</label>
                            <input id="cidade" name="cidade" type="text" placeholder="Cidade do usuário"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="estado" class="flex">Estado</label>
                            <input id="estado" name="estado" type="text" placeholder="Estado do usuário"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="complemento" class="flex">Complemento</label>
                            <input id="complemento" name="complemento" type="text"
                                placeholder="Complemento do usuário" class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="telefone" class="flex">Telefone</label>
                            <input id="telefone" name="telefone" type="text" placeholder="Telefone do usuário"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="data_de_nascimento" class="flex">Data de nascimento do usuário</label>
                            <input id="data_de_nascimento" name="data_de_nascimento" type="date"
                                placeholder="data_de_nascimento do usuário" class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="cpf" class="flex">Cpf do usuário</label>
                            <input id="cpf" name="cpf" type="text" placeholder="cpf do usuário"
                                class="w-full">
                        </div>

                    </div>
                </div>


                {{-- <div>
                    <label fFor="saldo" class="flex">Saldo do usuário</label>
                    <input id="saldo" name="saldo" type="number" placeholder="Saldo do usuário">
                </div> --}}

                <div>
                    <label for="foto" class="font-medium">Foto do usuário</label>
                    <input type="file" name="foto" id="foto"
                        class="w-full text-sm text-white file:py-2 file:px-4 file:rounded font-semibold file:bg-purple-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-purple-500 p-3 px-7 rounded-md flex justify-center">
                        Criar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
