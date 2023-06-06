<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Adherent;
use App\Models\remboursement;
use App\Models\Solde;
class Credit extends Model
{
    use HasFactory;

    // protected $guarded='approuve';

    public function adherent(){
        return $this->belongsTo(Adherent::class);
    }

    public function remboursements(){
        return $this->hasMany(remboursement::class);
    }
    public function solde(){
        return $this->belongsTo(Solde::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
?>
