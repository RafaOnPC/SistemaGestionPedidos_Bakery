<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = User::all();
        return view('usuarios.list', compact('usuario'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = User::find($id);
        $roles = Role::all();
        return view('usuarios.editacion', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         //Validacion de Parametros
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'nickname' => ['required', 'string'],
            'name_org' => ['required', 'string'],
            'email' => ['required', 'email'],
        ],[
            'name.required' => 'El nombre es requerido',
            'surname.required' => 'El surname es requerido',
            'nickname.required' => 'El nickname es requerido',
            'name_org.required' => 'El nombre de la organizacion es requerido',
            'email.required' => 'El email es requerido',
        ]);


        $usuario = User::find($id);
        $usuario->name = $validatedData['name'];
        $usuario->surname = $validatedData['surname'];
        $usuario->nickname = $validatedData['nickname'];
        $usuario->name_org = $validatedData['name_org'];
        $usuario->email = $validatedData['email'];

        $usuario->roles()->sync($request->roles);

        $usuario->update();

        return redirect()->route('usuarios.list')->with('success','Empleado actualizado exitosamente');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.list')->with('success','Empleado eliminado exitosamente');
    }
}
