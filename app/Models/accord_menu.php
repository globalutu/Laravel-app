<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accord_menu extends Model
{
    use HasFactory;

    public function role()
    {
        return $this->belongsTo(Role::class, 'Idrol');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'Idmen');
    }
}
