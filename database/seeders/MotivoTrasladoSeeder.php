<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MotivoTrasladoSeeder extends Seeder
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
                "codTraslado" => "01", "desTraslado" => "Venta", 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),"flag"=>'N'
            ),
            array(
                "codTraslado" => "02", "desTraslado" => "Compra", 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),"flag"=>'N'
            ),
            array(
                "codTraslado" => "03", "desTraslado" => "Venta con entrega a terceros", 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),"flag"=>'N'
            ),
            array(
                "codTraslado" => "04", "desTraslado" => "Traslado entre establecimientos de la misma empresa", 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),"flag"=>'N'
            ),
            array(
                "codTraslado" => "05", "desTraslado" => "Consignación", 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),"flag"=>'N'
            ),
            array(
                "codTraslado" => "06", "desTraslado" => "Devolución", 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),"flag"=>'N'
            ),
            array(
                "codTraslado" => "07", "desTraslado" => "Recojo de bienes transformados", 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),"flag"=>'N'
            ),
            array(
                "codTraslado" => "08", "desTraslado" => "Importación", 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),"flag"=>'N'
            ),
            array(
                "codTraslado" => "09", "desTraslado" => "Exportación", 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),"flag"=>'N'
            ),
            array(
                "codTraslado" => "13", "desTraslado" => "Otros", 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),"flag"=>'N'
            ),
            array(
                "codTraslado" => "14", "desTraslado" => "Venta sujeta a confirmación del comprador", 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),"flag"=>'N'
            ),
            array(
                "codTraslado" => "17", "desTraslado" => "Traslado de bienes para transformación", 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),"flag"=>'N'
            ),
            array(
                "codTraslado" => "18", "desTraslado" => "Traslado emisor itinerante CP", 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),"flag"=>'N'
            ),

        ];

        DB::table('motivo_traslado')->insert($datos);
    }
}
