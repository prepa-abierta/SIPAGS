<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoblacionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $muni = \Storage::get("municipios.json");
      $municipios = json_decode($muni, true);
      $counts =  count($municipios);
      for ($i=0; $i < $counts; $i++) {
        DB::table('poblacions')->insert([
            'Clave_Poblacion' => $municipios[$i]['id'],
            'Clave_Entidad' => $municipios[$i]['state_id'],
            'Poblacion_Dsc' => $municipios[$i]['name'],
          ]);
        }
    }
}
