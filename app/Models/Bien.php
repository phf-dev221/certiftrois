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
        return $this->belongsTo (Categorie::class);
    }

    public function images()
    {
        return $this->hasOne(Image::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
