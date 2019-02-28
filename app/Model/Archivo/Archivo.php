<?php

namespace App\Model\Archivo;


use Illuminate\Database\Eloquent\Model;
use App\Model\Aspirante\Aspirante;

class Archivo extends Model
{
  protected $fillable = ['aspirante_id', 'name', 'ruta', 'tipo'];

  public function aspirantes(){
      return $this->belongsTo(Aspirante::class, 'aspirante_id');
  }
}
