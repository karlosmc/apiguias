<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModalidadTrasladoSeeder extends Seeder
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
            array("modTraslado"=>"01","desModTraslado"=>"Transporte público","flag"=>"N",'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()),
            array("modTraslado"=>"02","desModTraslado"=>"Transporte privado","flag"=>"N",'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()),
        ];

        DB::table('modalidad_traslado')->insert($datos);
    }
}
