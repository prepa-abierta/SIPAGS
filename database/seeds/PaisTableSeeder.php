<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\Pais\Pais;
class PaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $pais = \Storage::get("paises.json");
      $paises = json_decode($pais, true);
      $counts =  count($paises);
      for ($i=0; $i < $counts; $i++) {
        DB::table('pais')->insert([
            'id' => $paises[$i]['Clave_Pais'],
            'Clave_Pais' => $paises[$i]['Clave_Pais'],
            'Pais_Dsc' => $paises[$i]['Pais_Dsc'],
            'Abreviatura_Pais' => $paises[$i]['Abreviatura_Pais'],
          ]);
        }
    }
}
