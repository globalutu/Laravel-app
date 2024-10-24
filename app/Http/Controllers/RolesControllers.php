<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RolesControllers extends Controller
{
    public function roleview()
    {
        $roles = Role::all();

        return view('admin.listerole', compact('roles'));
    }

    public function valideUpdateRole(Request $request)
    {
        $request->validate([
        'id' => 'required|integer',
        'libelrol' => 'required|string|max:255',
        'codrol' => 'required|string|max:255',
    ]);

        try {
            $role = Role::findOrFail($request->id);
            $role->libelrol = $request->libelrol;
            $role->codrol = $request->codrol;
            $role->save();

            return response()->json('Rôle mis à jour avec succès', 200);
        } catch (\Exception $e) {
            return response()->json('Une erreur s\'est produite : '.$e->getMessage(), 500);
        }
    }

    public function addroles(Request $request)
    {
        // Validation des champs
        $request->validate([
        'libelrol' => 'required|string|max:255',
        'codrol' => 'required|string|max:255',
    ]);

        try {
            $existingRole = Role::where('libelrol', $request->libelrol)
                            ->orWhere('codrol', $request->codrol)
                            ->first();

            if ($existingRole) {
                return redirect()->back()->with('error', 'Le rôle existe déjà avec ce libellé ou ce code.');
            }

            Role::create([
            'libelrol' => $request->libelrol,
            'codrol' => $request->codrol,
        ]);

            return redirect()->back()->with('success', 'Rôle ajouté avec succès !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du rôle : '.$e->getMessage());
        }
    }
}
