<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $table = 'journals';
    protected $fillable = [
        'libelle',
        'description',
        'objet_id',
        'user_id',
        'objet_type',
        'proprietes',
        'client_id',
        'date_ope',
        'montant_paye',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
