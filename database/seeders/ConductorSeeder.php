<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConductorSeeder extends Seeder
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
                "nombres" => "RUPERTO",
                "apellidos" => "APAZA NAVARRO",
                "licencia" => "H29470988",
                "nroDoc" => 29470988,
                "id_tipodocumento" => 2,
                "fav" => false,
                "isCompany" => true,
                "nombreCorto" => "RUPERTO APAZA",
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                "nombres" => "ELIAS",
                "apellidos" => "SARAYASI SARAYASI",
                "licencia" => "H30642561",
                "nroDoc" => 30642561,
                "id_tipodocumento" => 2,
                "fav" => false,
                "isCompany" => true,
                "nombreCorto" => "ELIAS SARAYASI",
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                "nombres" => "IVAN",
                "apellidos" => "ZUÑIGA MESCCO",
                "licencia" => "H40974427",
                "nroDoc" => 40974427,
                "id_tipodocumento" => 2,
                "fav" => false,
                "isCompany" => true,
                "nombreCorto" => "IVAN ZUÑIGA",
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                "nombres" => "JOSE LUIS",
                "apellidos" => "AGUILAR HUAMANI",
                "licencia" => "H29541035",
                "nroDoc" => 29541035,
                "id_tipodocumento" => 2,
                "fav" => false,
                "isCompany" => true,
                "nombreCorto" => "JOSE AGUILAR",
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                "nombres" => "JOSE LUIS",
                "apellidos" => "TEJADA AGUILAR",
                "licencia" => "H29541217",
                "nroDoc" => 29541217,
                "id_tipodocumento" => 2,
                "fav" => false,
                "isCompany" => true,
                "nombreCorto" => "JOSE TEJADA",
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                "nombres" => "FREDY",
                "apellidos" => "QUISPE CHOQUEHUANCA",
                "licencia" => "H29712606",
                "nroDoc" => 29712606,
                "id_tipodocumento" => 2,
                "fav" => false,
                "isCompany" => true,
                "nombreCorto" => "FREDY QUISPE",
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                "nombres" => "FREDY LUPACA MAMANI",
                "apellidos" => "LUPACA MAMANI",
                "licencia" => "K41762108",
                "nroDoc" => 41762108,
                "id_tipodocumento" => 2,
                "fav" => false,
                "isCompany" => true,
                "nombreCorto" => "FREDY LUPACA",
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                "nombres" => "RICHARD WILLIAMS QUISPE MAMANI",
                "apellidos" => "QUISPE MAMANI",
                "licencia" => "K00676208",
                "nroDoc" => "00676208",
                "id_tipodocumento" => 2,
                "fav" => false,
                "isCompany" => true,
                "nombreCorto" => "RICHARD QUISPE",
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                "nombres" => "NOE AMADO MARTINEZ ARGOTE",
                "apellidos" => "MARTINEZ ARGOTE",
                "licencia" => "K41773399",
                "nroDoc" => 41773399,
                "id_tipodocumento" => 2,
                "fav" => false,
                "isCompany" => true,
                "nombreCorto" => "NOE MARTINEZ",
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                "nombres" => "NESTOR WILBER",
                "apellidos" => "MAMANI VILCA",
                "licencia" => "K40098489",
                "nroDoc" => 40098489,
                "id_tipodocumento" => 2,
                "fav" => false,
                "isCompany" => true,
                "nombreCorto" => "NESTOR MAMANI",
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                "nombres" => "DARIO FAUSTO",
                "apellidos" => "AGUILAR SOLIS",
                "licencia" => "K42752882",
                "nroDoc" => 42752882,
                "id_tipodocumento" => 2,
                "fav" => false,
                "isCompany" => true,
                "nombreCorto" => "DARIO AGUILAR",
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                "nombres" => "LEANDRO",
                "apellidos" => "YUJRA PAREDES",
                "licencia" => "K00523243",
                "nroDoc" => "00523243",
                "id_tipodocumento" => 2,
                "fav" => false,
                "isCompany" => true,
                "nombreCorto" => "LEANDRO YUJRA",
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                "nombres" => "JOSE ALFREDO",
                "apellidos" => "JIMENEZ APAZA",
                "licencia" => "K80241880",
                "nroDoc" => 80241880,
                "id_tipodocumento" => 2,
                "fav" => false,
                "isCompany" => true,
                "nombreCorto" => "JOSE JIMENEZ",
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
            array(
                "nombres" => "HUGO MANUEL",
                "apellidos" => "MENDOZA CCAMA",
                "licencia" => "K00795924",
                "nroDoc" => "00795924",
                "id_tipodocumento" => 2,
                "fav" => false,
                "isCompany" => true,
                "nombreCorto" => "HUGO MENDOZA",
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )
        ];

        // DB::table('conductores')->insert($datos);
    }
}
