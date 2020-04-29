<?php

namespace App;

use App\Listeners\PaiementListener;
use Illuminate\Database\Eloquent\Model;


class Reglement extends Model
{

    protected $table = 'reglements';
    protected $fillable = [
        'client_id',
        'maison_id',
        'user_id',
        'date_reglement',
        'montant',
        'mode_reglement',
        'num_cheque',
        'date_cheque',
        'jour',
        'mois',
        'annee',
        'souscription_id',
        'reference',
        'statut',
        'type_regl',
    ];

    public function journal()
    {
        return $this->hasOne(JournalPaiement::class, 'reglement_id');
    }

    public function client() {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function maison()
    {
        return $this->belongsTo(Maison::class, 'maison_id');
    }
}
