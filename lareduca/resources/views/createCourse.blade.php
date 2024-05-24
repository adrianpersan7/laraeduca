<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight text-center">
            Añadir Curso
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl rounded-lg" style="background-color: #2a4b43;">
            <div class="p-6">
                <form method="POST" action="{{ route('courses.store') }}">
                    @csrf

                    <!-- Nombre del curso -->
                    <div class="mt-4">
                        <x-label for="name" :value="__('Nombre del Curso:')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    </div>

                    <!-- Descripción del curso -->
                    <div class="mt-4">
                        <x-label for="description" :value="__('Descripción del Curso:')" />
                        <textarea id="description" class="block mt-1 w-full" name="description" rows="6" required>{{ old('description') }}</textarea>
                    </div>

                    <!-- Botón para crear el curso -->
                    <div class="flex items-center justify-center mt-4">
                        <x-button>
                            {{ __('Añadir Curso') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>