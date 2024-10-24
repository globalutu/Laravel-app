<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $primaryKey = 'Idrol'; // Nom de la clé primaire dans votre table
    public $incrementing = true; // Si la clé est autoincrémentée
    protected $keyType = 'int';

    protected $fillable = ['libelrol', 'codrol'];
}
