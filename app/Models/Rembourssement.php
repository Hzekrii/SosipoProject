<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Credit;
use App\Models\Solde;
class Rembourssement extends Model
{
    use HasFactory;

    public function credit(){
        return $this->belongsTo(Credit::class);
    }
    public function solde(){
        return $this->belongsTo(Solde::class);
    }
}
