<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table= 'roles';
    protected $fillable = ['nom', 'guard'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'role_user', 'user_id', 'role_id');
    }
}
