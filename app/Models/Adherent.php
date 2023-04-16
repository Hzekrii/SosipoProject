<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;

class Adherent extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
