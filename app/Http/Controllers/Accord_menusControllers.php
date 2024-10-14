<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Menu;
use App\Models\accord_menu;
use App\Models\Role; // Ensure to include the Role model
use Illuminate\Routing\Controller as BaseController;

class Accord_menusControllers extends BaseController
{
    public static function usersaccordMenu(Request $request)
    {
        // Récupérer tous les menus disponibles
        $menus = Menu::all();

        // Trouver l'utilisateur en fonction de l'ID
        $accord = Utilisateur::where('Iduse', $request->id)->first();

        // Si l'utilisateur existe, récupérer les menus assignés
        $menusassiger = accord_menu::where('Iduse', $request->id)->pluck('Idmen')->toArray();
        $assignedMenus = Menu::whereIn('Idmen', $menusassiger)->get();

        // Passer les variables à la vue
        return view('admin.accordmenu', compact('accord', 'menus', 'assignedMenus'));
    }

    public function saveaccord(Request $request)
    {
        // Valider les données reçues
        $validatedData = $request->validate([
        'user_id' => 'required|exists:Utilisateurs,Iduse', // Assurez-vous que l'utilisateur existe
        'menu' => 'required|exists:Menus,Idmen', // Assurez-vous que le menu existe
    ]);

        try {
            // Vérifier si l'association entre l'utilisateur et le menu existe déjà
            $existingAccord = accord_menu::where('Iduse', $validatedData['user_id'])
                                     ->where('Idmen', $validatedData['menu'])
                                     ->first();

            if ($existingAccord) {
                // Retourner un message d'erreur si le menu est déjà assigné
                return redirect()->back()->with('error', 'Ce menu est déjà assigné à cet utilisateur.');
            }

            // Créer un nouvel enregistrement si l'association n'existe pas
            $accord = new accord_menu();
            $accord->Iduse = $validatedData['user_id'];  // ID de l'utilisateur
        $accord->Idmen = $validatedData['menu'];     // ID du menu
        $accord->save();

            // Retourner un message de succès
            return redirect()->back()->with('success', 'Menu assigné avec succès à l\'utilisateur.');
        } catch (\Exception $e) {
            // En cas d'erreur, retourner un message d'erreur
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'enregistrement.');
        }
    }

    public function userEdit($id)
    {
        // Retrieve the user information by ID
        $user = Utilisateur::findOrFail($id);

        // Retrieve all roles for the dropdown
        $roles = Role::all();

        // Return the view with user information and roles
        return view('admin.useredit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // Valider les données de la requête entrante
        $request->validate([
        'nom' => 'required|string|max:255',
        'prenoms' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'role' => 'required|exists:roles,Idrol', // Vérifiez que le rôle existe
    ]);

        $user = Utilisateur::where('Iduse', $id)->firstOrFail();

        // Mettre à jour les informations de l'utilisateur
        $user->nom = $request->input('nom');
        $user->prenoms = $request->input('prenoms');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->save();

        // Rediriger vers la liste des utilisateurs avec un message de succès
        return redirect()->route('liste.user')->with('success', 'Utilisateur mis à jour avec succès.');
    }
}