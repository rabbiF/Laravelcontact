<?php

namespace App\Model;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clients()
    {
        return $this->belongsToMany(\App\Model\Client::class, 'bien_client', 'bien_id', 'client_id');
    }
}
