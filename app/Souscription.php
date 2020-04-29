<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;

class Souscription extends Model
{
    public $table = 'souscriptions';
    protected $fillable = ['date_souscription', 'apport_initial', 'statut',
        'solde_initial', 'client_id', 'maison_id', 'option_paiement', 'ecart_paie',
        'date_echeance_1', 'date_echeance_2'];

    public function maison() {
        return $this->belongsTo(Maison::class, 'maison_id');
    }
    public function client() {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function echeanciers() {
        return $this->hasMany(Echeancier::class, 'souscription_id');
    }
}
