<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductoSeeder extends Seeder
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
                    "codigo" => "0000104",
                    "codProdSunat" => "",
                    "descripcion" => "POLLO ENTERO PARRILLERO",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "POLLO PARRILLERO"
                ),
                array(
                    "codigo" => "0000316",
                    "codProdSunat" => "",
                    "descripcion" => "ANTICUCHO DE POLLO (P) 40 GR.",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "ANT  POLLO (P) 40GR"
                ),
                array(
                    "codigo" => "0000317",
                    "codProdSunat" => "",
                    "descripcion" => "FILETE DE PECHUGA DE POLLO (P) 350 GR.",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "FILETE POLLO 350 GR."
                ),
                array(
                    "codigo" => "0000321",
                    "codProdSunat" => "",
                    "descripcion" => "MOLLEJA DE POLLO (P)",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "MOLLEJA (P)"
                ),
                array(
                    "codigo" => "0000540",
                    "codProdSunat" => "",
                    "descripcion" => "RB CHICHA MORADA",
                    "unidad" => "LTR",
                    "fav" => true,
                    "nombreCorto" => "RB CHICHA MORADA"
                ),
                array(
                    "codigo" => "0000120",
                    "codProdSunat" => "",
                    "descripcion" => "LOMO FINO",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "LOMO FINO (350GR)"
                ),
                array(
                    "codigo" => "0000106",
                    "codProdSunat" => "",
                    "descripcion" => "CABEZA DE LOMO DE RES",
                    "unidad" => "KGM",
                    "fav" => true,
                    "nombreCorto" => "CABEZA DE LOMO "
                ),
                array(
                    "codigo" => "0000114",
                    "codProdSunat" => "",
                    "descripcion" => "CHULETA DE CHANCHO (P)",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "CHULETA DE CERDO (P)"
                ),
                array(
                    "codigo" => "0000115",
                    "codProdSunat" => "",
                    "descripcion" => "CHULETA DE RES (P)",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "CHULETA DE RES (P)"
                ),
                array(
                    "codigo" => "0000116",
                    "codProdSunat" => "",
                    "descripcion" => "CHULETA DE CORDERO (P)",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "CHULETA CORDERO (P)"
                ),
                array(
                    "codigo" => "0000266",
                    "codProdSunat" => "",
                    "descripcion" => "BIFE DE CHORIZO 350 GR (P)",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "BIFE CHORIZO 350GR"
                ),
                array(
                    "codigo" => "0000314",
                    "codProdSunat" => "",
                    "descripcion" => "ANTICUCHO DE CORAZON (P) 45 GR",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "ANT CORAZON (P) 45GR"
                ),
                array(
                    "codigo" => "0000315",
                    "codProdSunat" => "",
                    "descripcion" => "ANTICUCHO DE RES (P) 45 GR.",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "ANT DE RES (P) 45GR"
                ),
                array(
                    "codigo" => "0000176",
                    "codProdSunat" => "",
                    "descripcion" => "CARBON HUARANGO",
                    "unidad" => "KGM",
                    "fav" => true,
                    "nombreCorto" => "CARBON "
                ),
                array(
                    "codigo" => "0000124",
                    "codProdSunat" => "",
                    "descripcion" => "RB MAYONESA",
                    "unidad" => "LTR",
                    "fav" => true,
                    "nombreCorto" => "RB MAYONESA"
                ),
                array(
                    "codigo" => "0000200",
                    "codProdSunat" => "",
                    "descripcion" => "RB VINAGRETA",
                    "unidad" => "LTR",
                    "fav" => true,
                    "nombreCorto" => "RB VINAGRETA"
                ),
                array(
                    "codigo" => "0000202",
                    "codProdSunat" => "",
                    "descripcion" => "RB ADEREZO POLLO",
                    "unidad" => "KGM",
                    "fav" => true,
                    "nombreCorto" => "RB ADEREZO POLLO"
                ),
                array(
                    "codigo" => "0000199",
                    "codProdSunat" => "",
                    "descripcion" => "RB SALSA DE AJI",
                    "unidad" => "LTR",
                    "fav" => true,
                    "nombreCorto" => "RB SALSA DE AJI"
                ),
                array(
                    "codigo" => "0000466",
                    "codProdSunat" => "",
                    "descripcion" => "BOLSA 482MMx510MMx.09 A/D BLANCO 10KG",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "BOLSA KANKAS 10KG"
                ),
                array(
                    "codigo" => "0000467",
                    "codProdSunat" => "",
                    "descripcion" => "BOLSA 406MMx480MMx.08 A/D BLANCO 5KG",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "BOLSA KANKAS 5KG"
                ),
                array(
                    "codigo" => "0000468",
                    "codProdSunat" => "",
                    "descripcion" => "BOLSA 305MMx410MMx.07 A/D BLANCO 3KG",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "BOLSA KANKAS 3KG"
                ),
                array(
                    "codigo" => "0000177",
                    "codProdSunat" => "",
                    "descripcion" => "CHORIZO",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "CHORIZO"
                ),
                array(
                    "codigo" => "0000178",
                    "codProdSunat" => "",
                    "descripcion" => "HOT DOG DE POLLO",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "HOT DOG"
                ),
                array(
                    "codigo" => "0000678",
                    "codProdSunat" => "",
                    "descripcion" => "CONTENEDOR 4 BIOFORM BLANCO FBC",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "CT4"
                ),
                array(
                    "codigo" => "0000679",
                    "codProdSunat" => "",
                    "descripcion" => "BASE NE PP Y DOMO POLLERA D1 TR BOPS KIT",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "DOMO POLLERA KIT"
                ),
                array(
                    "codigo" => "0000682",
                    "codProdSunat" => "",
                    "descripcion" => "CONTENEDOR 5 BIOFORM BLANCO FBC",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "CT5"
                ),
                array(
                    "codigo" => "0000683",
                    "codProdSunat" => "",
                    "descripcion" => "CONTENEDOR 3 BIOFORM BLANCO FBC",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "CT3"
                ),
                array(
                    "codigo" => "0000828",
                    "codProdSunat" => "",
                    "descripcion" => "CONTENEDOR 1 BIOFORM KRAFT CARTON P1S",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "CRAF 1"
                ),
                array(
                    "codigo" => "0000831",
                    "codProdSunat" => "",
                    "descripcion" => "BASE NE PP Y DOMO LUNCH D1 TR BOPS KIT",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "DOMO LUNCH KIT"
                ),
                array(
                    "codigo" => "0000835",
                    "codProdSunat" => "",
                    "descripcion" => "CONTENEDOR 7 BIOFORM NATURAL CARTON BAGAZO CAÑA P1S",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "CRAFT 7"
                ),
                array(
                    "codigo" => "0001013",
                    "codProdSunat" => "",
                    "descripcion" => "KRAFT BOWL 1000ML",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "KRAFT BOWL 1000ML"
                ),
                array(
                    "codigo" => "0000237",
                    "codProdSunat" => "",
                    "descripcion" => "PAPAS",
                    "unidad" => "KGM",
                    "fav" => true,
                    "nombreCorto" => "PAPAS"
                ),
                array(
                    "codigo" => "0000677",
                    "codProdSunat" => "",
                    "descripcion" => "CONTENEDOR 1 BIOFORM BLANCO FBC",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "CT1"
                ),
                array(
                    "codigo" => "0001014",
                    "codProdSunat" => "",
                    "descripcion" => "KRAFT BOWL 1200ML",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "KRAFT BOWL 1200ML"
                ),
                array(
                    "codigo" => "0001028",
                    "codProdSunat" => "",
                    "descripcion" => "KRAFT BOWL 1300 ML",
                    "unidad" => "NIU",
                    "fav" => true,
                    "nombreCorto" => "KRAFT BOWL 1300 ML"
                ),
            ];
             DB::table('productos')->insert($datos);
    }
}
