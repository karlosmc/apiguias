<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IndicadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return voindicador
     */
    public function run()
    {
        
        $datos = [
            array(
              "indicador"=> "SUNAT_Envio_IndicadorTrasladoVehiculoM1L",
              "textoCorto"=> "Traslado en vehiculos M1 o L",
              "tooltip"=> "Vehiculo M1 o L",
              "flag"=>"N",
              "icono"=> "<TaxiAlertIcon />",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ),
            array(
              "indicador"=> "SUNAT_Envio_IndicadorRetornoVehiculoEnvaseVacio",
              "textoCorto"=> "Retorno de vehiculos con envases o embalajes vacíos",
              "tooltip"=> "Envases o embalajes vacío",
              "flag"=>"N",
              "icono"=> "<TaxiAlertIcon />",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ),
            array(
              "indicador"=> "SUNAT_Envio_IndicadorRetornoVehiculoVacio",
              "textoCorto"=> "Retorno de vehículo vacío",
              "tooltip"=> "Vehículo vacío",
              "flag"=>"N",
              "icono"=> "<TaxiAlertIcon />",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ),
            array(
              "indicador"=> "SUNAT_Envio_IndicadorTrasladoTotalDAMoDS",
              "textoCorto"=> "Traslado total de la DAM o DS",
              "tooltip"=> "Total de DAM o DS",
              "flag"=>"N",
              "icono"=> "<TaxiAlertIcon />",
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ),
        ];

        DB::table('indicadores')->insert($datos);
    }
}
