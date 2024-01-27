<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'lieu',
        'description',
        'date',
        'statut',
        'user_id'
    ];

    public function categorie()
    {
        return $this->belongsToMany(Categorie::class, 'roles_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

}
