<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Utilisateur;
use Illuminate\Routing\Controller as BaseController;

class UsersControllers extends BaseController
{
    public static function addcreateruser()
    {
        $role = Role::all();

        return view('admin.adduser', compact('role'));
    }

    public function addusers(Request $request)
    {
        $request->validate([
        'nom' => 'required|string|max:255',
        'prenoms' => 'required|string|max:255',
        'email' => 'required|email|unique:utilisateurs,email',
        'role' => 'required|string',
        'mtp' => 'required|string|min:8',
    ]);

        try {
            $user = new Utilisateur();
            $user->nom = $request->nom;
            $user->prenoms = $request->prenoms;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->mtp = bcrypt($request->mtp);
            $user->save();

            return redirect()->back()->with('success', 'Utilisateur ajouté avec succès !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'enregistrement : '.$e->getMessage());
        }
    }

    public function destroyuser($id)
    {
        $user = Utilisateur::Where('Iduse', $id)->first();

        if ($user) {
            $user->delete();

            return response()->json(['success' => true, 'message' => 'Utilisateur supprimé avec succès!']);
        }

        return response()->json(['success' => false, 'error' => 'Utilisateur introuvable.']);
    }

    public function valideupdate(Request $request)
    {
        // dd($request->Iduse);
        $user = Utilisateur::where('Iduse', $request->id)->first();

        if ($user) {
            $user->update([
            'nom' => $request->nom,
                    'prenoms' => $request->prenoms,
                    'role' => $request->role,
                    'email' => $request->email,
             ]);
            $message = 'Utilisateur mis à jour avec succès.';
        } else {
            $message = 'Utilisateur n\'existe pas .';
        }

        return $message;
    }
}
