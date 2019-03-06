<?php

namespace App\Model\Aspirante;

use Illuminate\Database\Eloquent\Model;
use App\Model\Pais\Pais;
use App\Model\Entidad\Entidad;
use App\Model\Poblacion\Poblacion;
use App\Model\Archivo\Archivo;
use App\Model\Discapacidad\Discapacidad;
class Aspirante extends Model
{
    protected $fillable = ['Curp',
        'Nombre',
        'Primer_Apellido',
        'Segundo_Apellido',
        'Sexo',
        'Fecha_Nacimiento',
        'Lugar_Nacimiento',
        'Estado_Nacimiento',
        'Nacionalidad',
        'Clave_Pais_Nacimiento',
        'Telefono',
        'Correo',
        'Celular',
        'Discapacidad',
        'discapacidad_id',
        'Codigo_Postal',
        'Colonia',
        'estado',
        'municipio',
        'Direccion',
        'Nivel_Escolaridad',
        'Escuela_Procedencia',
        'Clave_Ultimo_Grado',
        'Anio_Egreso',
        'Numero_Certificado',
        'pais_id',
        'estado_id',
        'municipio_id',
        'Folio_Surems',
        'Estatus'
    ];


    //El aspirante pertenece a un país

    public function archivos(){
        return $this->hasMany(Archivo::class);
    }


    public function paises(){
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    //El aspirante pertenece a una entidad
    public function entidades(){
        return $this->belongsTo(Entidad::class, 'entidad_id');
    }

    //El aspirante pertenece a una poblacion
    public function poblaciones(){
        return $this->belongsTo(Poblacion::class, 'municipio_id');
    }

    public function discapacidades(){
        return $this->belongsTo(Discapacidad::class, 'discapacidad_id');
    }
}
