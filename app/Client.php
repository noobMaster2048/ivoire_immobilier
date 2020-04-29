<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use SoftDeletes;
    protected $table = 'clients';
    protected $fillable = [
        'nom',
        'prenom',
        'identifiant',
        'statut',
        'cni',
        'profession',
        'lieu_naissance',
        'date_naissance',
        'reseau_principal',
        'reseau_secondaire',
        'tel_principal',
        'tel_secondaire',
        'email',
        'banque',
        'numero_compte',
        'adresse',
        'residence',
        'observations',
        'parrain',
    ];

    public function parrain()
    {
        return $this->belongsTo(User::class, 'parrain');
    }

    public function reglements() {
        return $this->hasMany(Reglement::class, 'client_id');
    }

    public function somme_reglements()
    {
        return $this->hasMany(Reglement::class, 'client_id')
            ->selectRaw('sum(montant) as somme, client_id')->groupBy('client_id');
    }

    public function souscription() {
        return $this->hasOne(Souscription::class, 'client_id');
    }

    public function contrat()
    {
        return $this->hasOne(Contrat::class, 'client_id');
    }
}
