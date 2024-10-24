<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use App\Models\accord_menu;
use Illuminate\Routing\Controller as BaseController;

class MenusControllers extends BaseController
{
    public function menu()
    {
        $menu = Auth::menu();

        if (!$menu) {
            return redirect()->route('login')->withErrors(['error' => 'Vous devez être connecté pour accéder à cette page.']);
        }

        Session::put('Menus', $menu);
        $id = session('Menus')->Iduse;
        $menusassiger = accord_menu::where('Iduse', $id)->pluck('Idmen')->toArray();
        $assignedMenus = Menu::whereIn('Idmen', $menusassiger)->get([
            'libelle',
            'route',
        ]);

        return view('menus.menu', compact('assignedMenus'));
    }

    public function addmenu(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ]);

        try {
            // Vérification si le Menu existe déjà (par le libellé ou le code)
            $existingMenu = Menu::where('libelle', $request->libelle)
                            ->orWhere('route', $request->route)
                            ->orWhere('icon', $request->icon)
                            ->first();

            if ($existingMenu) {
                // Si un Menu avec le même libellé ou code existe, renvoyer une erreur
                return redirect()->back()->with('error', 'Le Menu existe déjà avec ce libellé ou ce code.');
            }

            // Création du Menu si aucun Menu similaire n'existe
            Menu::create([
            'libelle' => $request->libelle,
            'route' => $request->route,
            'icon' => $request->icon,
        ]);

            return redirect()->back()->with('success', 'Menu ajouté avec succès !');
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer le message d'erreur
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout du Menu : '.$e->getMessage());
        }
    }

    public function deltMenu($id)
    {
        $menu = Menu::Where('Idmen', $id)->first();

        if ($menu) {
            $menu->delete();

            return response()->json(['success' => true, 'message' => 'Menu supprimé avec succès!']);
        }

        return response()->json(['success' => false, 'error' => 'Menu introuvable.']);
    }

    public function Modifier($id)
    {
        // Retrieve the menu$menu information by ID
        $menu = Menu::findOrFail($id);

        // Return the view with menu$menu information and roles
        return view('admin.modifmenu', compact('menu'));
    }

    public function updatemenus(Request $request, $id)
    {
        $request->validate([
        'libelle' => 'required|string|max:255',
        'route' => 'required|string|max:255',
        'icon' => 'required|string|max:255',
    ]);

        $menu = Menu::where('Idmen', $id)->firstOrFail();

        $menu->libelle = $request->input('libelle');
        $menu->route = $request->input('route');
        $menu->icon = $request->input('icon');
        $menu->save();

        // Redirecting to the 'menuEdit' route with the correct 'id'
        return redirect()->route('menuEdit', ['id' => $id])->with('success', 'Menu mis à jour avec succès.');
    }

    public function valideupdatemenu(Request $request)
    {
        // dd($request->Iduse);
        $menu = Menu::where('Idmen', $request->id)->first();

        if ($menu) {
            $menu->update([
            'libelle' => $request->libelle,
                    'route' => $request->route,
                    'icon' => $request->icon,
             ]);
            $message = 'Menu mis à jour avec succès.';
        } else {
            $message = 'Menu n\'existe pas .';
        }

        return $message;
    }
}
