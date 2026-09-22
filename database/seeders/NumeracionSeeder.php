<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NumeracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $datos=[
            array(
                "nombre"=> "SERIE: D6Y998",
                "serie"=> "TX01",
                "id_puntoemision"=> 3
            ),
            array(
                "nombre"=> "SERIE: D0Q986",
                "serie"=> "TX02",
                "id_puntoemision"=> 4
            ),
            array(
                "nombre"=> "SERIE: F8U972",
                "serie"=> "TX03",
                "id_puntoemision"=> 5
            ),
            array(
                "nombre"=> "SERIE: AKA983",
                "serie"=> "TX04",
                "id_puntoemision"=> 6
            ),
            array(
                "nombre"=> "SERIE: C6L987",
                "serie"=> "TX05",
                "id_puntoemision"=> 7
            ),
            array(
                "nombre"=> "SERIE: BCK977",
                "serie"=> "TX06",
                "id_puntoemision"=> 8
            ),
            array(
                "nombre"=> "SERIE: BDF978",
                "serie"=> "TX07",
                "id_puntoemision"=> 9
            ),
            array(
                "nombre"=> "SERIE: BEU978",
                "serie"=> "TX08",
                "id_puntoemision"=> 10
            ),
            array(
                "nombre"=> "SERIE: BEU970",
                "serie"=> "TX09",
                "id_puntoemision"=> 11
            ),
            array(
                "nombre"=> "SERIE: BHV970",
                "serie"=> "TX10",
                "id_puntoemision"=> 12
            ),
            array(
                "nombre"=> "SERIE: BXZ868",
                "serie"=> "TX11",
                "id_puntoemision"=> 13
            ),
        ];

        // DB::table('numeracion')->insert($datos);
    }
}
