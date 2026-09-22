<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NumeracionVehiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $datos =
            [
                array(
                    "id_numeracion" => 6,
                    "id_primario" => 10,
                    "id_secundario" => 47
                ),
                array(
                    "id_numeracion" => 7,
                    "id_primario" => 43,
                    "id_secundario" => 16
                ),
                array(
                    "id_numeracion" => 8,
                    "id_primario" => 40,
                    "id_secundario" => 46
                ),
                array(
                    "id_numeracion" => 9,
                    "id_primario" => 11,
                    "id_secundario" => 49
                ),
                array(
                    "id_numeracion" => 10,
                    "id_primario" => 8,
                    "id_secundario" => 52
                ),
                array(
                    "id_numeracion" => 11,
                    "id_primario" => 22,
                    "id_secundario" => 3
                ),
                array(
                    "id_numeracion" => 12,
                    "id_primario" => 33,
                    "id_secundario" => 20
                ),
                array(
                    "id_numeracion" => 13,
                    "id_primario" => 23,
                    "id_secundario" => 24
                ),
                array(
                    "id_numeracion" => 14,
                    "id_primario" => 26,
                    "id_secundario" => 25
                ),
                array(
                    "id_numeracion" => 15,
                    "id_primario" => 27,
                    "id_secundario" => 48
                ),
                // array(
                //     "id_numeracion" => 16,
                //     "id_primario" => 53
                // )
            ];
        // DB::table('numeracion_vehiculos')->insert($datos);
    }
}
