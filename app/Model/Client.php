<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'date_contact','name', 'firstname', 'email', 'phone', 'contact_origine', 'projet', 'type_de_bien', 'etat', 'secteur', 'commentaires', 'contact', 'suivi', 'budget', 'client_nego', 'actif', 'options_color', 'options_secteur'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function biens()
    {
        return $this->belongsToMany(\App\Model\Bien::class);
    }

}
