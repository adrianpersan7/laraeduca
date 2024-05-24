@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'text-xl items-center px-1 pt-1 border-b-3 border-transparent text-sm text-green-300 font-medium  hover:text-green-400 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out'
        : 'text-xl items-center px-1 pt-1 border-b-3 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-green-400 focus:outline-none focus:text-green-700 focus:border-green-700 transition duration-150 ease-in-out';
@endphp

<style>
    /* Estilo para el enlace enfocado */
    .focus-green-700:focus {
        border-color: #047857; /* Color más oscuro para el borde en foco */
    }
</style>

<a {{ $attributes->merge(['class' => $classes . ' focus-green-700']) }}>
    {{ $slot }}
</a>