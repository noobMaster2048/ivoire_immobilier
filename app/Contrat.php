<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    protected $table = 'contrats';
    protected $fillable = ['client_id', 'maison_id', 'programme_id', 'epoux', 'ayant', 'date_naissance', 'surface_utile', 'salon', 'terrasse', 'baie', 'nb_chambre', 'salle_manger'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function maison()
    {
        return $this->belongsTo(Maison::class, 'maison_id');
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class, 'programme_id');
    }
}
