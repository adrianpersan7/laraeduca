<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight text-center">
            Añadir Usuario
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl rounded-lg" style="background-color: #2a4b43;">
            <div class="p-6">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <!-- Nombre -->
                    <div class="mt-4">
                        <x-label for="name" :value="__('Nombre:')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email:')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>

                    <!-- Rol -->
                    <div class="mt-4">
                        <x-label for="role" :value="__('Rol:')" />
                        <select id="role" class="block mt-1 w-full" name="role">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Contraseña -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Contraseña:')" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirmar Contraseña:')" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    </div>

                    <div class="flex items-center justify-center mt-4">
                        <x-button>
                            {{ __('Añadir Usuario') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>