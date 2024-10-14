<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RolesControllers extends Controller
{
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