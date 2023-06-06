<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Credit;
use App\Models\Solde;
class Remboursement extends Model
{
    use HasFactory;
    protected $fillable = ['credit_id'];
    public function credit(){
        return $this->belongsTo(Credit::class);
    }
    public function solde(){
        return $this->belongsTo(Solde::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
