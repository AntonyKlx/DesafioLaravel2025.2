<x-app-layout>
    <div class="flex justify-center pt-5">
        <p class="font-black text-white text-2xl">Criar usuário</p>
    </div>

    <div class="flex justify-center mx-auto px-4">
        <div class="py-3 bg-slate-800 m-5 rounded-xl gap-6 w-2/3 px-7">
            @if ($errors->any())
                <div class=" text-white p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="create-user" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                <div class="flex justify-center w-full gap-10">
                    <div class="w-2/4">
                        <div class="w-full ">
                            <label for="name" class="flex text-white font-medium text-base">Nome</label>
                            <input id="name" name="name" type="text" placeholder="Nome do usuário"
                                class="w-full rounded-md">
                        </div>

                        <div class="w-full">
                            <label for="email" class="flex text-white font-medium text-base">Email</label>
                            <input id="email" name="email" type="text" placeholder="Email do usuário"
                                class="w-full rounded-md">
                        </div>

                        <div class="w-full">
                            <label for="password" class="flex text-white font-medium text-base">Senha</label>
                            <input id="password" name="password" type="password" placeholder="Senha do usuário"
                                class="w-full rounded-md">
                        </div>

                        <div class="w-full">
                            <label for="cep" class="flex text-white font-medium text-base ">Cep</label>
                            <input id="cep" name="cep" type="text" placeholder="Cep do usuário"
                                class="w-full rounded-md">
                        </div>

                        <div class ="my-5">
                            <label for="foto" class="font-medium text-white text-base">Foto do usuário</label>
                            <input type="file" name="foto" id="foto"
                                class="w-full text-sm text-white file:py-2 file:px-4 file:rounded font-semibold file:bg-purple-500">
                        </div>
                    </div>

                    <div class=" w-1/3">
                        <div class="w-full">
                            <label for="logradouro" class="flex text-white font-medium text-base">Logradouro</label>
                            <input id="logradouro" name="logradouro" type="text" placeholder="Logradouro do usuário"
                                class="w-full rounded-md">
                        </div>

                        <div class="w-full">
                            <label for="bairro" class="flex text-white font-medium text-base">Bairro</label>
                            <input id="bairro" name="bairro" type="text" placeholder="Bairro do usuário"
                                class="w-full rounded-md">
                        </div>

                        <div class="w-full">
                            <label for="cidade" class="flex text-white font-medium text-base">Cidade</label>
                            <input id="cidade" name="cidade" type="text" placeholder="Cidade do usuário"
                                class="w-full rounded-md">
                        </div>

                        <div class="w-full">
                            <label for="estado" class="flex text-white font-medium text-base">Estado</label>
                            <input id="estado" name="estado" type="text" placeholder="Estado do usuário"
                                class="w-full rounded-md">
                        </div>

                        <div class="w-full">
                            <label for="complemento" class="flex text-white font-medium text-base">Complemento</label>
                            <input id="complemento" name="complemento" type="text"
                                placeholder="Complemento do usuário" class="w-full rounded-md">
                        </div>

                        <div class="w-full">
                            <label for="telefone" class="flex text-white font-medium text-base">Telefone</label>
                            <input id="telefone" name="telefone" type="text" placeholder="Telefone do usuário"
                                class="w-full rounded-md">
                        </div>

                        <div class="w-full">
                            <label for="data_de_nascimento" class="flex text-white font-medium text-base">Data de
                                nascimento do
                                usuário</label>
                            <input id="data_de_nascimento" name="data_de_nascimento" type="date"
                                placeholder="data_de_nascimento do usuário" class="w-full rounded-md">
                        </div>

                        <div class="w-full">
                            <label for="cpf" class="flex text-white font-medium text-base">Cpf do usuário</label>
                            <input id="cpf" name="cpf" type="text" placeholder="cpf do usuário"
                                class="w-full rounded-md">
                        </div>

                    </div>
                </div>


                {{-- <div>
                    <label fFor="saldo" class="flex">Saldo do usuário</label>
                    <input id="saldo" name="saldo" type="number" placeholder="Saldo do usuário">
                </div> --}}

                <div class="flex justify-end text-white font-bold my-5 mx-14">
                    <button type="submit" class="bg-purple-500 p-3 px-7 rounded-md flex justify-center">
                        Criar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cepInput = document.getElementById('cep');

            if (cepInput) {
                cepInput.addEventListener('blur', async function(e) {
                    const cep = e.target.value.replace(/\D/g, '');

                    if (cep.length === 8) {
                        try {
                            const response = await fetch(`/api/cep/${cep}`);
                            const data = await response.json();

                            if (data.error) {
                                alert('CEP não encontrado!');
                                return;
                            }
                            document.getElementById('logradouro').value = data.logradouro || '';
                            document.getElementById('bairro').value = data.bairro || '';
                            document.getElementById('cidade').value = data.localidade || '';
                            document.getElementById('estado').value = data.uf || '';
                        } catch (error) {
                            console.error('Erro ao buscar CEP:', error);
                            alert('Erro ao buscar CEP. Tente novamente.');
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>
