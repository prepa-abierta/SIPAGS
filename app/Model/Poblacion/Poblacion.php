<?php

namespace App\Model\Poblacion;

use Illuminate\Database\Eloquent\Model;
use App\Model\Aspirante\Aspirante;
class Poblacion extends Model
{
    protected $fillable = [
        'Clave_poblacion',
        'Clave_entidad',
        'Poblacion_dsc',
    ];

    //Una poblacion tiene muchos aspirantes
    public function aspirante(){
        return $this->hasMany(Aspirante::class);
    }
}
