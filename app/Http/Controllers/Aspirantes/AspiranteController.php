<?php

namespace App\Http\Controllers\Aspirantes;

use App\Http\Controllers\Controller;
use App\Model\Aspirante\Aspirante;
use App\Model\Entidad\Entidad;
use App\Model\Poblacion\Poblacion;
use App\Model\Archivo\Archivo;
use App\Model\Pais\Pais;
use App\Model\Discapacidad\Discapacidad;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Storage;
use Mail;

class AspiranteController extends Controller
{
    public function filter(Request $request)
    {
        $query = Aspirante::query();

        if ($request->search) {
            $query->where('name', 'LIKE', '%'.$request->search.'%');
        }
        $aspirantes = $query->with('archivos')->orderBy($request->input('orderBy.column'), $request->input('orderBy.direction'))
                  ->paginate($request->input('pagination.per_page'));

        return $aspirantes;
    }
    public function show($aspirante)
    {
        return Aspirante::where('id', $aspirante)->with('archivos')->get();
    }
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        if ($request->count==1) {
            $reglas = [ 'Curp' => 'required|unique:aspirantes,Curp,'.$request->id,
            'Correo' => 'required|email|unique:aspirantes,Correo,'.$request->id,//|email|unique:users',
            'Telefono' => 'required|numeric|digits:10',
            'Celular' => 'required|numeric|digits:10'
          ];

            $mensajes = [ 'Correo.required' => "Campo Requerido",
            'Correo.email' => "Ingrese un Correo Valido",
            'Correo.unique' => "Ya Es Utilizado Este Correo",
            'Telefono.required' => "Campo Requerido",
            'Telefono.numeric' => "Ingrese Solo Números",
            'Telefono.digits' => "Deben Ser Mínimo 10 Números",
            'Celular.required' => "Campo Requerido",
            'Celular.numeric' => "Ingrese Solo Números",
            'Celular.digits' => "Deben Ser Mínimo 10 Números"
          ];
            //Aspirante::create($request->all());
            $this->validate($request, $reglas, $mensajes);
            $lol = Aspirante::updateOrCreate(
                ['id'=>$request->id],
                $request->except(['Edad', 'count', 'Lugar', 'Estado', 'Nacionalidads'])
            );

            $message = "First Step";
            return $lol;
        }
        if ($request->count==2) {
            $reglas2 = [ 'Nivel_Escolaridad' => 'required',//|email|unique:users',
              'Escuela_Procedencia' => 'required',
              'Clave_Ultimo_Grado' => 'required|numeric|min:1|max:6',
              'Anio_Egreso' => 'required',
              'Numero_Certificado' => 'required|numeric',
              'pais_id' => 'required',

            ];
            if ($request->Edad < 18) {
                $reglas2['Folio_Surems'] = 'required|numeric|digits:9';
            }
            if ($request->pais_id==4142) {
                $reglas2['municipio_id'] = 'required';
                $reglas2['estado_id'] = 'required';
            }
            $mensajes2 = [ 'Nivel_Escolaridad.required' => "Campo Requerido",
              'Escuela_Procedencia.required' => "Campo Requerido",
              'Clave_Ultimo_Grado.required' => "Campo Requerido",
              'Clave_Ultimo_Grado.numeric' => "Ingrese Solo Números",
              'Clave_Ultimo_Grado.min' => "Debe Ser Un Valor entre 1 y 6",
              'Clave_Ultimo_Grado.max' => "Debe Ser Un Valor entre 1 y 6",
              'Anio_Egreso.required' => "Campo Requerido",
              'Numero_Certificado.required' => "Campo Requerido",
              'Numero_Certificado.numeric' => "Ingrese Solo Números",
              'pais_id.required' => "Campo Requerido",
              'estado_id.required' => "Campo Requerido",
              'municipio_id.required' => "Campo Requerido",
              'Folio_Surems.numeric' => 'Ingrese Solo Números',
              'Folio_Surems.digits' => 'Debe Ser Un Valor De 9 Digitos',
              'Folio_Surems.required'=> 'Campo Requerido'
            ];
            $this->validate($request, $reglas2, $mensajes2);
            $lol = Aspirante::updateOrCreate(
                ['id'=>$request->id],
                $request->except([ 'count', 'Lugar', 'Estado', 'Nacionalidads'])
            );
            $message = "Second Step";
            return $lol;
        }
        if ($request->count==3) {
            $reglas3 = ['Codigo_Postal' => 'required',//|email|unique:users',
              'Colonia' => 'required',
              'Direccion' => 'required'
            ];
            $mensajes3 = [ 'Codigo_Postal.required' => "Campo Requerido",
              'Colonia.required' => "Campo Requerido",
              'Direccion.required' => "Campo Requerido"
            ];
            $this->validate($request, $reglas3, $mensajes3);
            $lol = Aspirante::updateOrCreate(
                ['id'=>$request->id],
                $request->except(['Edad', 'count', 'Lugar', 'Estado', 'Nacionalidads'])
            );
            $message = "Third Step";
            return $lol;
        }
        if($request->count==4)
        {
          $lol = Aspirante::find($request->id);
          $archivos = Archivo::where('aspirante_id', $request->id)->get();
          $lol['archivos']=$archivos;
          $count = Archivo::where('aspirante_id', $request->id)->count();
          if ($count == 5) {
              $data = ['usuario' => $lol->Nombre.' '.$lol->Primer_Apellido.' '.$lol->Segundo_Apellido];

              Mail::send('mails.mail', $data, function ($message) use ($lol) {
                  $message->from('preparatoriaabierta@seg.guanajuato.gob.mx', 'Prepa Abierta');

                  $message->to($lol->Correo)->subject('Preinscripción');
              });

              return $lol;
          } else {
              $lol['arch']=$count;
              return $lol;
          }
          return $lol;
        }
        if ($request->hasFile('curp')) {
            $archivo = Archivo::where(['aspirante_id'=>$request->id,'tipo'=>$request->tipo1])->first();
            if ($archivo) {
                Storage::delete($archivo->ruta);
            }

            $files = $request->file('curp');

            foreach ($files as $key => $file) {
                $nombre = "curp.".$file->getClientOriginalExtension();
                $file->storeAs('public/'.$request->Curp.'/', $nombre);
                Archivo::updateOrCreate(['aspirante_id'=>$request->id, 'tipo'=>$request->tipo1], ['aspirante_id'=> $request->id, 'name'=> $nombre, 'ruta' => 'public/'.$request->Curp.'/'.$nombre, 'tipo'=>$request->tipo1]);
            }
        }
        if ($request->hasFile('acta')) {
            $archivo = Archivo::where(['aspirante_id'=>$request->id,'tipo'=>$request->tipo2])->first();
            if ($archivo) {
                Storage::delete($archivo->ruta);
            }

            $files = $request->file('acta');

            foreach ($files as $key => $file) {
                $nombre = "acta.".$file->getClientOriginalExtension();
                $file->storeAs('public/'.$request->Curp.'/', $nombre);
                Archivo::updateOrCreate(['aspirante_id'=>$request->id, 'tipo'=>$request->tipo2], ['aspirante_id'=> $request->id, 'name'=> $nombre, 'ruta' => 'public/'.$request->Curp.'/'.$nombre, 'tipo'=>$request->tipo2]);
            }
        }
        if ($request->hasFile('certificado')) {
            $archivo = Archivo::where(['aspirante_id'=>$request->id,'tipo'=>$request->tipo3])->first();
            if ($archivo) {
                Storage::delete($archivo->ruta);
            }

            $files = $request->file('certificado');

            foreach ($files as $key => $file) {
                $nombre = "certificado.".$file->getClientOriginalExtension();
                $file->storeAs('public/'.$request->Curp.'/', $nombre);
                Archivo::updateOrCreate(['aspirante_id'=>$request->id, 'tipo'=>$request->tipo3], ['aspirante_id'=> $request->id, 'name'=> $nombre, 'ruta' => 'public/'.$request->Curp.'/'.$nombre, 'tipo'=>$request->tipo3



              ]);
            }
        }
        if ($request->hasFile('identificacion')) {
            $archivo = Archivo::where(['aspirante_id'=>$request->id,'tipo'=>$request->tipo4])->first();
            if ($archivo) {
                Storage::delete($archivo->ruta);
            }

            $files = $request->file('identificacion');

            foreach ($files as $key => $file) {
                $nombre = "identificacion.".$file->getClientOriginalExtension();
                $file->storeAs('public/'.$request->Curp.'/', $nombre);
                Archivo::updateOrCreate(['aspirante_id'=>$request->id, 'tipo'=>$request->tipo4], ['aspirante_id'=> $request->id, 'name'=> $nombre, 'ruta' => 'public/'.$request->Curp.'/'.$nombre, 'tipo'=>$request->tipo4]);
            }
        }
        if ($request->hasFile('comprobante')) {
            $archivo = Archivo::where(['aspirante_id'=>$request->id,'tipo'=>$request->tipo5])->first();
            if ($archivo) {
                Storage::delete($archivo->ruta);
            }

            $files = $request->file('comprobante');

            foreach ($files as $key => $file) {
                $nombre = "comprobante.".$file->getClientOriginalExtension();
                $file->storeAs('public/'.$request->Curp.'/', $nombre);
                Archivo::updateOrCreate(['aspirante_id'=>$request->id, 'tipo'=>$request->tipo5], ['aspirante_id'=> $request->id, 'name'=> $nombre, 'ruta' => 'public/'.$request->Curp.'/'.$nombre, 'tipo'=>$request->tipo5]);
            }
        }
    }

    public function busqueda(Request $request)
    {
        $aspirante = json_encode(Aspirante::where('Curp', $request->curp)->count());
        if ($aspirante) {
            $datos = Aspirante::where('Curp', $request->curp)->first();
            $pais = Pais::where("id", $datos->Clave_Pais_Nacimiento)->first();

            $archivos = json_decode(Archivo::where('aspirante_id', $datos->id)->get());
            if ($datos->Estado_Nacimiento!=null) {
                $estado = Entidad::where('Clave_Entidad', $datos->Estado_Nacimiento)->first();
                $datos["Estado"] =  mb_strtoupper($estado->Entidad_Dsc);
            }
            if ($datos->Estado_Nacimiento!= null && $datos->Lugar_Nacimiento != null) {
                $lugar = Poblacion::where([['Clave_Entidad', $datos->Estado_Nacimiento],
                                     ['Clave_Poblacion', $datos->Lugar_Nacimiento]])->first();
                $datos["Lugar"] = mb_strtoupper($lugar->Poblacion_Dsc);
            }
            $datos["Nacionalidads"] = !$datos['Nacionalidad']? "MEXICANA": "EXTRANJERO";
            $datos["Fecha_Nacimiento"] = Carbon::parse($datos["Fecha_Nacimiento"])->format('Y-m-d');
            if ($datos->municipio_id!= null) {
                $lugar = Poblacion::where('id', $datos->municipio_id)->first();
                $datos["municipio"] = $datos->municipio_id;
                $estado = Entidad::where('Clave_Entidad', $datos->estado_id)->first();
                $datos["estado"] = $datos->estado_id;
            }
            $datos["archivos"] = $archivos;

            $datos["sexo"]= ($datos["Sexo"]=="M")?"MUJER":"HOMBRE";
            $datos["PaisNacimiento"] = $pais->Pais_Dsc;
            $datos['Edad'] = Carbon::parse($datos->Fecha_Nacimiento)->age;
            return response()->json($datos);
        } else {
            $client = new Client();
            $res = $client->request(
                'POST',
                "http://www.renapo.sep.gob.mx/wsrenapo/MainControllerParam",
                [
              'form_params' => [
                'curp' => $request->curp,
                'Submit' => 'Enviar',
              ],
              'headers' => [
                'Content-type' => 'application/x-www-form-urlencoded'
              ]
            ]
          );
            $html =  (string)$res->getBody()->getContents();
            $datos_curp = explode('>', $html);
            $Entidads =utf8_encode(substr($datos_curp[180], 0, -5));
            $municipio =utf8_encode(substr($datos_curp[90], 0, -5));
            $estado = Entidad::where('Clave_Entidad', (int)$Entidads)->first();
            $lugar = Poblacion::where([['Clave_Entidad', $Entidads],
                                     ['Clave_Poblacion', (int)$municipio]])->first();
            /*
            $Entidad = mb_strtoupper($estados[$Entidads-1]->name);



            $municipio = (int)$municipio;
            $at = (int)$municipio;
            $counts =  count($municipios);
            for ($i=0; $i < $counts; $i++) {

                if ($Entidads == $municipios[$i]['state_id'] && $municipio == $municipios[$i]['id']) {
                    $Entidadea = $municipios[$i]['state_id'];
                    $municipio = $municipios[$i]["name"];
                    break;
                }
            }
*/
            $pais_nacimiento = substr($datos_curp[150], 0, -5);
            $pais = Pais::where("Abreviatura_Pais", $pais_nacimiento)->first();

            if ($pais_nacimiento == "MEX") {
                $pais_nacimiento = "MÉXICO";
                $nacionalidad = 0;
                $nacionalidads = "MEXICANA";
            } else {
                $pais_nacimiento=$pais_nacimiento;
                $nacionalidad = 1;
                $nacionalidads="EXTRANJERO";
            }
            $curps = array('Curp' => utf8_encode($request->curp),
            'Nombre' => ucwords(mb_strtolower(utf8_encode(substr($datos_curp[160], 0, -5)))),
            'Primer_Apellido' => ucwords(mb_strtolower(utf8_encode(substr($datos_curp[30], 0, -5)))),
            'Segundo_Apellido' => ucwords(mb_strtolower(utf8_encode(substr($datos_curp[40], 0, -5)))),
            'Sexo' => ucwords(mb_strtolower(utf8_encode(substr($datos_curp[200], 0, -5)))),
            'Nacionalidads' => ucwords(mb_strtolower($nacionalidads)),
            'Nacionalidad' => ucwords(mb_strtolower($nacionalidad)),
            'Clave_Pais_Nacimiento' => ucwords(mb_strtolower($pais->Clave_Pais)),
            'PaisNacimiento' => ucwords(mb_strtolower($pais->Pais_Dsc)),
            'Fecha_Nacimiento' => Carbon::parse(utf8_encode(str_replace('/', "-", substr($datos_curp[110], 0, -5))))->format('Y-m-d'),
            'Estado' => ucwords(mb_strtolower($estado->Entidad_Dsc)),//80
            'Estado_Nacimiento' => ucwords(mb_strtolower($estado->Clave_Entidad)),
            'Lugar' => ucwords(mb_strtolower($lugar->Poblacion_Dsc)),
            'Lugar_Nacimiento' => ucwords(mb_strtolower($lugar->Clave_Poblacion)),
            'Edad' => Carbon::parse(utf8_encode(str_replace('/', "-", substr($datos_curp[110], 0, -5))))->age
          );
            $curps["sexo"]= utf8_encode(substr($datos_curp[200], 0, -5))=="M"?"Mujer":"Hombre";

            return response()->json($curps);
            // return $curps;
        }
        return response()->json($curps);
    }

    public function guardar(Request $request)
    {
        $lol = Aspirante::updateOrCreate(
            ['id'=>$request->id],
            $request->except(['Edad', 'count', 'Lugar', 'Estado', 'Nacionalidads','domicilio', 'colonias','Estado','Municipio'])
        );
        return $lol;
    }




    public function edit(Aspirante $aspirante)
    {
        //
    }

    public function update(Request $request, Aspirante $aspirante)
    {
        //
    }

    public function destroy(Aspirante $aspirante)
    {
        //
    }
}
