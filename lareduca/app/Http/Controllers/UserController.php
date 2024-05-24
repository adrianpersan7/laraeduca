<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function asignarRolAlumno()
    {
        // Encuentra el rol de "alumno"
        $rolAlumno = Role::where('name', 'alumno')->first();

        // Si el rol "alumno" no existe, crea una lógica para manejar ese caso
        if (!$rolAlumno) {
            // Manejar el caso de que el rol "alumno" no existe
            return response()->json(['message' => 'El rol "alumno" no existe.'], 404);
        }

        // Encuentra todos los usuarios
        $usuarios = User::all();

        // Asigna el rol "alumno" a cada usuario si no tiene un rol asignado previamente
        foreach ($usuarios as $usuario) {
            $tieneRolAsignado = false;
            foreach ($usuario->roles as $rol) {
                if ($rol->name === 'admin' || $rol->name === 'profesor' || $rol->name === 'alumno') {
                    $tieneRolAsignado = true;
                    break;
                }
            }

            if (!$tieneRolAsignado) {
                $usuario->roles()->syncWithoutDetaching([$rolAlumno->id]);
            }
        }

        return view('users', compact('usuarios'));
    }

     // Método para mostrar el formulario de edición de usuario
     public function edit(User $user)
    {
        $roles = Role::all();
        return view('edit', compact('user', 'roles'));
    }
 
     // Método para actualizar un usuario
     public function update(Request $request, User $user)
     {
         // Valida los datos del formulario de edición
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => [
                 'required',
                 'email',
                 'max:255',
                 Rule::unique('users')->ignore($user->id),
             ],
             'role' => 'required|exists:roles,id', // Validación del campo de selección del rol
         ]);
 
         // Actualiza los datos del usuario
         $user->update($request->only(['name', 'email']));
 
         // Actualiza el rol del usuario
         $user->roles()->sync([$request->role]);
 
         // Redirecciona con un mensaje de éxito
         return redirect()->route('users');
     }
 
     // Método para eliminar un usuario
     public function destroy(User $user)
     {
            // Elimina las entradas relacionadas en role_users
        $user->roles()->detach();

        // Elimina el usuario
        $user->delete();

        // Redirecciona con un mensaje de éxito
        return redirect()->route('users');
     }

     // Método para mostrar el formulario de creación de usuario
     public function create()
     {
         $roles = Role::all();
         return view('createUser', compact('roles'));
     }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users'),
            ],
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id', // Validación del campo de selección del rol
            ]);

            // Creación del nuevo usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Asignación del rol seleccionado al nuevo usuario
            $user->roles()->attach($request->role);

            // Redirección con un mensaje de éxito
            return redirect()->route('users');
    }

    public function asignarCurso(Request $request, User $user)
    {
        // Validación de los datos del formulario
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        // Encuentra el curso por su ID
        $course = Course::findOrFail($request->course_id);

        // Asigna el curso al usuario
        $user->courses()->attach($course);

        // Redirección con un mensaje de éxito
        return redirect()->route('users.edit', $user->id)->with('success', 'Curso asignado correctamente.');
    }


}
