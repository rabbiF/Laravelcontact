<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'date_contact','name', 'firstname', 'email', 'phone', 'contact_origine', 'projet', 'type_de_bien', 'etat', 'typologie', 'secteur', 'commentaires', 'contact', 'suivi', 'budget', 'propositions', 'visites', 'client_nego'
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
