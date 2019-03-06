<?php

namespace App\Model\Estudiante;

use Illuminate\Database\Eloquent\Model;
use App\Model\Pais\Pais;
use App\Model\Entidad\Entidad;
use App\Model\Poblacion\Poblacion;
use App\Model\Poblacion\Oficina;
use App\Model\Estudiante\Estudiante;

class Estudiante extends Model
{
    protected $fillable = [
        'Matricula',
        'Clave_Oficina',
        'Plan_Estudio',
        'Fecha_Inscripcion',
        'Curp',
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
        'Tipo_Discapacidad',
        'Codigo_postal',
        'Colonia',
        'Direccion',
        'Nivel_Escolaridad',
        'Escuela_Procedencia',
        'Clave_Ultimo_Grado',
        'Anio_Egreso',
        'Numero_Certificado',
        'pais_id',
        'estado_id',
        'poblacion_id',
        'Folio_Surems',
        'Estatus'
    ];

    //El aspirante pertenece a un país
    public function paises(){
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    //El aspirante pertenece a una entidad
    public function entidades(){
        return $this->belongsTo(Entidad::class, 'entidad_id');
    }

    //El aspirante pertenece a una poblacion
    public function poblaciones(){
        return $this->belongsTo(Poblacion::class, 'poblacion_id');
    }
    //El aspirante pertenece a una oficina
    public function oficinas(){
        return $this->belongsTo(Oficina::class, 'oficina_id');
    }

}
