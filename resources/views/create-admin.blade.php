<x-app-layout>
    <div class="flex justify-center pt-5">
        <p class="font-black text-white text-2xl">Criar Administrador</p>
    </div>

    <div class="flex justify-center mx-auto px-4">
        <div class="py-3 bg-slate-800 m-5 rounded-xl gap-6 w-2/3 px-7">

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="create-admin" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                <div class="flex justify-between w-full border ">
                    <div class="w-2/3">
                        <div class="w-full ">
                            <label for="name" class="flex text-white">Nome</label>
                            <input id="name" name="name" type="text" placeholder="Nome do Administrador"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="email" class="flex text-white">Email</label>
                            <input id="email" name="email" type="text" placeholder="Email do Administrador"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="password" class="flex text-white">Senha</label>
                            <input id="password" name="password" type="password" placeholder="Senha do Administrador"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="cep" class="flex text-white ">Cep</label>
                            <input id="cep" name="cep" type="text" placeholder="Cep do Administrador"
                                class="w-full">
                        </div>
                    </div>

                    <div class=" w-1/3">
                        <div class="w-full">
                            <label for="logradouro" class="flex text-white">Logradouro</label>
                            <input id="logradouro" name="logradouro" type="text" placeholder="Logradouro do Administrador"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="bairro" class="flex text-white">Bairro</label>
                            <input id="bairro" name="bairro" type="text" placeholder="Bairro do Administrador"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="cidade" class="flex text-white">Cidade</label>
                            <input id="cidade" name="cidade" type="text" placeholder="Cidade do Administrador"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="estado" class="flex text-white">Estado</label>
                            <input id="estado" name="estado" type="text" placeholder="Estado do Administrador"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="telefone" class="flex text-white">Telefone</label>
                            <input id="telefone" name="telefone" type="text" placeholder="Telefone do Administrador"
                                class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="data_de_nascimento" class="flex text-white">Data de nascimento do
                                Administrador</label>
                            <input id="data_de_nascimento" name="data_de_nascimento" type="date"
                                placeholder="data_de_nascimento do Administrador" class="w-full">
                        </div>

                        <div class="w-full">
                            <label for="cpf" class="flex text-white">Cpf do Administrador</label>
                            <input id="cpf" name="cpf" type="text" placeholder="cpf do Administrador"
                                class="w-full">
                        </div>

                    </div>
                </div>

                <div>
                    <label for="foto" class="font-medium">Foto do Administrador</label>
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
