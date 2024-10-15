<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Ajoutez cette ligne
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Utilisateur extends Authenticatable // Modifiez cette ligne
{
    use HasFactory;
    use Notifiable;

    protected $table = 'utilisateurs';
    protected $primaryKey = 'Iduse';
    protected $fillable = [
        'nom',
        'prenoms',
        'email',
        'role',
        'mtp',
    ];

    // Méthode pour définir le mot de passe
    public function getAuthPassword()
    {
        return $this->mtp; // Utilisez 'mtp' comme mot de passe
    }
}