<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight text-center">
            Bienvenido, {{ auth()->user()->name }}
        </h2>
    </x-slot>

    <div class="mb-6 flex justify-end">
        <a href="{{ route('users.create') }}" class="px-5 py-2.5 relative rounded group font-medium text-white font-medium inline-block" style="background-color: #29C9A1; background-image: linear-gradient(to bottom right, #29C9A1, #034C3A);">
            <span class="absolute top-0 left-0 w-full h-full rounded opacity-50 filter blur-sm" style="background-image: linear-gradient(to bottom right, #29C9A1, #034C3A);"></span>
            <span class="h-full w-full inset-0 absolute mt-0.5 ml-0.5 filter group-active:opacity-0 rounded opacity-50" style="background-image: linear-gradient(to bottom right, #29C9A1, #034C3A);"></span>
            <span class="absolute inset-0 w-full h-full transition-all duration-200 ease-out rounded shadow-xl  filter group-active:opacity-0 group-hover:blur-sm" style="background-image: linear-gradient(to bottom right, #29C9A1, #034C3A);"></span>
            <span class="absolute inset-0 w-full h-full transition duration-200 ease-out rounded" style="background-image: linear-gradient(to bottom right, #29C9A1, #034C3A);"></span>
            <span class="relative">Añadir usuario</span>
        </a>
    </div>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-xl rounded-lg" style="background-color: #2a4b43;">
            <div class="p-6">
                <table class="min-w-full divide-y divide-green-200">
                    <thead style="background-color: #2a7664;">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nombre</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Rol</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->roles->first()->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-start justify-start">
                                        <a href="{{ route('users.edit', $usuario->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-ballpen"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 6l7 7l-4 4" /><path d="M5.828 18.172a2.828 2.828 0 0 0 4 0l10.586 -10.586a2 2 0 0 0 0 -2.829l-1.171 -1.171a2 2 0 0 0 -2.829 0l-10.586 10.586a2.828 2.828 0 0 0 0 4z" /><path d="M4 20l1.768 -1.768" /></svg>
                                        </a>
                                        <form action="{{ route('users.destroy', $usuario->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" /><path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>