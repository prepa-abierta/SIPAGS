<?php

namespace App\Http\Controllers\Codigop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use App\Model\Poblacion\Poblacion;
use App\Model\Entidad\Entidad;
class CodigopController extends Controller
{
    public function index(Request $request)
    {
      $client = new Client();

      $res = $client->request('GET', "https://api-codigos-postales.herokuapp.com/v2/codigo_postal/".$request->Codigo, [

      'headers' => [

      'Accept' => 'application/json',

      'Content-type' => 'application/json'

      ]]);
      $datos = json_decode($res->getBody()->getContents(),true);
      $dato = Poblacion::where('Poblacion_Dsc', $datos['municipio'])->first();
      $datos['Escolar_Estado'] = $dato->Clave_Entidad;
      $datos['Escolar_Municipio'] = $dato->Clave_Poblacion;
      $datos['municipio'] = $dato->id;
      $datos['muni'] = $dato->Poblacion_Dsc;
            // $bus = Poblacion::where([['Clave_Poblacion',$datos['municipio']],['Clave_Entidad', $datos['estado']]])->first();
      $entidad = Entidad::where('Entidad_Dsc', $datos['estado'])->first();
      $datos['estado'] = $entidad->Clave_Entidad;
      $datos['es'] = $entidad->Entidad_Dsc;
      /*
      'Clave_Poblacion' => $municipios[$i]['id'],
      'Clave_Entidad' => $municipios[$i]['state_id'],
      'Poblacion_Dsc' => $municipios[$i]['name'],
      */
      //$res = array('estado' => 'Jalisco', 'municipio' => 'Lagos de Moreno', 'colonias'=>['Paseos de las Montañas', 'Colinas del Valle']);
      //$res = json_encode($res, true);
      return $datos;

    }
}
