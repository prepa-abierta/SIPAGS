<?php

namespace App\Model\Discapacidad;

use Illuminate\Database\Eloquent\Model;
use App\Model\Aspirante\Aspirante;
class Discapacidad extends Model
{
    protected $fillable = [
        'Clave_Disc',
        'Discapacidad_Dsc'
    ];
    public function aspirante(){
        return $this->hasMany(Aspirante::class);
    }

}
