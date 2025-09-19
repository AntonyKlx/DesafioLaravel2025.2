<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                {{-- <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                @method('PUT')
                <div class=" my-5">
                    <div class="w-full h-auto object-coverl">
                        <img src="{{ asset($user->foto) }}" alt="{{ $user->name }}" class="w-1/5 h-auto py-4 object-cover rounded-full">
                    </div>
                    <label for="foto" class="font-medium text-white">Editar foto</label>
                    <input type="file" name="foto" id="foto"
                        class="w-full text-sm text-gray-300 file:py-2 file:px-4 file:rounded font-semibold file:bg-purple-500">
                </div>
                </form> --}}
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
