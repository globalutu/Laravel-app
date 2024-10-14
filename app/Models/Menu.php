<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $primaryKey = 'Idmen';

    protected $fillable = ['libelle', 'route', 'icon'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'Idmen', 'Idmen');
    }
}