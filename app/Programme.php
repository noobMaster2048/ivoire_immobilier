<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $table = 'programmes';
    protected $fillable = ['code', 'structure', 'libelle', 'description'];
}
