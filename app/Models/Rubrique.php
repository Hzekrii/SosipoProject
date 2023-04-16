<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recette;
use App\Models\Depense;

class Rubrique extends Model
{
    use HasFactory;
    public function recette()
    {
        return $this->hasMany(Recette::class);
    }
    public function depense()
    {
        return $this->hasMany(Depense::class);
    }
}
