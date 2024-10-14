<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;
use App\Models\Menu;
use App\Models\accord_menu;
use Illuminate\Routing\Controller as BaseController;

class LoginControllers extends BaseController
{
    public function __construct()
    {
        // Appliquer le middleware d'authentification aux méthodes protégées
        $this->middleware('auth')->only(['adminview', 'menuview', 'roleview', 'listeuserview', 'listemenuview']);
    }

    // Méthode pour afficher le tableau de bord admin
    public function adminview()
    {
        return view('admin.dashbord');
    }

    // Méthode pour afficher la page de connexion
    public function login()
    {
        return view('auth.login');
    }

    // Méthode pour afficher la page d'inscription
    public function registerview()
    {
        return view('auth.register');
    }

    // Méthode pour afficher la page de réinitialisation de mot de passe
    public function forgotview()
    {
        return view('auth.forgot');
    }

    // Méthode pour afficher la page d'ajout d'utilisateur
    public function userview()
    {
        return view('admin.adduser');
    }

    // Méthode pour afficher la page d'ajout de rôle
    public function roleview()
    {
        return view('admin.addrole');
    }

    // Méthode pour afficher la page d'ajout de menu
    public function menuview()
    {
        return view('admin.addmenu');
    }

    // Méthode pour afficher la liste des utilisateurs
    public function listeuserview()
    {
        $user = Utilisateur::all();

        return view('admin.listeuser', compact('user'));
    }

    // Méthode pour afficher la liste des menus
    public function listemenuview()
    {
        $menus = Menu::all();

        return view('admin.listemenu', compact('menus'));
    }

    // Méthode d'authentification
    public function authenticate(Request $request)
    {
        $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

        $user = Utilisateur::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->mtp)) {
            Auth::login($user);
            Session::put('utilisateurs', $user);

            Session::put('role', $user->role);
            $id = session('utilisateurs')->Iduse;
            $menusassiger = accord_menu::where('Iduse', $id)->pluck('Idmen')->toArray();
            $assignedMenus = Menu::whereIn('Idmen', $menusassiger)->get([
            'libelle',
            'route',
        ]);

            Session::put('assignedMenus', $assignedMenus);

            return redirect()->route('admin.dashboard');
        } else {
            return back()->withErrors(['email' => 'Les informations d\'identification sont incorrectes.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        Session::flush();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Vous avez été déconnecté avec succès.');
    }

    // Méthode pour ajouter un nouvel utilisateur
    public function registeradd(Request $request)
    {
        $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|email|unique:client,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

        DB::table('utilisateurs')->insert([
        'nom' => $request->lastName,
        'prenoms' => $request->firstName,
        'email' => $request->email,
        'mtp' => Hash::make($request->password),
        'role' => 3,
    ]);

        return redirect()->route('user.get')->with('success', 'Inscription réussie !');
    }

    public function search(Request $request)
    {
        $role = session('role');
        $searchTerm = $request->input('search');

        $results = collect();

        if ($role == 4) {
            $users = Utilisateur::where('nom', 'LIKE', "%$searchTerm%")
            ->orWhere('prenoms', 'LIKE', "%$searchTerm%")
            ->get();

            $results = $results->merge($users);
        } elseif ($role == 3) {
            return back()->withErrors(['error' => 'Vous ne pouvez pas effectuer de recherche.']);
        }

        return view('admin.search', compact('results'));
    }
}
