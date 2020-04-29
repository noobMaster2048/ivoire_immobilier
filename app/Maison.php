<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maison extends Model
{
    protected $table = 'maisons';
    protected $fillable = ['denomination', 'standing', 'superficie', 'prix_unitaire', 'programme_id'];

    public function programme() {
        return $this->belongsTo(Programme::class, 'programme_id');
    }
    public function souscription() {
        return $this->hasOne(Souscription::class, 'maison_id');
    }
}
