<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InitialValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // $empresa = [
        //     array(
        //         'razonSocial' => 'AGROPECUARIA E INDUSTRIAS FAFIO S.A.',
        //         'email' => 'contabilidad@agropecuariafafio.com.pe',
        //         'ruc' => '20519666601',
        //         'direccion' => 'AV. TOMAS MARSANO NRO. 900 URB. CONDOR LIMA - LIMA - SURQUILLO',
        //         'logo' => 'C:/laragon/www/apiguias/logo.png',
        //         'folder' => 'C:/laragon/www/apiguias/',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     )
        // ];

        $cliente = [
            array(
                'numDoc'=>'20533097121',
                'rznSocial'=>'SERVICIOS ALIMENTARIOS VITUÑA SOCIEDAD ANONIMA - SAVIT S.A.',
                'email'=>'contabilidad@kankas.pe',
                'telephone'=>'',
                'id_tipodocumento'=>4,
                'fav'=>false,
                'isCompany'=>true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )
        ];

        $productos = [
            array(
                'codigo' => '0000',
                'codProdSunat' => '',
                'descripcion' => 'VARIOS',
                'unidad' => 'NIU',
                'fav' => true,
                'id_user' => null,
                'nombreCorto' => 'VARIOS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )
        ];

        $puntoubicacion = [
            array(
                'ubigeo' => '230101',
                'codLocal' => '0000',
                'direccion' => 'EDITAR DIRECCION...',
                'ruc' => '',
                'isCompany' => false,
                'fav' => true,
                'nombreCorto' => 'VARIOS',
                'rznSocial' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            )
        ];

        $vehiculos = [
            array(
                'placa' => 'VARIOS',
                'isCompany' => false,
                'nroAutorizacion' => '',
                'nroCirculacion' => '',
                'codEmisor' => ''
            )
        ];

        // DB::table('empresa')->insert($empresa);
        DB::table('clientes')->insert($cliente);
        // DB::table('productos')->insert($productos);
        // DB::table('puntoubicacion')->insert($puntoubicacion);
        // DB::table('vehiculos')->insert($vehiculos);
    }
}
