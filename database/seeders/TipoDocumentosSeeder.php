<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoDocumentosSeeder extends Seeder
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
              "tipoDoc"=> "0",
              "valor"=> "DOC.TRIB.NO.DOM.SIN.RUC",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ),
            array(
                "tipoDoc"=> "1",
                "valor"=> "DNI",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
              ),
              array(
                "tipoDoc"=> "4",
                "valor"=> "CARNET DE EXTRANJERIA",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
              ),
              array(
                "tipoDoc"=> "6",
                "valor"=> "RUC",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
              ),
              array(
                "tipoDoc"=> "7",
                "valor"=> "PASAPORTE",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
              ),
        ];

        DB::table('tipo_documentos')->insert($datos);

    }
}
