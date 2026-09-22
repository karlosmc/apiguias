<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PuntoEmisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $datos = [
            array(
                "codigo"=> "D6Y998",
                "nombre"=> "PUNTO: D6Y998",
                "codLocal"=> "0000",
                "direccion"=> "CISTERNA D6Y998",
                "ruc"=> "20119207640"
            ),
            array(
                "codigo"=> "D0Q986",
                "nombre"=> "PUNTO: D0Q986",
                "codLocal"=> "0000",
                "direccion"=> "CISTERNA D0Q986",
                "ruc"=> "20119207640"
            ),
            array(
                "codigo"=> "F8U972",
                "nombre"=> "PUNTO: F8U972",
                "codLocal"=> "0000",
                "direccion"=> "CISTERNA F8U972",
                "ruc"=> "20119207640"
            ),
            array(
                "codigo"=> "AKA983",
                "nombre"=> "PUNTO: AKA983",
                "codLocal"=> "0000",
                "direccion"=> "CISTERNA AKA983",
                "ruc"=> "20119207640"
            ),
            array(
                "codigo"=> "C6L987",
                "nombre"=> "PUNTO: C6L987",
                "codLocal"=> "0000",
                "direccion"=> "CISTERNA C6L987",
                "ruc"=> "20119207640"
            ),
            array(
                "codigo"=> "BCK977",
                "nombre"=> "PUNTO: BCK977",
                "codLocal"=> "0000",
                "direccion"=> "CISTERNA BCK977",
                "ruc"=> "20119207640"
            ),
            array(
                "codigo"=> "BDF978",
                "nombre"=> "PUNTO: BDF978",
                "codLocal"=> "0000",
                "direccion"=> "CISTERNA BDF978",
                "ruc"=> "20119207640"
            ),
            array(
                "codigo"=> "BEU978",
                "nombre"=> "PUNTO: BEU978",
                "codLocal"=> "0000",
                "direccion"=> "CISTERNA BEU978",
                "ruc"=> "20119207640"
            ),
            array(
                "codigo"=> "BEU970",
                "nombre"=> "PUNTO: BEU970",
                "codLocal"=> "0000",
                "direccion"=> "CISTERNA BEU970",
                "ruc"=> "20119207640"
            ),
            array(
                "codigo"=> "BHV970",
                "nombre"=> "PUNTO: BHV970",
                "codLocal"=> "0000",
                "direccion"=> "CISTERNA BHV970",
                "ruc"=> "20119207640"
            ),
            array(
                "codigo"=> "BXZ868",
                "nombre"=> "PUNTO: BXZ868",
                "codLocal"=> "0000",
                "direccion"=> "CISTERNA BXZ868",
                "ruc"=> "20119207640"
            ),
        ];

        // DB::table('puntos_emision')->insert($datos);
    }
}
