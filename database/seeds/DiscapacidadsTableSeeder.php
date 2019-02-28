<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\Discapacidad\Discapacidad;
class DiscapacidadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $disca = \Storage::get("discapacidades.json");
      $discapacidad = json_decode($disca, true);

      Discapacidad::insert($discapacidad);
    }
}
