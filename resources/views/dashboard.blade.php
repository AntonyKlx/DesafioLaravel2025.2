<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white text-red leading-tight">
            {{ __('Bem vindo de volta '). \Auth::guard(name: 'web')->user()->name }}
        </h2>
    </x-slot>

  <div class="py-12 mx-auto flex justify-center">
        <span class=" text-white font-bold text-2xl p-4">{{ __('Suas informações') }}</span>
  </div>
</x-app-layout>

