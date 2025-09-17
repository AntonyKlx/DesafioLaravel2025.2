<x-app-layout>
    <div class="flex justify-center pt-5">
        <p class="font-black text-white text-2xl">Detalhes do Usuário</p>
    </div>

    <div class="flex justify-center mx-auto px-4 w-10/12">
        <div class="p-3 flex flex-row bg-slate-800 w-full m-5 rounded-xl gap-6">

            <div class=" w-4/6 flex flex-col gap-4 border border-red-600">
                <div class="w-full h-auto rounded ">
                    <img src="{{ asset($user->foto) }}" alt="{{ $user->name }}" class="w-full h-auto object-cover">
                </div>
                <div class="font-normal text-white p-4 bg-slate-700 rounded-lg">
                    <p>{{$user->email}}</p>
                </div>
            </div>

            <div class="w-11/12 border border-green-600 bg-slate-700 rounded-xl p-5">
                <h1 class="font-extrabold text-white text-3xl">{{$user->name}}</h1>
                <h3 class=" text-yellow-300 font-extrabold text-2xl">CPF: {{$user->cpf}}</h3>
                <h3 class="text-white font-semibold">Telefone: {{$user->telefone}}</h3>
                <h3 class="text-white font-semibold">Data de nascimento: {{$user->data_de_nascimento}}</h3>
                <h3 class="text-white font-semibold">Saldo: {{$user->saldo}}</h3>

                <p class="text-white font-semibold mt-5">Estado: {{$user->estado}}</p>
                <p class="text-white font-semibold">Cidade: {{$user->cidade}}</p>
                <p class="text-white font-semibold"> Bairro: {{$user->bairro}}</p>
                <p class="text-white font-semibold">Logradouro: {{$user->logradouro}}</p>
                <p class="text-white font-semibold">Complemento: {{$user->complemento}}</p>
            </div>
        </div>
    </div>
</x-app-layout>
