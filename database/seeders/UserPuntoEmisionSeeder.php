<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserPuntoEmisionSeeder extends Seeder
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
                "id_users"=> 24,
                "id_puntoemision"=> 3
            ),
            array(
                "id_users"=> 25,
                "id_puntoemision"=> 4
            ),
            array(
                "id_users"=> 26,
                "id_puntoemision"=> 5
            ),
            array(
                "id_users"=> 27,
                "id_puntoemision"=> 6
            ),
            array(
                "id_users"=> 28,
                "id_puntoemision"=> 8
            ),
            array(
                "id_users"=> 29,
                "id_puntoemision"=> 9
            ),
            array(
                "id_users"=> 30,
                "id_puntoemision"=> 10
            ),
            array(
                "id_users"=> 31,
                "id_puntoemision"=> 11
            ),
            array(
                "id_users"=> 32,
                "id_puntoemision"=> 12
            ),
        ];

        // DB::table('users_puntoemision')->insert($datos);
    }
}
