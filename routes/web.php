<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::GET('/', function () {
    return view('auth.login');
})->name('login');

// Routes pour l'authentification
Route::GET('/login', 'App\Http\Controllers\LoginControllers@login')->name('login.get');
Route::POST('/login', 'App\Http\Controllers\LoginControllers@authenticate')->name('login.post'); // Authentification

// Route pour Accord_menus (utilisez un autre URI)
Route::POST('/accord/save', 'App\Http\Controllers\Accord_menusControllers@saveaccord')->name('accord.post'); // Sauvegarder l'accord de menu

// Autres routes
Route::POST('/register', 'App\Http\Controllers\LoginControllers@registeradd')->name('register.post');
Route::POST('/register', 'App\Http\Controllers\LoginControllers@registeradd')->name('register.post');
Route::GET('/Deconnexion', 'App\Http\Controllers\LoginControllers@logout')->name('decnt');
Route::GET('/viewaddmtp', 'App\Http\Controllers\LoginControllers@forgotview')->name('mdp.get');

Route::GET('/adminview', 'App\Http\Controllers\LoginControllers@adminview')->name('admin.dashboard');
Route::GET('/Creatermenu', 'App\Http\Controllers\LoginControllers@menuview')->name('menu.get');
Route::GET('/listeroles', 'App\Http\Controllers\RolesControllers@roleview')->name('role.get');
Route::GET('/ltuserview', 'App\Http\Controllers\LoginControllers@listeuserview')->name('liste.user');
Route::GET('/ltstoreview', 'App\Http\Controllers\LoginControllers@listemenuview')->name('liste.menus');
Route::GET('/viewadduser', 'App\Http\Controllers\LoginControllers@registerview')->name('user.get');
Route::GET('/addmenu', 'App\Http\Controllers\MenusControllers@addmenus')->name('menus.store');
Route::post('/addusers', 'App\Http\Controllers\UsersControllers@addusers')->name('users.post');
Route::post('/addroles', 'App\Http\Controllers\RolesControllers@addroles')->name('roles.post');
Route::GET('/createruserview', 'App\Http\Controllers\UsersControllers@addcreateruser')->name('useradd');
Route::POST('/addmenu', 'App\Http\Controllers\MenusControllers@addmenu')->name('menu.post');
Route::GET('/destroyuser{id}', 'App\Http\Controllers\UsersControllers@destroyuser')->name('users.destroy');
Route::GET('/usersaccordMenu{id}', 'App\Http\Controllers\Accord_menusControllers@usersaccordMenu')->name('users.accordMenu');
Route::GET('/userEdit{id}', 'App\Http\Controllers\Accord_menusControllers@userEdit')->name('userEdit');
Route::GET('/MenuEdit{id}', 'App\Http\Controllers\MenusControllers@Modifier')->name('menuEdit');
Route::GET('/deltMenu{id}', 'App\Http\Controllers\MenusControllers@deltMenu')->name('deltmenu');
Route::POST('/menusaccordsave', 'App\Http\Controllers\Accord_menusControllers@saveAccord')->name('menus.accord.save');
Route::PUT('/utilisateurs/{id}', 'App\Http\Controllers\Accord_menusControllers@update')->name('users.update');
Route::Post('/updateutilisateurs', 'App\Http\Controllers\UsersControllers@valideupdate')->name('valideupdate');
Route::Post('/updatemenu', 'App\Http\Controllers\MenusControllers@valideupdatemenu')->name('valideupdatemenu');
Route::Post('/updaterole', 'App\Http\Controllers\RolesControllers@valideUpdateRole')->name('valideupdaterole');
Route::PUT('/MenuModifier/{id}', 'App\Http\Controllers\MenusControllers@updatemenus')->name('menus.update');
Route::GET('/menu', 'App\Http\Controllers\MenusControllers@menu')->name('menu');
Route::GET('/search', 'App\Http\Controllers\LoginControllers@search')->name('search');
Route::POST('/password', 'App\Http\Controllers\Auth\ForgotPasswordControllers@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'App\Http\Controllers\Auth\ForgotPasswordControllers@showResetForm')->name('password.reset');
Route::post('/password/reset', 'App\Http\Controllers\Auth\ForgotPasswordControllers@reset')->name('password.update');
