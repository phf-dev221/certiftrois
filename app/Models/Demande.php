<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable=[
        'duree',
        'detail',
        'email',
        'etat',
        'user_id'
    ];
}
