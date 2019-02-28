<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class CurpController extends Controller
{
    public function getCurp(Request $request)
    {
      //MEGA000701MJCDRNA7
      //SAMJ971106MJCNRN00
      $esta = \Storage::get("estados.json");
      $estados = json_decode($esta);
      $muni = \Storage::get("municipios.json");
      $municipios = json_decode($muni, true);
      $client = new Client();
      $res = $client->request('POST', "http://www.renapo.sep.gob.mx/wsrenapo/MainControllerParam",
        [

          'form_params' => [
          'curp' => $request->curp,
          'Submit' => 'Enviar',
        ],
        'headers' => [
        'Content-type' => 'application/x-www-form-urlencoded'
        ]
      ]);
      $html =  (string)$res->getBody()->getContents();
      $datos_curp = explode( '>', $html);
      $entidad =utf8_encode(substr($datos_curp[180], 0, -5));
      $municipio =utf8_encode(substr($datos_curp[90], 0, -5));
      $entidads = mb_strtoupper($estados[$entidad-1]->name);
      $municipio = (int)$municipio;

      $counts =  count($municipios);
      for ($i=0; $i < $counts; $i++) {
        if($entidad == $municipios[$i]['state_id'] && $municipio == $municipios[$i]['id'])
        {
          $municipio = $municipios[$i]["name"];
          break;
        }
      }

      $pais_nacimiento = substr($datos_curp[150], 0, -5);

      if($pais_nacimiento == "MEX"){
        $pais_nacimiento = "MÉXICO";
        $nacionalidad = "MEXICANA";
      }
      else {
        $pais_nacimiento=$pais_nacimiento;
        $nacionalidad="EXTRANJERO";
      }


      $curps = array(
      'Curp' => utf8_encode($request->curp),
      'Nombre' => utf8_encode(substr($datos_curp[160], 0, -5)),
      'Paterno' => utf8_encode(substr($datos_curp[30], 0, -5)),
      'Materno' => utf8_encode(substr($datos_curp[40], 0, -5)),
      'Sexo' => utf8_encode(substr($datos_curp[200], 0, -5)),
      'Nacionalidad' => $nacionalidad,
      'Pais_Nacimiento' => $pais_nacimiento,
      'Fecha_Nacimiento' => utf8_encode(substr($datos_curp[110], 0, -5)),
      'Entidad' => mb_strtoupper($entidads),//80
      'Municipio' => mb_strtoupper($municipio),
      'Edad' => utf8_encode("22"));
      return $curps;
      /*$curps = array(
      'Curp' => utf8_encode("prueba"),
      'Nombre' => utf8_encode("prueba"),
      'Paterno' => utf8_encode("prueba"),
      'Materno' => utf8_encode("prueba"),
      'Sexo' => utf8_encode("prueba"),
      'Nacionalidad' => "prueba",
      'Pais_Nacimiento' => "prueba",
      'Fecha_Nacimiento' => utf8_encode("prueba"),
      'Entidad' => mb_strtoupper("prueba"),//80
      'Municipio' => mb_strtoupper("prueba"),
      'Edad' => utf8_encode("22"));
      return $curps;
      /**/
    /*  $json_data = array(
        "Curp" => "Prueba", //$doom->getElementsByTagName('Curp')->item(0)->nodeValue,
        "Paterno" => "prueba",//$doom->getElementsByTagName('Paterno')->item(0)->nodeValue,
        "Materno" => "prueba",//$doom->getElementsByTagName('Materno')->item(0)->nodeValue,
        "Nombre" => "prueba",//$doom->getElementsByTagName('Nombre')->item(0)->nodeValue,
        "Sexo" => "prueba",//$doom->getElementsByTagName('Sexo')->item(0)->nodeValue,
        "FechaNacimiento" => "prueba",//$doom->getElementsByTagName('FechaNacimiento')->item(0)->nodeValue,
        "Municipio" => "prueba",//$doom->getElementsByTagName('CveMunicipioReg')->item(0)->nodeValue,
        "Entidad" => "prueba",//$doom->getElementsByTagName('NumEntidadReg')->item(0)->nodeValue,
        "Nacionalidad" => "prueba");//$doom->getElementsByTagName('Nacionalidad')->item(0)->nodeValue);
      return json_encode($json_data);
        /*$curp = $request->curp;
      	$peticion = '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:ValidateMexico">
      	   <soapenv:Header/>
      	   <soapenv:Body>
      	      <urn:Curp soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
      		 <return xsi:type="urn:CurpReq">
      		    <user xsi:type="xsd:string">prueba</user>
      		    <password xsi:type="xsd:string">sC}9pW1Q]c</password>
      		    <Curp xsi:type="xsd:string">'.$curp.'</Curp>
      		 </return>
      	      </urn:Curp>
      	   </soapenv:Body>
      	</soapenv:Envelope>';
              $header = array(
                  'Content-type: text/xml;charset="utf-8"',
                  'Accept-Encoding: gzip, deflate',
                  'SOAPAction: "urn:ValidateMexico#Curp"',
                  'Connection: Keep-Alive',
                  'Content-length: '.strlen($peticion),
              );
              $curl = curl_init();
              curl_setopt($curl, CURLOPT_URL, 'http://187.160.251.219/ws/index.php');
              curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36');
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
              curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
              curl_setopt($curl, CURLOPT_POSTFIELDS, $peticion);
              curl_setopt($curl, CURLOPT_ENCODING, $peticion);
              $re = curl_exec($curl);
      	curl_close($curl);
      	$doom = new \DOMDocument();
      	$doom->loadXML($re);
      	$estatus = $doom->getElementsByTagName('Response')->item(0)->nodeValue;
      	if ($estatus=='correct')
        {
            if($doom->getElementsByTagName('Sexo')->item(0)->nodeValue == "M"){
              $doom->getElementsByTagName('Sexo')->item(0)->nodeValue = "Mujer";
            }
            else {
              $doom->getElementsByTagName('Sexo')->item(0)->nodeValue = "Hombre";
            }
      			$json_data = array(
      				"Curp" => $doom->getElementsByTagName('Curp')->item(0)->nodeValue,
      				"Paterno" => $doom->getElementsByTagName('Paterno')->item(0)->nodeValue,
      				"Materno" => $doom->getElementsByTagName('Materno')->item(0)->nodeValue,
      				"Nombre" => $doom->getElementsByTagName('Nombre')->item(0)->nodeValue,
              "Sexo" => $doom->getElementsByTagName('Sexo')->item(0)->nodeValue,
              "FechaNacimiento" => $doom->getElementsByTagName('FechaNacimiento')->item(0)->nodeValue,
              "Municipio" => $doom->getElementsByTagName('CveMunicipioReg')->item(0)->nodeValue,
              "Entidad" => $doom->getElementsByTagName('NumEntidadReg')->item(0)->nodeValue,
              "Nacionalidad" => $doom->getElementsByTagName('Nacionalidad')->item(0)->nodeValue);
      			echo json_encode($json_data);
      	}
        else
        {
      		echo "Error";
      	}*/
    }

}
