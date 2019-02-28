<?php

namespace App\Model\Pais;

use Illuminate\Database\Eloquent\Model;
use App\Model\Aspirante\Aspirante;
class Pais extends Model
{
    protected $fillable = [
        'Clave_pais',
        'Pais_dsc',
        'Abreviatura_pais',
    ];

    //Un pais tiene muchos aspirantes
    public function aspirante(){
        return $this->hasMany(Aspirante::class);
    }
}
