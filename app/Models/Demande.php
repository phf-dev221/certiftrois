<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable=[
        'date_debut',
        'date_fin',
        'detail',
        'email',
        'etat',
    ];
}
