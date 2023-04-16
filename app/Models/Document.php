<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    public function recette()
    {
        return $this->belongsTo(type_courrier::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
