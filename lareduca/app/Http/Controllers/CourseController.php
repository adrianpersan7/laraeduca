<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses', compact('courses'));
    }
    
    public function enroll(Request $request, Course $course)
    {
        // Obtenemos el usuario autenticado
        $user = auth()->user();

        // Verificamos si el usuario ya está inscrito en el curso
        if ($user->courses->contains($course)) {
            return redirect()->back()->with('warning', '¡Ya estás inscrito en este curso!');
        }

        // Inscribimos al usuario en el curso
        $user->courses()->attach($course);

        return redirect()->route('courses');
    }
    
    public function unenroll(Course $course)
    {
        $user = auth()->user();
        $user->courses()->detach($course);

        return redirect()->route('courses');
    }

    // Método para mostrar el formulario de creación de un curso
    public function create()
    {
        return view('createCourse');
    }

    // Método para almacenar un nuevo curso en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Creación del nuevo curso
        Course::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirección con un mensaje de éxito
        return redirect()->route('courses');
    }

    public function edit(Course $course)
    {
        return view('editCourse', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('courses');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses');
    }
}
