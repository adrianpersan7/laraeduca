<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight text-center">
            Bienvenido, {{ auth()->user()->name }} ({{ auth()->user()->roles->first()->name }})
        </h2>
    </x-slot>
    <div class="mb-6 flex justify-end">
        <a href="{{ route('course.create') }}" class="px-5 py-2.5 relative rounded group font-medium text-white font-medium inline-block" style="background-color: #29C9A1; background-image: linear-gradient(to bottom right, #29C9A1, #034C3A);">
            <span class="absolute top-0 left-0 w-full h-full rounded opacity-50 filter blur-sm" style="background-image: linear-gradient(to bottom right, #29C9A1, #034C3A);"></span>
            <span class="h-full w-full inset-0 absolute mt-0.5 ml-0.5 filter group-active:opacity-0 rounded opacity-50" style="background-image: linear-gradient(to bottom right, #29C9A1, #034C3A);"></span>
            <span class="absolute inset-0 w-full h-full transition-all duration-200 ease-out rounded shadow-xl  filter group-active:opacity-0 group-hover:blur-sm" style="background-image: linear-gradient(to bottom right, #29C9A1, #034C3A);"></span>
            <span class="absolute inset-0 w-full h-full transition duration-200 ease-out rounded" style="background-image: linear-gradient(to bottom right, #29C9A1, #034C3A);"></span>
            <span class="relative">Añadir Curso</span>
        </a>
    </div>
    <div class="container mx-auto">
        <h1 class="text-3xl text-white font-semibold mb-8 text-center m-5">Lista de Cursos</h1>
        
        <div class="grid grid-cols-3 gap-10">
            @php
                // Filtrar los cursos disponibles para eliminar los cursos en los que el usuario está inscrito
                $availableCourses = $courses->filter(function ($course) {
                    return !auth()->user()->courses->contains($course);
                });
            @endphp
            @foreach ($availableCourses as $course)
                <div class="border border-gray-200 p-4 rounded-md relative">
                    <h2 class="text-2xl font-semibold text-center" style="word-wrap: break-word;">{{ $course->name }}</h2>
                    <p class="text-left" style="word-wrap: break-word;">
                        {{ $course->description }}
                    </p>
                    @if (auth()->check())
                        <div class="flex justify-center items-center">
                            <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                @csrf
                            <!-- Div para centrar el botón -->
                                    <button type="submit" class="relative  px-4 py-2 m-4 font-medium group flex justify-center">
                                        <span class="absolute inset-0 w-auto h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                        <span class="absolute inset-0 w-auto h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                        <span class="relative text-black group-hover:text-white">Inscribirme</span>
                                    </button>
                            </form>
                            @if (auth()->user()->isAdmin())
                                <form action="{{ route('course.destroy', $course->id) }}" method="POST" class="inline text-end">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex text-red-600 hover:text-red-900 text-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" /><path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" /></svg>
                                    </button>
                                </form>
                                <a href="{{ route('courses.edit', $course->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-ballpen"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 6l7 7l-4 4" /><path d="M5.828 18.172a2.828 2.828 0 0 0 4 0l10.586 -10.586a2 2 0 0 0 0 -2.829l-1.171 -1.171a2 2 0 0 0 -2.829 0l-10.586 10.586a2.828 2.828 0 0 0 0 4z" /><path d="M4 20l1.768 -1.768" /></svg>
                                </a>
                            @endif
                        </div>
                        @if(auth()->check())
                                @if(auth()->user()->isAdmin())
                                    <!-- Mensaje de depuración para verificar si el usuario es administrador -->
                                    <p>El usuario es administrador.</p>
                                @else
                                    <!-- Mensaje de depuración para verificar si el usuario no es administrador -->
                                    <p>El usuario no es administrador.</p>
                                @endif
                        @endif
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Sección para mostrar los cursos inscritos -->
        <h1 class="text-3xl font-semibold mb-4 text-center m-5 text-white">Cursos Inscritos</h1>
        <div class="mt-8 grid grid-cols-4 gap-10">
            @foreach (auth()->user()->courses as $enrolledCourse)
                <div class="border border-gray-200 p-4 rounded-md">
                    <h2 class="text-2xl font-semibold text-center">{{ $enrolledCourse->name }}</h2>
                    <p class="text-left" style="word-wrap: break-word;">
                        {{ $enrolledCourse->description }}
                    </p>
                    <!-- Botón para cancelar la inscripción -->
                    <form action="{{ route('courses.unenroll', $enrolledCourse) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-center"> <!-- Div para centrar el botón -->
                            <button type="submit" class="relative inline-block px-4 py-2 m-4 font-medium group flex justify-center">
                                <span class="absolute inset-0 w-auto h-full transition duration-200 ease-out transform translate-x-1 translate-y-1 bg-black group-hover:-translate-x-0 group-hover:-translate-y-0"></span>
                                <span class="absolute inset-0 w-auto h-full bg-white border-2 border-black group-hover:bg-black"></span>
                                <span class="relative text-black group-hover:text-white">Cancelar Inscripción</span>
                            </button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>   
</x-app-layout>