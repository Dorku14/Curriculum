<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Colores;
class habilidades extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion','puntaje','imagen','color','activo'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function colores(){
        return $this->hasOne(Colores::class);
    }
}
