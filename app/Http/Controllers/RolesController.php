<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(
            [
                'message' => 'Roles List',
                'roles' => Roles::all()
            ]
            );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $rol = new Roles();
        $rol->nombre_rol = $request->nombre_rol;
        $rol->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return response()->json(
            [
                'message' => 'Roles Details',
                'roles' => Roles::find($id) == null ? 'Not found' : Roles::find($id)
            ]
            );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $rol = Roles::FindOrFail($id);
        $rol->nombre_rol = $request->nombre_rol;
        $rol->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $rol = Roles::FindOrFail($id);
        $rol->delete();
        return response()->json(
            [
                'message' => 'Rol deleted'
            ]
            );
    }
}
