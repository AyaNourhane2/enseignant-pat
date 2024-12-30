<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'mots_cles',
        'technologies',
    ];

    public function enseignants()
    {
        return $this->belongsToMany(Enseignant::class, 'projet_enseignants');
    }
}
