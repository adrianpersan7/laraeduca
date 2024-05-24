<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight text-center">
            Bienvenido, {{ auth()->user()->name }} ({{ auth()->user()->roles->first()->name }})
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @php
                $user = auth()->user();
                $enrolledCourses = $user->courses;
                $availableCourses = App\Models\Course::whereNotIn('id', $enrolledCourses->pluck('id'))->get();
                @endphp
                @foreach ($availableCourses as $course)
                    <div class="border border-gray-200 p-4 rounded-md relative">
                        <h2 class="text-2xl font-semibold text-center" style="word-wrap: break-word;">{{ $course->name }}</h2>
                        <p class="text-left" style="word-wrap: break-word;">
                            {{ $course->description }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>