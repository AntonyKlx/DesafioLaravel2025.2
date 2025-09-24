<x-app-layout>
    <div class="flex justify-center pt-5">
        <p class="font-black text-white text-2xl">Detalhes do Administrador</p>
    </div>

    <div class="flex justify-center mx-auto px-4 w-10/12">
        <div class="p-3 flex flex-row bg-slate-800 w-full m-5 rounded-xl gap-6">

            <div class=" w-4/6 flex flex-col gap-4 border border-red-600">
                <div class="w-full h-auto rounded ">
                    <img src="{{ asset($admin->foto) }}" alt="{{ $admin->name }}" class="w-full h-auto object-cover">
                </div>
                <div class="font-normal text-white p-4 bg-slate-700 rounded-lg">
                    <p>{{$admin->email}}</p>
                </div>
            </div>

            <div class="w-11/12 border border-green-600 bg-slate-700 rounded-xl p-5">
                <h1 class="font-extrabold text-white text-3xl">{{$admin->name}}</h1>
                <h3 class=" text-yellow-300 font-extrabold text-2xl">CPF: {{$admin->cpf}}</h3>
                <h3 class="text-white font-semibold">Telefone: {{$admin->telefone}}</h3>
                <h3 class="text-white font-semibold">Data de nascimento: {{$admin->data_de_nascimento}}</h3>

                <p class="text-white font-semibold mt-5">Estado: {{$admin->estado}}</p>
                <p class="text-white font-semibold">Cidade: {{$admin->cidade}}</p>
                <p class="text-white font-semibold"> Bairro: {{$admin->bairro}}</p>
                <p class="text-white font-semibold">Logradouro: {{$admin->logradouro}}</p>
            </div>
        </div>
    </div>
</x-app-layout>
