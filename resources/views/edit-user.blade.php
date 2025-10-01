<x-app-layout>
    <div class="flex justify-center pt-5">
        <p class="font-black text-white text-2xl">Editar usuário</p>
    </div>

    <div class="flex justify-center mx-auto px-4">
        <div class="py-3 flex bg-slate-800 m-5 rounded-xl gap-6 w-2/3 px-7">
            @if ($errors->any())
                <div class=" text-white p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                class="w-full">
                @csrf
                @method('PUT')
                <div class="flex w-full gap-10 justify-center">
                    <div class=" w-2/4">
                        <div class="w-full">
                            <label for="name" class="flex text-white font-medium text-base">Nome</label>
                            <input id="name" name="name" type="text" placeholder="Nome do usuário"
                                class="w-full rounded-md" value="{{ $user->name }}">
                        </div>

                        <div class="w-full">
                            <label for="email" class="flex text-white font-medium text-base">Email</label>
                            <input id="email" name="email" type="text" placeholder="Email do usuário"
                                class="w-full rounded-md" value="{{ $user->email }}">
                        </div>

                        <div class="w-full">
                            <label for="password" class="flex text-white font-medium text-base">Senha</label>
                            <input id="password" name="password" type="password" placeholder="Senha do usuário"
                                class="w-full rounded-md" value="">
                        </div>

                        <div class="w-full">
                            <label for="cep" class="flex text-white font-medium text-base">Cep</label>
                            <input id="cep" name="cep" type="text" placeholder="Cep do usuário"
                                class="w-full rounded-md" value="{{ $user->cep }}">
                        </div>

                        <div class="my-5">
                            <div class="w-full h-auto rounded ">
                                <img src="{{ asset($user->foto) }}" alt="{{ $user->name }}" class="w-1/3 h-auto">
                            </div>
                            <label for="foto" class="font-medium text-white text-base flex">Foto do usuário</label>
                            <input type="file" name="foto" id="foto"
                                class="text-sm text-white file:py-2 file:px-4 file:rounded font-semibold file:bg-purple-500 mb-3">
                        </div>

                        <div>
                            <label for="saldo" class="flex text-white font-medium text-base">Saldo do usuário</label>
                            <input class="rounded-md " id="saldo" name="saldo" type="text" placeholder="Saldo do usuário"
                                value="{{ $user->saldo }}">
                        </div>
                    </div>

                    <div class=" w-1/3">
                        <div class="w-full">
                            <label for="logradouro" class="flex text-white font-medium text-base">Logradouro</label>
                            <input id="logradouro" name="logradouro" type="text" placeholder="Logradouro do usuário"
                                class="w-full rounded-md" value="{{ $user->logradouro }}">
                        </div>

                        <div class="w-full">
                            <label for="bairro" class="flex text-white font-medium text-base">Bairro</label>
                            <input id="bairro" name="bairro" type="text" placeholder="Bairro do usuário"
                                class="w-full rounded-md" value="{{ $user->bairro }}">
                        </div>

                        <div class="w-full">
                            <label for="cidade" class="flex text-white font-medium text-base">Cidade</label>
                            <input id="cidade" name="cidade" type="text" placeholder="Cidade do usuário"
                                class="w-full rounded-md" value="{{ $user->cidade }}">
                        </div>

                        <div class="w-full">
                            <label for="estado" class="flex text-white font-medium text-base">Estado</label>
                            <input id="estado" name="estado" type="text" placeholder="Estado do usuário"
                                class="w-full rounded-md" value="{{ $user->estado }}">
                        </div>

                        <div class="w-full">
                            <label for="complemento" class="flex text-white font-medium text-base">Complemento</label>
                            <input id="complemento" name="complemento" type="text"
                                placeholder="Complemento do usuário" class="w-full rounded-md"
                                value="{{ $user->complemento }}">
                        </div>

                        <div class="w-full">
                            <label for="telefone" class="flex text-white font-medium text-base">Telefone</label>
                            <input id="telefone" name="telefone" type="text" placeholder="Telefone do usuário"
                                class="w-full rounded-md" value="{{ $user->telefone }}">
                        </div>

                        <div class="w-full">
                            <label for="data_de_nascimento" class="flex text-white font-medium text-base">Data de
                                nascimento do usuário</label>
                            <input id="data_de_nascimento" name="data_de_nascimento" type="date"
                                placeholder="data_de_nascimento do usuário" class="w-full rounded-md"
                                value="{{ $user->data_de_nascimento->format('Y-m-d') }}">
                        </div>

                        <div class="w-full">
                            <label for="cpf" class="flex text-white font-medium text-base">Cpf do usuário</label>
                            <input id="cpf" name="cpf" type="text" placeholder="cpf do usuário"
                                class="w-full rounded-md" value="{{ $user->cpf }}">
                        </div>

                    </div>
                </div>
                    <div class="flex justify-end text-white font-bold">
                        <button type="submit" class="bg-purple-500 p-3 px-7 rounded-md flex justify-center">
                            Editar
                        </button>
                    </div>
            </form>
        </div>
    </div>
</x-app-layout>
