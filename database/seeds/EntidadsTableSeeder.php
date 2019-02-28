<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\Entidad\Entidad;
class EntidadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $estad = \Storage::get("estados.json");
      $estados = json_decode($estad, true);

      Entidad::insert($estados);
    }
}
