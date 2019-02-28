<?php

namespace App\Model\Entidad;

use Illuminate\Database\Eloquent\Model;
use App\Model\Aspirante\Aspirante;
class Entidad extends Model
{
    protected $fillable = [
        'Clave_entidad',
        'Entidad_dsc',
        'Abreviatura_entidad',
        'Clave_curp',
        'Clave_entidad_real'
    ];

    //Una entidad tiene muchos aspirantes
    public function aspirante(){
        return $this->hasMany(Aspirante::class);
    }

}
