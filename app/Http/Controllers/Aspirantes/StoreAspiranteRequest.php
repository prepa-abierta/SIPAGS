<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAspiranteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Curp' => 'required|alpha_num|min:18|max:18',
            'Nombre' => 'required|string|max:40',
            'Primer_Apellido' => 'required|string|max:40',
            'Segundo_Apellido' => 'required|string|max:40',
            'Sexo' => 'required|string|min:1|max:1',
            'Fecha_Nacimiento' => 'required|date_format:Y-m-d',
            'Lugar_Nacimiento' => 'required|integer|min:1',
            'Fecha_Nacimiento' => 'required|date_format:Y-m-d',
            'Estado_Nacimiento' => 'required|integer|min:1',
            'Nacionalidad' => 'required|boolean',
            'Clave_Pais_Nacimiento' => 'required|integer|min:1',
            'Telefono' => 'nullable|required|string|min:10|max:10',
            'Correo' => 'nullable|required|email_address|max:40',
            'Celular' => 'nullable|required|string|min:10|max:10',
            'Discapacidad' => 'nullable|required|boolean',
            'Tipo_Discapacidad' => 'nullable|required|string|min:1|max:1',
            'Codigo_postal' => 'nullable|required|string|min:5|max:5',
            'estado' => 'nullable|required|integer|min:1',
            'municipio' => 'nullable|required|integer|min:1',
            'Colonia' => 'nullable|required|integer|min:1',
            'Direccion' => 'nullable|required|string|max:40',
            'Nivel_Escolaridad' => 'nullable|required|integer|min:1',
            'Escuela_Procedencia' => 'nullable|required|string|max:250',
            'Clave_Ultimo_Grado' => 'nullable|required|integer|min:1',
            'Anio_Egreso' => 'nullable|required|date_format:Y-m-d',
            'Numero_Certificado' => 'nullable|required|string|max:40',
            'pais_id' => 'nullable|required|integer|min:1',
            'estado_id' => 'nullable|required|integer|min:1',
            'municipio_id' => 'nullable|required|integer|min:1',
            'Folio_Surems' => 'nullable|required|integer|min:7|max:7',
            'Estatus' => 'nullable|required|integer|min:1' //max:1
        ];
    }
}
