<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Echeancier extends Model
{
    protected $table = 'echeanciers';
    protected $fillable = ['souscription_id', 'date_echeance', 'numero_ordre', 'ecart','montant', 'jour', 'mois', 'annee'];

    public function souscription() {
        return $this->belongsTo(Souscription::class, 'souscription_id');
    }
}
