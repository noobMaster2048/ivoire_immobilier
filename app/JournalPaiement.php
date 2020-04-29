<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalPaiement extends Model
{
    protected $table = 'journal_paiements';
    protected $fillable = [
        'client_id',
        'user_id',
        'montant',
        'reference',
        'date_validation',
        'reglement_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reglement()
    {
        return $this->belongsTo(Reglement::class, 'reglement_id');
    }
}
