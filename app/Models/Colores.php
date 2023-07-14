<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\habilidades;
class Colores extends Model
{
    use HasFactory;
    protected $table = 'colores';
    protected $primaryKey = 'id';
    protected $fillable  = ['descripcion','codigoHex'];

    public function habilidades(){
        return $this->belongsTo(habilidades::class);
    }
}
