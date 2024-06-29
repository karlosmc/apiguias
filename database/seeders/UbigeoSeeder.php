<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UbigeoSeeder extends Seeder
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
                    "ubigeo" => "010101",
                    "fullubigeo" => "010101 CHACHAPOYAS - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "CHACHAPOYAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010102",
                    "fullubigeo" => "010102 ASUNCION - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "ASUNCION", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010103",
                    "fullubigeo" => "010103 BALSAS - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "BALSAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010104",
                    "fullubigeo" => "010104 CHETO - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "CHETO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010105",
                    "fullubigeo" => "010105 CHILIQUIN - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "CHILIQUIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010106",
                    "fullubigeo" => "010106 CHUQUIBAMBA - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "CHUQUIBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010107",
                    "fullubigeo" => "010107 GRANADA - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "GRANADA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010108",
                    "fullubigeo" => "010108 HUANCAS - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "HUANCAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010109",
                    "fullubigeo" => "010109 LA JALCA - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "LA JALCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010110",
                    "fullubigeo" => "010110 LEIMEBAMBA - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "LEIMEBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010111",
                    "fullubigeo" => "010111 LEVANTO - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "LEVANTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010112",
                    "fullubigeo" => "010112 MAGDALENA - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "MAGDALENA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010113",
                    "fullubigeo" => "010113 MARISCAL CASTILLA - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "MARISCAL CASTILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010114",
                    "fullubigeo" => "010114 MOLINOPAMPA - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "MOLINOPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010115",
                    "fullubigeo" => "010115 MONTEVIDEO - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "MONTEVIDEO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010116",
                    "fullubigeo" => "010116 OLLEROS - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "OLLEROS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010117",
                    "fullubigeo" => "010117 QUINJALCA - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "QUINJALCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010118",
                    "fullubigeo" => "010118 SAN FRANCISCO DE DAGUAS - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "SAN FRANCISCO DE DAGUAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010119",
                    "fullubigeo" => "010119 SAN ISIDRO DE MAINO - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "SAN ISIDRO DE MAINO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010120",
                    "fullubigeo" => "010120 SOLOCO - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "SOLOCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010121",
                    "fullubigeo" => "010121 SONCHE - CHACHAPOYAS - AMAZONAS",
                    "distrito" => "SONCHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010201",
                    "fullubigeo" => "010201 BAGUA - BAGUA - AMAZONAS",
                    "distrito" => "BAGUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010202",
                    "fullubigeo" => "010202 ARAMANGO - BAGUA - AMAZONAS",
                    "distrito" => "ARAMANGO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010203",
                    "fullubigeo" => "010203 COPALLIN - BAGUA - AMAZONAS",
                    "distrito" => "COPALLIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010204",
                    "fullubigeo" => "010204 EL PARCO - BAGUA - AMAZONAS",
                    "distrito" => "EL PARCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010205",
                    "fullubigeo" => "010205 IMAZA - BAGUA - AMAZONAS",
                    "distrito" => "IMAZA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010206",
                    "fullubigeo" => "010206 LA PECA - BAGUA - AMAZONAS",
                    "distrito" => "LA PECA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010301",
                    "fullubigeo" => "010301 JUMBILLA - BONGARA - AMAZONAS",
                    "distrito" => "JUMBILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010302",
                    "fullubigeo" => "010302 CHISQUILLA - BONGARA - AMAZONAS",
                    "distrito" => "CHISQUILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010303",
                    "fullubigeo" => "010303 CHURUJA - BONGARA - AMAZONAS",
                    "distrito" => "CHURUJA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010304",
                    "fullubigeo" => "010304 COROSHA - BONGARA - AMAZONAS",
                    "distrito" => "COROSHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010305",
                    "fullubigeo" => "010305 CUISPES - BONGARA - AMAZONAS",
                    "distrito" => "CUISPES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010306",
                    "fullubigeo" => "010306 FLORIDA - BONGARA - AMAZONAS",
                    "distrito" => "FLORIDA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010307",
                    "fullubigeo" => "010307 JAZAN - BONGARA - AMAZONAS",
                    "distrito" => "JAZAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010308",
                    "fullubigeo" => "010308 RECTA - BONGARA - AMAZONAS",
                    "distrito" => "RECTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010309",
                    "fullubigeo" => "010309 SAN CARLOS - BONGARA - AMAZONAS",
                    "distrito" => "SAN CARLOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010310",
                    "fullubigeo" => "010310 SHIPASBAMBA - BONGARA - AMAZONAS",
                    "distrito" => "SHIPASBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010311",
                    "fullubigeo" => "010311 VALERA - BONGARA - AMAZONAS",
                    "distrito" => "VALERA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010312",
                    "fullubigeo" => "010312 YAMBRASBAMBA - BONGARA - AMAZONAS",
                    "distrito" => "YAMBRASBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010401",
                    "fullubigeo" => "010401 NIEVA - CONDORCANQUI - AMAZONAS",
                    "distrito" => "NIEVA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010402",
                    "fullubigeo" => "010402 EL CENEPA - CONDORCANQUI - AMAZONAS",
                    "distrito" => "EL CENEPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010403",
                    "fullubigeo" => "010403 RIO SANTIAGO - CONDORCANQUI - AMAZONAS",
                    "distrito" => "RIO SANTIAGO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010501",
                    "fullubigeo" => "010501 LAMUD - LUYA - AMAZONAS",
                    "distrito" => "LAMUD", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010502",
                    "fullubigeo" => "010502 CAMPORREDONDO - LUYA - AMAZONAS",
                    "distrito" => "CAMPORREDONDO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010503",
                    "fullubigeo" => "010503 COCABAMBA - LUYA - AMAZONAS",
                    "distrito" => "COCABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010504",
                    "fullubigeo" => "010504 COLCAMAR - LUYA - AMAZONAS",
                    "distrito" => "COLCAMAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010505",
                    "fullubigeo" => "010505 CONILA - LUYA - AMAZONAS",
                    "distrito" => "CONILA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010506",
                    "fullubigeo" => "010506 INGUILPATA - LUYA - AMAZONAS",
                    "distrito" => "INGUILPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010507",
                    "fullubigeo" => "010507 LONGUITA - LUYA - AMAZONAS",
                    "distrito" => "LONGUITA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010508",
                    "fullubigeo" => "010508 LONYA CHICO - LUYA - AMAZONAS",
                    "distrito" => "LONYA CHICO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010509",
                    "fullubigeo" => "010509 LUYA - LUYA - AMAZONAS",
                    "distrito" => "LUYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010510",
                    "fullubigeo" => "010510 LUYA VIEJO - LUYA - AMAZONAS",
                    "distrito" => "LUYA VIEJO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010511",
                    "fullubigeo" => "010511 MARIA - LUYA - AMAZONAS",
                    "distrito" => "MARIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010512",
                    "fullubigeo" => "010512 OCALLI - LUYA - AMAZONAS",
                    "distrito" => "OCALLI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010513",
                    "fullubigeo" => "010513 OCUMAL - LUYA - AMAZONAS",
                    "distrito" => "OCUMAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010514",
                    "fullubigeo" => "010514 PISUQUIA - LUYA - AMAZONAS",
                    "distrito" => "PISUQUIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010515",
                    "fullubigeo" => "010515 PROVIDENCIA - LUYA - AMAZONAS",
                    "distrito" => "PROVIDENCIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010516",
                    "fullubigeo" => "010516 SAN CRISTOBAL - LUYA - AMAZONAS",
                    "distrito" => "SAN CRISTOBAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010517",
                    "fullubigeo" => "010517 SAN FRANCISCO DEL YESO - LUYA - AMAZONAS",
                    "distrito" => "SAN FRANCISCO DEL YESO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010518",
                    "fullubigeo" => "010518 SAN JERONIMO - LUYA - AMAZONAS",
                    "distrito" => "SAN JERONIMO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010519",
                    "fullubigeo" => "010519 SAN JUAN DE LOPECANCHA - LUYA - AMAZONAS",
                    "distrito" => "SAN JUAN DE LOPECANCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010520",
                    "fullubigeo" => "010520 SANTA CATALINA - LUYA - AMAZONAS",
                    "distrito" => "SANTA CATALINA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010521",
                    "fullubigeo" => "010521 SANTO TOMAS - LUYA - AMAZONAS",
                    "distrito" => "SANTO TOMAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010522",
                    "fullubigeo" => "010522 TINGO - LUYA - AMAZONAS",
                    "distrito" => "TINGO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010523",
                    "fullubigeo" => "010523 TRITA - LUYA - AMAZONAS",
                    "distrito" => "TRITA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010601",
                    "fullubigeo" => "010601 SAN NICOLAS - RODRIGUEZ DE MENDOZA - AMAZONAS",
                    "distrito" => "SAN NICOLAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010602",
                    "fullubigeo" => "010602 CHIRIMOTO - RODRIGUEZ DE MENDOZA - AMAZONAS",
                    "distrito" => "CHIRIMOTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010603",
                    "fullubigeo" => "010603 COCHAMAL - RODRIGUEZ DE MENDOZA - AMAZONAS",
                    "distrito" => "COCHAMAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010604",
                    "fullubigeo" => "010604 HUAMBO - RODRIGUEZ DE MENDOZA - AMAZONAS",
                    "distrito" => "HUAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010605",
                    "fullubigeo" => "010605 LIMABAMBA - RODRIGUEZ DE MENDOZA - AMAZONAS",
                    "distrito" => "LIMABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010606",
                    "fullubigeo" => "010606 LONGAR - RODRIGUEZ DE MENDOZA - AMAZONAS",
                    "distrito" => "LONGAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010607",
                    "fullubigeo" => "010607 MARISCAL BENAVIDES - RODRIGUEZ DE MENDOZA - AMAZONAS",
                    "distrito" => "MARISCAL BENAVIDES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010608",
                    "fullubigeo" => "010608 MILPUC - RODRIGUEZ DE MENDOZA - AMAZONAS",
                    "distrito" => "MILPUC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010609",
                    "fullubigeo" => "010609 OMIA - RODRIGUEZ DE MENDOZA - AMAZONAS",
                    "distrito" => "OMIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010610",
                    "fullubigeo" => "010610 SANTA ROSA - RODRIGUEZ DE MENDOZA - AMAZONAS",
                    "distrito" => "SANTA ROSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010611",
                    "fullubigeo" => "010611 TOTORA - RODRIGUEZ DE MENDOZA - AMAZONAS",
                    "distrito" => "TOTORA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010612",
                    "fullubigeo" => "010612 VISTA ALEGRE - RODRIGUEZ DE MENDOZA - AMAZONAS",
                    "distrito" => "VISTA ALEGRE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010701",
                    "fullubigeo" => "010701 BAGUA GRANDE - UTCUBAMBA - AMAZONAS",
                    "distrito" => "BAGUA GRANDE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010702",
                    "fullubigeo" => "010702 CAJARURO - UTCUBAMBA - AMAZONAS",
                    "distrito" => "CAJARURO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010703",
                    "fullubigeo" => "010703 CUMBA - UTCUBAMBA - AMAZONAS",
                    "distrito" => "CUMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010704",
                    "fullubigeo" => "010704 EL MILAGRO - UTCUBAMBA - AMAZONAS",
                    "distrito" => "EL MILAGRO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010705",
                    "fullubigeo" => "010705 JAMALCA - UTCUBAMBA - AMAZONAS",
                    "distrito" => "JAMALCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010706",
                    "fullubigeo" => "010706 LONYA GRANDE - UTCUBAMBA - AMAZONAS",
                    "distrito" => "LONYA GRANDE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "010707",
                    "fullubigeo" => "010707 YAMON - UTCUBAMBA - AMAZONAS",
                    "distrito" => "YAMON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020101",
                    "fullubigeo" => "020101 HUARAZ - HUARAZ - ANCASH",
                    "distrito" => "HUARAZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020102",
                    "fullubigeo" => "020102 COCHABAMBA - HUARAZ - ANCASH",
                    "distrito" => "COCHABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020103",
                    "fullubigeo" => "020103 COLCABAMBA - HUARAZ - ANCASH",
                    "distrito" => "COLCABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020104",
                    "fullubigeo" => "020104 HUANCHAY - HUARAZ - ANCASH",
                    "distrito" => "HUANCHAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020105",
                    "fullubigeo" => "020105 INDEPENDENCIA - HUARAZ - ANCASH",
                    "distrito" => "INDEPENDENCIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020106",
                    "fullubigeo" => "020106 JANGAS - HUARAZ - ANCASH",
                    "distrito" => "JANGAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020107",
                    "fullubigeo" => "020107 LA LIBERTAD - HUARAZ - ANCASH",
                    "distrito" => "LA LIBERTAD", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020108",
                    "fullubigeo" => "020108 OLLEROS - HUARAZ - ANCASH",
                    "distrito" => "OLLEROS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020109",
                    "fullubigeo" => "020109 PAMPAS - HUARAZ - ANCASH",
                    "distrito" => "PAMPAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020110",
                    "fullubigeo" => "020110 PARIACOTO - HUARAZ - ANCASH",
                    "distrito" => "PARIACOTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020111",
                    "fullubigeo" => "020111 PIRA - HUARAZ - ANCASH",
                    "distrito" => "PIRA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020112",
                    "fullubigeo" => "020112 TARICA - HUARAZ - ANCASH",
                    "distrito" => "TARICA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020201",
                    "fullubigeo" => "020201 AIJA - AIJA - ANCASH",
                    "distrito" => "AIJA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020202",
                    "fullubigeo" => "020202 CORIS - AIJA - ANCASH",
                    "distrito" => "CORIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020203",
                    "fullubigeo" => "020203 HUACLLAN - AIJA - ANCASH",
                    "distrito" => "HUACLLAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020204",
                    "fullubigeo" => "020204 LA MERCED - AIJA - ANCASH",
                    "distrito" => "LA MERCED", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020205",
                    "fullubigeo" => "020205 SUCCHA - AIJA - ANCASH",
                    "distrito" => "SUCCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020301",
                    "fullubigeo" => "020301 LLAMELLIN - ANTONIO RAYMONDI - ANCASH",
                    "distrito" => "LLAMELLIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020302",
                    "fullubigeo" => "020302 ACZO - ANTONIO RAYMONDI - ANCASH",
                    "distrito" => "ACZO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020303",
                    "fullubigeo" => "020303 CHACCHO - ANTONIO RAYMONDI - ANCASH",
                    "distrito" => "CHACCHO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020304",
                    "fullubigeo" => "020304 CHINGAS - ANTONIO RAYMONDI - ANCASH",
                    "distrito" => "CHINGAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020305",
                    "fullubigeo" => "020305 MIRGAS - ANTONIO RAYMONDI - ANCASH",
                    "distrito" => "MIRGAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020306",
                    "fullubigeo" => "020306 SAN JUAN DE RONTOY - ANTONIO RAYMONDI - ANCASH",
                    "distrito" => "SAN JUAN DE RONTOY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020401",
                    "fullubigeo" => "020401 CHACAS - ASUNCION - ANCASH",
                    "distrito" => "CHACAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020402",
                    "fullubigeo" => "020402 ACOCHACA - ASUNCION - ANCASH",
                    "distrito" => "ACOCHACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020501",
                    "fullubigeo" => "020501 CHIQUIAN - BOLOGNESI - ANCASH",
                    "distrito" => "CHIQUIAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020502",
                    "fullubigeo" => "020502 ABELARDO PARDO LEZAMETA - BOLOGNESI - ANCASH",
                    "distrito" => "ABELARDO PARDO LEZAMETA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020503",
                    "fullubigeo" => "020503 ANTONIO RAYMONDI - BOLOGNESI - ANCASH",
                    "distrito" => "ANTONIO RAYMONDI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020504",
                    "fullubigeo" => "020504 AQUIA - BOLOGNESI - ANCASH",
                    "distrito" => "AQUIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020505",
                    "fullubigeo" => "020505 CAJACAY - BOLOGNESI - ANCASH",
                    "distrito" => "CAJACAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020506",
                    "fullubigeo" => "020506 CANIS - BOLOGNESI - ANCASH",
                    "distrito" => "CANIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020507",
                    "fullubigeo" => "020507 COLQUIOC - BOLOGNESI - ANCASH",
                    "distrito" => "COLQUIOC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020508",
                    "fullubigeo" => "020508 HUALLANCA - BOLOGNESI - ANCASH",
                    "distrito" => "HUALLANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020509",
                    "fullubigeo" => "020509 HUASTA - BOLOGNESI - ANCASH",
                    "distrito" => "HUASTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020510",
                    "fullubigeo" => "020510 HUAYLLACAYAN - BOLOGNESI - ANCASH",
                    "distrito" => "HUAYLLACAYAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020511",
                    "fullubigeo" => "020511 LA PRIMAVERA - BOLOGNESI - ANCASH",
                    "distrito" => "LA PRIMAVERA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020512",
                    "fullubigeo" => "020512 MANGAS - BOLOGNESI - ANCASH",
                    "distrito" => "MANGAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020513",
                    "fullubigeo" => "020513 PACLLON - BOLOGNESI - ANCASH",
                    "distrito" => "PACLLON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020514",
                    "fullubigeo" => "020514 SAN MIGUEL DE CORPANQUI - BOLOGNESI - ANCASH",
                    "distrito" => "SAN MIGUEL DE CORPANQUI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020515",
                    "fullubigeo" => "020515 TICLLOS - BOLOGNESI - ANCASH",
                    "distrito" => "TICLLOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020601",
                    "fullubigeo" => "020601 CARHUAZ - CARHUAZ - ANCASH",
                    "distrito" => "CARHUAZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020602",
                    "fullubigeo" => "020602 ACOPAMPA - CARHUAZ - ANCASH",
                    "distrito" => "ACOPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020603",
                    "fullubigeo" => "020603 AMASHCA - CARHUAZ - ANCASH",
                    "distrito" => "AMASHCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020604",
                    "fullubigeo" => "020604 ANTA - CARHUAZ - ANCASH",
                    "distrito" => "ANTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020605",
                    "fullubigeo" => "020605 ATAQUERO - CARHUAZ - ANCASH",
                    "distrito" => "ATAQUERO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020606",
                    "fullubigeo" => "020606 MARCARA - CARHUAZ - ANCASH",
                    "distrito" => "MARCARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020607",
                    "fullubigeo" => "020607 PARIAHUANCA - CARHUAZ - ANCASH",
                    "distrito" => "PARIAHUANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020608",
                    "fullubigeo" => "020608 SAN MIGUEL DE ACO - CARHUAZ - ANCASH",
                    "distrito" => "SAN MIGUEL DE ACO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020609",
                    "fullubigeo" => "020609 SHILLA - CARHUAZ - ANCASH",
                    "distrito" => "SHILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020610",
                    "fullubigeo" => "020610 TINCO - CARHUAZ - ANCASH",
                    "distrito" => "TINCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020611",
                    "fullubigeo" => "020611 YUNGAR - CARHUAZ - ANCASH",
                    "distrito" => "YUNGAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020701",
                    "fullubigeo" => "020701 SAN LUIS - CARLOS FERMIN FITZCARRALD - ANCASH",
                    "distrito" => "SAN LUIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020702",
                    "fullubigeo" => "020702 SAN NICOLAS - CARLOS FERMIN FITZCARRALD - ANCASH",
                    "distrito" => "SAN NICOLAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020703",
                    "fullubigeo" => "020703 YAUYA - CARLOS FERMIN FITZCARRALD - ANCASH",
                    "distrito" => "YAUYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020801",
                    "fullubigeo" => "020801 CASMA - CASMA - ANCASH",
                    "distrito" => "CASMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020802",
                    "fullubigeo" => "020802 BUENA VISTA ALTA - CASMA - ANCASH",
                    "distrito" => "BUENA VISTA ALTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020803",
                    "fullubigeo" => "020803 COMANDANTE NOEL - CASMA - ANCASH",
                    "distrito" => "COMANDANTE NOEL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020804",
                    "fullubigeo" => "020804 YAUTAN - CASMA - ANCASH",
                    "distrito" => "YAUTAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020901",
                    "fullubigeo" => "020901 CORONGO - CORONGO - ANCASH",
                    "distrito" => "CORONGO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020902",
                    "fullubigeo" => "020902 ACO - CORONGO - ANCASH",
                    "distrito" => "ACO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020903",
                    "fullubigeo" => "020903 BAMBAS - CORONGO - ANCASH",
                    "distrito" => "BAMBAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020904",
                    "fullubigeo" => "020904 CUSCA - CORONGO - ANCASH",
                    "distrito" => "CUSCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020905",
                    "fullubigeo" => "020905 LA PAMPA - CORONGO - ANCASH",
                    "distrito" => "LA PAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020906",
                    "fullubigeo" => "020906 YANAC - CORONGO - ANCASH",
                    "distrito" => "YANAC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "020907",
                    "fullubigeo" => "020907 YUPAN - CORONGO - ANCASH",
                    "distrito" => "YUPAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021001",
                    "fullubigeo" => "021001 HUARI - HUARI - ANCASH",
                    "distrito" => "HUARI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021002",
                    "fullubigeo" => "021002 ANRA - HUARI - ANCASH",
                    "distrito" => "ANRA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021003",
                    "fullubigeo" => "021003 CAJAY - HUARI - ANCASH",
                    "distrito" => "CAJAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021004",
                    "fullubigeo" => "021004 CHAVIN DE HUANTAR - HUARI - ANCASH",
                    "distrito" => "CHAVIN DE HUANTAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021005",
                    "fullubigeo" => "021005 HUACACHI - HUARI - ANCASH",
                    "distrito" => "HUACACHI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021006",
                    "fullubigeo" => "021006 HUACCHIS - HUARI - ANCASH",
                    "distrito" => "HUACCHIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021007",
                    "fullubigeo" => "021007 HUACHIS - HUARI - ANCASH",
                    "distrito" => "HUACHIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021008",
                    "fullubigeo" => "021008 HUANTAR - HUARI - ANCASH",
                    "distrito" => "HUANTAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021009",
                    "fullubigeo" => "021009 MASIN - HUARI - ANCASH",
                    "distrito" => "MASIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021010",
                    "fullubigeo" => "021010 PAUCAS - HUARI - ANCASH",
                    "distrito" => "PAUCAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021011",
                    "fullubigeo" => "021011 PONTO - HUARI - ANCASH",
                    "distrito" => "PONTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021012",
                    "fullubigeo" => "021012 RAHUAPAMPA - HUARI - ANCASH",
                    "distrito" => "RAHUAPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021013",
                    "fullubigeo" => "021013 RAPAYAN - HUARI - ANCASH",
                    "distrito" => "RAPAYAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021014",
                    "fullubigeo" => "021014 SAN MARCOS - HUARI - ANCASH",
                    "distrito" => "SAN MARCOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021015",
                    "fullubigeo" => "021015 SAN PEDRO DE CHANA - HUARI - ANCASH",
                    "distrito" => "SAN PEDRO DE CHANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021016",
                    "fullubigeo" => "021016 UCO - HUARI - ANCASH",
                    "distrito" => "UCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021101",
                    "fullubigeo" => "021101 HUARMEY - HUARMEY - ANCASH",
                    "distrito" => "HUARMEY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021102",
                    "fullubigeo" => "021102 COCHAPETI - HUARMEY - ANCASH",
                    "distrito" => "COCHAPETI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021103",
                    "fullubigeo" => "021103 CULEBRAS - HUARMEY - ANCASH",
                    "distrito" => "CULEBRAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021104",
                    "fullubigeo" => "021104 HUAYAN - HUARMEY - ANCASH",
                    "distrito" => "HUAYAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021105",
                    "fullubigeo" => "021105 MALVAS - HUARMEY - ANCASH",
                    "distrito" => "MALVAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021201",
                    "fullubigeo" => "021201 CARAZ - HUAYLAS - ANCASH",
                    "distrito" => "CARAZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021202",
                    "fullubigeo" => "021202 HUALLANCA - HUAYLAS - ANCASH",
                    "distrito" => "HUALLANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021203",
                    "fullubigeo" => "021203 HUATA - HUAYLAS - ANCASH",
                    "distrito" => "HUATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021204",
                    "fullubigeo" => "021204 HUAYLAS - HUAYLAS - ANCASH",
                    "distrito" => "HUAYLAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021205",
                    "fullubigeo" => "021205 MATO - HUAYLAS - ANCASH",
                    "distrito" => "MATO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021206",
                    "fullubigeo" => "021206 PAMPAROMAS - HUAYLAS - ANCASH",
                    "distrito" => "PAMPAROMAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021207",
                    "fullubigeo" => "021207 PUEBLO LIBRE - HUAYLAS - ANCASH",
                    "distrito" => "PUEBLO LIBRE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021208",
                    "fullubigeo" => "021208 SANTA CRUZ - HUAYLAS - ANCASH",
                    "distrito" => "SANTA CRUZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021209",
                    "fullubigeo" => "021209 SANTO TORIBIO - HUAYLAS - ANCASH",
                    "distrito" => "SANTO TORIBIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021210",
                    "fullubigeo" => "021210 YURACMARCA - HUAYLAS - ANCASH",
                    "distrito" => "YURACMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021301",
                    "fullubigeo" => "021301 PISCOBAMBA - MARISCAL LUZURIAGA - ANCASH",
                    "distrito" => "PISCOBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021302",
                    "fullubigeo" => "021302 CASCA - MARISCAL LUZURIAGA - ANCASH",
                    "distrito" => "CASCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021303",
                    "fullubigeo" => "021303 ELEAZAR GUZMAN BARRON - MARISCAL LUZURIAGA - ANCASH",
                    "distrito" => "ELEAZAR GUZMAN BARRON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021304",
                    "fullubigeo" => "021304 FIDEL OLIVAS ESCUDERO - MARISCAL LUZURIAGA - ANCASH",
                    "distrito" => "FIDEL OLIVAS ESCUDERO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021305",
                    "fullubigeo" => "021305 LLAMA - MARISCAL LUZURIAGA - ANCASH",
                    "distrito" => "LLAMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021306",
                    "fullubigeo" => "021306 LLUMPA - MARISCAL LUZURIAGA - ANCASH",
                    "distrito" => "LLUMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021307",
                    "fullubigeo" => "021307 LUCMA - MARISCAL LUZURIAGA - ANCASH",
                    "distrito" => "LUCMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021308",
                    "fullubigeo" => "021308 MUSGA - MARISCAL LUZURIAGA - ANCASH",
                    "distrito" => "MUSGA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021401",
                    "fullubigeo" => "021401 OCROS - OCROS - ANCASH",
                    "distrito" => "OCROS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021402",
                    "fullubigeo" => "021402 ACAS - OCROS - ANCASH",
                    "distrito" => "ACAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021403",
                    "fullubigeo" => "021403 CAJAMARQUILLA - OCROS - ANCASH",
                    "distrito" => "CAJAMARQUILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021404",
                    "fullubigeo" => "021404 CARHUAPAMPA - OCROS - ANCASH",
                    "distrito" => "CARHUAPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021405",
                    "fullubigeo" => "021405 COCHAS - OCROS - ANCASH",
                    "distrito" => "COCHAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021406",
                    "fullubigeo" => "021406 CONGAS - OCROS - ANCASH",
                    "distrito" => "CONGAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021407",
                    "fullubigeo" => "021407 LLIPA - OCROS - ANCASH",
                    "distrito" => "LLIPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021408",
                    "fullubigeo" => "021408 SAN CRISTOBAL DE RAJAN - OCROS - ANCASH",
                    "distrito" => "SAN CRISTOBAL DE RAJAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021409",
                    "fullubigeo" => "021409 SAN PEDRO - OCROS - ANCASH",
                    "distrito" => "SAN PEDRO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021410",
                    "fullubigeo" => "021410 SANTIAGO DE CHILCAS - OCROS - ANCASH",
                    "distrito" => "SANTIAGO DE CHILCAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021501",
                    "fullubigeo" => "021501 CABANA - PALLASCA - ANCASH",
                    "distrito" => "CABANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021502",
                    "fullubigeo" => "021502 BOLOGNESI - PALLASCA - ANCASH",
                    "distrito" => "BOLOGNESI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021503",
                    "fullubigeo" => "021503 CONCHUCOS - PALLASCA - ANCASH",
                    "distrito" => "CONCHUCOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021504",
                    "fullubigeo" => "021504 HUACASCHUQUE - PALLASCA - ANCASH",
                    "distrito" => "HUACASCHUQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021505",
                    "fullubigeo" => "021505 HUANDOVAL - PALLASCA - ANCASH",
                    "distrito" => "HUANDOVAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021506",
                    "fullubigeo" => "021506 LACABAMBA - PALLASCA - ANCASH",
                    "distrito" => "LACABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021507",
                    "fullubigeo" => "021507 LLAPO - PALLASCA - ANCASH",
                    "distrito" => "LLAPO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021508",
                    "fullubigeo" => "021508 PALLASCA - PALLASCA - ANCASH",
                    "distrito" => "PALLASCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021509",
                    "fullubigeo" => "021509 PAMPAS - PALLASCA - ANCASH",
                    "distrito" => "PAMPAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021510",
                    "fullubigeo" => "021510 SANTA ROSA - PALLASCA - ANCASH",
                    "distrito" => "SANTA ROSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021511",
                    "fullubigeo" => "021511 TAUCA - PALLASCA - ANCASH",
                    "distrito" => "TAUCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021601",
                    "fullubigeo" => "021601 POMABAMBA - POMABAMBA - ANCASH",
                    "distrito" => "POMABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021602",
                    "fullubigeo" => "021602 HUAYLLAN - POMABAMBA - ANCASH",
                    "distrito" => "HUAYLLAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021603",
                    "fullubigeo" => "021603 PAROBAMBA - POMABAMBA - ANCASH",
                    "distrito" => "PAROBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021604",
                    "fullubigeo" => "021604 QUINUABAMBA - POMABAMBA - ANCASH",
                    "distrito" => "QUINUABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021701",
                    "fullubigeo" => "021701 RECUAY - RECUAY - ANCASH",
                    "distrito" => "RECUAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021702",
                    "fullubigeo" => "021702 CATAC - RECUAY - ANCASH",
                    "distrito" => "CATAC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021703",
                    "fullubigeo" => "021703 COTAPARACO - RECUAY - ANCASH",
                    "distrito" => "COTAPARACO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021704",
                    "fullubigeo" => "021704 HUAYLLAPAMPA - RECUAY - ANCASH",
                    "distrito" => "HUAYLLAPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021705",
                    "fullubigeo" => "021705 LLACLLIN - RECUAY - ANCASH",
                    "distrito" => "LLACLLIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021706",
                    "fullubigeo" => "021706 MARCA - RECUAY - ANCASH",
                    "distrito" => "MARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021707",
                    "fullubigeo" => "021707 PAMPAS CHICO - RECUAY - ANCASH",
                    "distrito" => "PAMPAS CHICO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021708",
                    "fullubigeo" => "021708 PARARIN - RECUAY - ANCASH",
                    "distrito" => "PARARIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021709",
                    "fullubigeo" => "021709 TAPACOCHA - RECUAY - ANCASH",
                    "distrito" => "TAPACOCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021710",
                    "fullubigeo" => "021710 TICAPAMPA - RECUAY - ANCASH",
                    "distrito" => "TICAPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021801",
                    "fullubigeo" => "021801 CHIMBOTE - SANTA - ANCASH",
                    "distrito" => "CHIMBOTE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021802",
                    "fullubigeo" => "021802 CACERES DEL PERU - SANTA - ANCASH",
                    "distrito" => "CACERES DEL PERU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021803",
                    "fullubigeo" => "021803 COISHCO - SANTA - ANCASH",
                    "distrito" => "COISHCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021804",
                    "fullubigeo" => "021804 MACATE - SANTA - ANCASH",
                    "distrito" => "MACATE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021805",
                    "fullubigeo" => "021805 MORO - SANTA - ANCASH",
                    "distrito" => "MORO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021806",
                    "fullubigeo" => "021806 NEPEÑA - SANTA - ANCASH",
                    "distrito" => "NEPEÑA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021807",
                    "fullubigeo" => "021807 SAMANCO - SANTA - ANCASH",
                    "distrito" => "SAMANCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021808",
                    "fullubigeo" => "021808 SANTA - SANTA - ANCASH",
                    "distrito" => "SANTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021809",
                    "fullubigeo" => "021809 NUEVO CHIMBOTE - SANTA - ANCASH",
                    "distrito" => "NUEVO CHIMBOTE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021901",
                    "fullubigeo" => "021901 SIHUAS - SIHUAS - ANCASH",
                    "distrito" => "SIHUAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021902",
                    "fullubigeo" => "021902 ACOBAMBA - SIHUAS - ANCASH",
                    "distrito" => "ACOBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021903",
                    "fullubigeo" => "021903 ALFONSO UGARTE - SIHUAS - ANCASH",
                    "distrito" => "ALFONSO UGARTE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021904",
                    "fullubigeo" => "021904 CASHAPAMPA - SIHUAS - ANCASH",
                    "distrito" => "CASHAPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021905",
                    "fullubigeo" => "021905 CHINGALPO - SIHUAS - ANCASH",
                    "distrito" => "CHINGALPO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021906",
                    "fullubigeo" => "021906 HUAYLLABAMBA - SIHUAS - ANCASH",
                    "distrito" => "HUAYLLABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021907",
                    "fullubigeo" => "021907 QUICHES - SIHUAS - ANCASH",
                    "distrito" => "QUICHES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021908",
                    "fullubigeo" => "021908 RAGASH - SIHUAS - ANCASH",
                    "distrito" => "RAGASH", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021909",
                    "fullubigeo" => "021909 SAN JUAN - SIHUAS - ANCASH",
                    "distrito" => "SAN JUAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "021910",
                    "fullubigeo" => "021910 SICSIBAMBA - SIHUAS - ANCASH",
                    "distrito" => "SICSIBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "022001",
                    "fullubigeo" => "022001 YUNGAY - YUNGAY - ANCASH",
                    "distrito" => "YUNGAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "022002",
                    "fullubigeo" => "022002 CASCAPARA - YUNGAY - ANCASH",
                    "distrito" => "CASCAPARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "022003",
                    "fullubigeo" => "022003 MANCOS - YUNGAY - ANCASH",
                    "distrito" => "MANCOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "022004",
                    "fullubigeo" => "022004 MATACOTO - YUNGAY - ANCASH",
                    "distrito" => "MATACOTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "022005",
                    "fullubigeo" => "022005 QUILLO - YUNGAY - ANCASH",
                    "distrito" => "QUILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "022006",
                    "fullubigeo" => "022006 RANRAHIRCA - YUNGAY - ANCASH",
                    "distrito" => "RANRAHIRCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "022007",
                    "fullubigeo" => "022007 SHUPLUY - YUNGAY - ANCASH",
                    "distrito" => "SHUPLUY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "022008",
                    "fullubigeo" => "022008 YANAMA - YUNGAY - ANCASH",
                    "distrito" => "YANAMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030101",
                    "fullubigeo" => "030101 ABANCAY - ABANCAY - APURÍMAC",
                    "distrito" => "ABANCAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030102",
                    "fullubigeo" => "030102 CHACOCHE - ABANCAY - APURÍMAC",
                    "distrito" => "CHACOCHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030103",
                    "fullubigeo" => "030103 CIRCA - ABANCAY - APURÍMAC",
                    "distrito" => "CIRCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030104",
                    "fullubigeo" => "030104 CURAHUASI - ABANCAY - APURÍMAC",
                    "distrito" => "CURAHUASI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030105",
                    "fullubigeo" => "030105 HUANIPACA - ABANCAY - APURÍMAC",
                    "distrito" => "HUANIPACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030106",
                    "fullubigeo" => "030106 LAMBRAMA - ABANCAY - APURÍMAC",
                    "distrito" => "LAMBRAMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030107",
                    "fullubigeo" => "030107 PICHIRHUA - ABANCAY - APURÍMAC",
                    "distrito" => "PICHIRHUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030108",
                    "fullubigeo" => "030108 SAN PEDRO DE CACHORA - ABANCAY - APURÍMAC",
                    "distrito" => "SAN PEDRO DE CACHORA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030109",
                    "fullubigeo" => "030109 TAMBURCO - ABANCAY - APURÍMAC",
                    "distrito" => "TAMBURCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030201",
                    "fullubigeo" => "030201 ANDAHUAYLAS - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "ANDAHUAYLAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030202",
                    "fullubigeo" => "030202 ANDARAPA - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "ANDARAPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030203",
                    "fullubigeo" => "030203 CHIARA - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "CHIARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030204",
                    "fullubigeo" => "030204 HUANCARAMA - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "HUANCARAMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030205",
                    "fullubigeo" => "030205 HUANCARAY - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "HUANCARAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030206",
                    "fullubigeo" => "030206 HUAYANA - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "HUAYANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030207",
                    "fullubigeo" => "030207 KISHUARA - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "KISHUARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030208",
                    "fullubigeo" => "030208 PACOBAMBA - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "PACOBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030209",
                    "fullubigeo" => "030209 PACUCHA - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "PACUCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030210",
                    "fullubigeo" => "030210 PAMPACHIRI - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "PAMPACHIRI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030211",
                    "fullubigeo" => "030211 POMACOCHA - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "POMACOCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030212",
                    "fullubigeo" => "030212 SAN ANTONIO DE CACHI - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "SAN ANTONIO DE CACHI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030213",
                    "fullubigeo" => "030213 SAN JERONIMO - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "SAN JERONIMO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030214",
                    "fullubigeo" => "030214 SAN MIGUEL DE CHACCRAMPA - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "SAN MIGUEL DE CHACCRAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030215",
                    "fullubigeo" => "030215 SANTA MARIA DE CHICMO - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "SANTA MARIA DE CHICMO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030216",
                    "fullubigeo" => "030216 TALAVERA - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "TALAVERA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030217",
                    "fullubigeo" => "030217 TUMAY HUARACA - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "TUMAY HUARACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030218",
                    "fullubigeo" => "030218 TURPO - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "TURPO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030219",
                    "fullubigeo" => "030219 KAQUIABAMBA - ANDAHUAYLAS - APURÍMAC",
                    "distrito" => "KAQUIABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030301",
                    "fullubigeo" => "030301 ANTABAMBA - ANTABAMBA - APURÍMAC",
                    "distrito" => "ANTABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030302",
                    "fullubigeo" => "030302 EL ORO - ANTABAMBA - APURÍMAC",
                    "distrito" => "EL ORO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030303",
                    "fullubigeo" => "030303 HUAQUIRCA - ANTABAMBA - APURÍMAC",
                    "distrito" => "HUAQUIRCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030304",
                    "fullubigeo" => "030304 JUAN ESPINOZA MEDRANO - ANTABAMBA - APURÍMAC",
                    "distrito" => "JUAN ESPINOZA MEDRANO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030305",
                    "fullubigeo" => "030305 OROPESA - ANTABAMBA - APURÍMAC",
                    "distrito" => "OROPESA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030306",
                    "fullubigeo" => "030306 PACHACONAS - ANTABAMBA - APURÍMAC",
                    "distrito" => "PACHACONAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030307",
                    "fullubigeo" => "030307 SABAINO - ANTABAMBA - APURÍMAC",
                    "distrito" => "SABAINO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030401",
                    "fullubigeo" => "030401 CHALHUANCA - AYMARAES - APURÍMAC",
                    "distrito" => "CHALHUANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030402",
                    "fullubigeo" => "030402 CAPAYA - AYMARAES - APURÍMAC",
                    "distrito" => "CAPAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030403",
                    "fullubigeo" => "030403 CARAYBAMBA - AYMARAES - APURÍMAC",
                    "distrito" => "CARAYBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030404",
                    "fullubigeo" => "030404 CHAPIMARCA - AYMARAES - APURÍMAC",
                    "distrito" => "CHAPIMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030405",
                    "fullubigeo" => "030405 COLCABAMBA - AYMARAES - APURÍMAC",
                    "distrito" => "COLCABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030406",
                    "fullubigeo" => "030406 COTARUSE - AYMARAES - APURÍMAC",
                    "distrito" => "COTARUSE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030407",
                    "fullubigeo" => "030407 HUAYLLO - AYMARAES - APURÍMAC",
                    "distrito" => "HUAYLLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030408",
                    "fullubigeo" => "030408 JUSTO APU SAHUARAURA - AYMARAES - APURÍMAC",
                    "distrito" => "JUSTO APU SAHUARAURA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030409",
                    "fullubigeo" => "030409 LUCRE - AYMARAES - APURÍMAC",
                    "distrito" => "LUCRE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030410",
                    "fullubigeo" => "030410 POCOHUANCA - AYMARAES - APURÍMAC",
                    "distrito" => "POCOHUANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030411",
                    "fullubigeo" => "030411 SAN JUAN DE CHACÑA - AYMARAES - APURÍMAC",
                    "distrito" => "SAN JUAN DE CHACÑA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030412",
                    "fullubigeo" => "030412 SAÑAYCA - AYMARAES - APURÍMAC",
                    "distrito" => "SAÑAYCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030413",
                    "fullubigeo" => "030413 SORAYA - AYMARAES - APURÍMAC",
                    "distrito" => "SORAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030414",
                    "fullubigeo" => "030414 TAPAIRIHUA - AYMARAES - APURÍMAC",
                    "distrito" => "TAPAIRIHUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030415",
                    "fullubigeo" => "030415 TINTAY - AYMARAES - APURÍMAC",
                    "distrito" => "TINTAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030416",
                    "fullubigeo" => "030416 TORAYA - AYMARAES - APURÍMAC",
                    "distrito" => "TORAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030417",
                    "fullubigeo" => "030417 YANACA - AYMARAES - APURÍMAC",
                    "distrito" => "YANACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030501",
                    "fullubigeo" => "030501 TAMBOBAMBA - COTABAMBAS - APURÍMAC",
                    "distrito" => "TAMBOBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030502",
                    "fullubigeo" => "030502 COTABAMBAS - COTABAMBAS - APURÍMAC",
                    "distrito" => "COTABAMBAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030503",
                    "fullubigeo" => "030503 COYLLURQUI - COTABAMBAS - APURÍMAC",
                    "distrito" => "COYLLURQUI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030504",
                    "fullubigeo" => "030504 HAQUIRA - COTABAMBAS - APURÍMAC",
                    "distrito" => "HAQUIRA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030505",
                    "fullubigeo" => "030505 MARA - COTABAMBAS - APURÍMAC",
                    "distrito" => "MARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030506",
                    "fullubigeo" => "030506 CHALLHUAHUACHO - COTABAMBAS - APURÍMAC",
                    "distrito" => "CHALLHUAHUACHO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030601",
                    "fullubigeo" => "030601 CHINCHEROS - CHINCHEROS - APURÍMAC",
                    "distrito" => "CHINCHEROS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030602",
                    "fullubigeo" => "030602 ANCO-HUALLO - CHINCHEROS - APURÍMAC",
                    "distrito" => "ANCO-HUALLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030603",
                    "fullubigeo" => "030603 COCHARCAS - CHINCHEROS - APURÍMAC",
                    "distrito" => "COCHARCAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030604",
                    "fullubigeo" => "030604 HUACCANA - CHINCHEROS - APURÍMAC",
                    "distrito" => "HUACCANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030605",
                    "fullubigeo" => "030605 OCOBAMBA - CHINCHEROS - APURÍMAC",
                    "distrito" => "OCOBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030606",
                    "fullubigeo" => "030606 ONGOY - CHINCHEROS - APURÍMAC",
                    "distrito" => "ONGOY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030607",
                    "fullubigeo" => "030607 URANMARCA - CHINCHEROS - APURÍMAC",
                    "distrito" => "URANMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030608",
                    "fullubigeo" => "030608 RANRACANCHA - CHINCHEROS - APURÍMAC",
                    "distrito" => "RANRACANCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030701",
                    "fullubigeo" => "030701 CHUQUIBAMBILLA - GRAU - APURÍMAC",
                    "distrito" => "CHUQUIBAMBILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030702",
                    "fullubigeo" => "030702 CURPAHUASI - GRAU - APURÍMAC",
                    "distrito" => "CURPAHUASI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030703",
                    "fullubigeo" => "030703 GAMARRA - GRAU - APURÍMAC",
                    "distrito" => "GAMARRA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030704",
                    "fullubigeo" => "030704 HUAYLLATI - GRAU - APURÍMAC",
                    "distrito" => "HUAYLLATI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030705",
                    "fullubigeo" => "030705 MAMARA - GRAU - APURÍMAC",
                    "distrito" => "MAMARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030706",
                    "fullubigeo" => "030706 MICAELA BASTIDAS - GRAU - APURÍMAC",
                    "distrito" => "MICAELA BASTIDAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030707",
                    "fullubigeo" => "030707 PATAYPAMPA - GRAU - APURÍMAC",
                    "distrito" => "PATAYPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030708",
                    "fullubigeo" => "030708 PROGRESO - GRAU - APURÍMAC",
                    "distrito" => "PROGRESO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030709",
                    "fullubigeo" => "030709 SAN ANTONIO - GRAU - APURÍMAC",
                    "distrito" => "SAN ANTONIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030710",
                    "fullubigeo" => "030710 SANTA ROSA - GRAU - APURÍMAC",
                    "distrito" => "SANTA ROSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030711",
                    "fullubigeo" => "030711 TURPAY - GRAU - APURÍMAC",
                    "distrito" => "TURPAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030712",
                    "fullubigeo" => "030712 VILCABAMBA - GRAU - APURÍMAC",
                    "distrito" => "VILCABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030713",
                    "fullubigeo" => "030713 VIRUNDO - GRAU - APURÍMAC",
                    "distrito" => "VIRUNDO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "030714",
                    "fullubigeo" => "030714 CURASCO - GRAU - APURÍMAC",
                    "distrito" => "CURASCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040101",
                    "fullubigeo" => "040101 AREQUIPA - AREQUIPA - AREQUIPA",
                    "distrito" => "AREQUIPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040102",
                    "fullubigeo" => "040102 ALTO SELVA ALEGRE - AREQUIPA - AREQUIPA",
                    "distrito" => "ALTO SELVA ALEGRE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040103",
                    "fullubigeo" => "040103 CAYMA - AREQUIPA - AREQUIPA",
                    "distrito" => "CAYMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040104",
                    "fullubigeo" => "040104 CERRO COLORADO - AREQUIPA - AREQUIPA",
                    "distrito" => "CERRO COLORADO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040105",
                    "fullubigeo" => "040105 CHARACATO - AREQUIPA - AREQUIPA",
                    "distrito" => "CHARACATO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040106",
                    "fullubigeo" => "040106 CHIGUATA - AREQUIPA - AREQUIPA",
                    "distrito" => "CHIGUATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040107",
                    "fullubigeo" => "040107 JACOBO HUNTER - AREQUIPA - AREQUIPA",
                    "distrito" => "JACOBO HUNTER", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040108",
                    "fullubigeo" => "040108 LA JOYA - AREQUIPA - AREQUIPA",
                    "distrito" => "LA JOYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040109",
                    "fullubigeo" => "040109 MARIANO MELGAR - AREQUIPA - AREQUIPA",
                    "distrito" => "MARIANO MELGAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040110",
                    "fullubigeo" => "040110 MIRAFLORES - AREQUIPA - AREQUIPA",
                    "distrito" => "MIRAFLORES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040111",
                    "fullubigeo" => "040111 MOLLEBAYA - AREQUIPA - AREQUIPA",
                    "distrito" => "MOLLEBAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040112",
                    "fullubigeo" => "040112 PAUCARPATA - AREQUIPA - AREQUIPA",
                    "distrito" => "PAUCARPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040113",
                    "fullubigeo" => "040113 POCSI - AREQUIPA - AREQUIPA",
                    "distrito" => "POCSI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040114",
                    "fullubigeo" => "040114 POLOBAYA - AREQUIPA - AREQUIPA",
                    "distrito" => "POLOBAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040115",
                    "fullubigeo" => "040115 QUEQUEÑA - AREQUIPA - AREQUIPA",
                    "distrito" => "QUEQUEÑA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040116",
                    "fullubigeo" => "040116 SABANDIA - AREQUIPA - AREQUIPA",
                    "distrito" => "SABANDIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040117",
                    "fullubigeo" => "040117 SACHACA - AREQUIPA - AREQUIPA",
                    "distrito" => "SACHACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040118",
                    "fullubigeo" => "040118 SAN JUAN DE SIGUAS - AREQUIPA - AREQUIPA",
                    "distrito" => "SAN JUAN DE SIGUAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040119",
                    "fullubigeo" => "040119 SAN JUAN DE TARUCANI - AREQUIPA - AREQUIPA",
                    "distrito" => "SAN JUAN DE TARUCANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040120",
                    "fullubigeo" => "040120 SANTA ISABEL DE SIGUAS - AREQUIPA - AREQUIPA",
                    "distrito" => "SANTA ISABEL DE SIGUAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040121",
                    "fullubigeo" => "040121 SANTA RITA DE SIGUAS - AREQUIPA - AREQUIPA",
                    "distrito" => "SANTA RITA DE SIGUAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040122",
                    "fullubigeo" => "040122 SOCABAYA - AREQUIPA - AREQUIPA",
                    "distrito" => "SOCABAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040123",
                    "fullubigeo" => "040123 TIABAYA - AREQUIPA - AREQUIPA",
                    "distrito" => "TIABAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040124",
                    "fullubigeo" => "040124 UCHUMAYO - AREQUIPA - AREQUIPA",
                    "distrito" => "UCHUMAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040125",
                    "fullubigeo" => "040125 VITOR - AREQUIPA - AREQUIPA",
                    "distrito" => "VITOR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040126",
                    "fullubigeo" => "040126 YANAHUARA - AREQUIPA - AREQUIPA",
                    "distrito" => "YANAHUARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040127",
                    "fullubigeo" => "040127 YARABAMBA - AREQUIPA - AREQUIPA",
                    "distrito" => "YARABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040128",
                    "fullubigeo" => "040128 YURA - AREQUIPA - AREQUIPA",
                    "distrito" => "YURA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040129",
                    "fullubigeo" => "040129 JOSE LUIS BUSTAMANTE Y RIVERO - AREQUIPA - AREQUIPA",
                    "distrito" => "JOSE LUIS BUSTAMANTE Y RIVERO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040201",
                    "fullubigeo" => "040201 CAMANA - CAMANA - AREQUIPA",
                    "distrito" => "CAMANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040202",
                    "fullubigeo" => "040202 JOSE MARIA QUIMPER - CAMANA - AREQUIPA",
                    "distrito" => "JOSE MARIA QUIMPER", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040203",
                    "fullubigeo" => "040203 MARIANO NICOLAS VALCARCEL - CAMANA - AREQUIPA",
                    "distrito" => "MARIANO NICOLAS VALCARCEL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040204",
                    "fullubigeo" => "040204 MARISCAL CACERES - CAMANA - AREQUIPA",
                    "distrito" => "MARISCAL CACERES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040205",
                    "fullubigeo" => "040205 NICOLAS DE PIEROLA - CAMANA - AREQUIPA",
                    "distrito" => "NICOLAS DE PIEROLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040206",
                    "fullubigeo" => "040206 OCOÑA - CAMANA - AREQUIPA",
                    "distrito" => "OCOÑA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040207",
                    "fullubigeo" => "040207 QUILCA - CAMANA - AREQUIPA",
                    "distrito" => "QUILCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040208",
                    "fullubigeo" => "040208 SAMUEL PASTOR - CAMANA - AREQUIPA",
                    "distrito" => "SAMUEL PASTOR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040301",
                    "fullubigeo" => "040301 CARAVELI - CARAVELI - AREQUIPA",
                    "distrito" => "CARAVELI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040302",
                    "fullubigeo" => "040302 ACARI - CARAVELI - AREQUIPA",
                    "distrito" => "ACARI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040303",
                    "fullubigeo" => "040303 ATICO - CARAVELI - AREQUIPA",
                    "distrito" => "ATICO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040304",
                    "fullubigeo" => "040304 ATIQUIPA - CARAVELI - AREQUIPA",
                    "distrito" => "ATIQUIPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040305",
                    "fullubigeo" => "040305 BELLA UNION - CARAVELI - AREQUIPA",
                    "distrito" => "BELLA UNION", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040306",
                    "fullubigeo" => "040306 CAHUACHO - CARAVELI - AREQUIPA",
                    "distrito" => "CAHUACHO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040307",
                    "fullubigeo" => "040307 CHALA - CARAVELI - AREQUIPA",
                    "distrito" => "CHALA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040308",
                    "fullubigeo" => "040308 CHAPARRA - CARAVELI - AREQUIPA",
                    "distrito" => "CHAPARRA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040309",
                    "fullubigeo" => "040309 HUANUHUANU - CARAVELI - AREQUIPA",
                    "distrito" => "HUANUHUANU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040310",
                    "fullubigeo" => "040310 JAQUI - CARAVELI - AREQUIPA",
                    "distrito" => "JAQUI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040311",
                    "fullubigeo" => "040311 LOMAS - CARAVELI - AREQUIPA",
                    "distrito" => "LOMAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040312",
                    "fullubigeo" => "040312 QUICACHA - CARAVELI - AREQUIPA",
                    "distrito" => "QUICACHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040313",
                    "fullubigeo" => "040313 YAUCA - CARAVELI - AREQUIPA",
                    "distrito" => "YAUCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040401",
                    "fullubigeo" => "040401 APLAO - CASTILLA - AREQUIPA",
                    "distrito" => "APLAO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040402",
                    "fullubigeo" => "040402 ANDAGUA - CASTILLA - AREQUIPA",
                    "distrito" => "ANDAGUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040403",
                    "fullubigeo" => "040403 AYO - CASTILLA - AREQUIPA",
                    "distrito" => "AYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040404",
                    "fullubigeo" => "040404 CHACHAS - CASTILLA - AREQUIPA",
                    "distrito" => "CHACHAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040405",
                    "fullubigeo" => "040405 CHILCAYMARCA - CASTILLA - AREQUIPA",
                    "distrito" => "CHILCAYMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040406",
                    "fullubigeo" => "040406 CHOCO - CASTILLA - AREQUIPA",
                    "distrito" => "CHOCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040407",
                    "fullubigeo" => "040407 HUANCARQUI - CASTILLA - AREQUIPA",
                    "distrito" => "HUANCARQUI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040408",
                    "fullubigeo" => "040408 MACHAGUAY - CASTILLA - AREQUIPA",
                    "distrito" => "MACHAGUAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040409",
                    "fullubigeo" => "040409 ORCOPAMPA - CASTILLA - AREQUIPA",
                    "distrito" => "ORCOPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040410",
                    "fullubigeo" => "040410 PAMPACOLCA - CASTILLA - AREQUIPA",
                    "distrito" => "PAMPACOLCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040411",
                    "fullubigeo" => "040411 TIPAN - CASTILLA - AREQUIPA",
                    "distrito" => "TIPAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040412",
                    "fullubigeo" => "040412 UÑON - CASTILLA - AREQUIPA",
                    "distrito" => "UÑON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040413",
                    "fullubigeo" => "040413 URACA - CASTILLA - AREQUIPA",
                    "distrito" => "URACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040414",
                    "fullubigeo" => "040414 VIRACO - CASTILLA - AREQUIPA",
                    "distrito" => "VIRACO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040501",
                    "fullubigeo" => "040501 CHIVAY - CAYLLOMA - AREQUIPA",
                    "distrito" => "CHIVAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040502",
                    "fullubigeo" => "040502 ACHOMA - CAYLLOMA - AREQUIPA",
                    "distrito" => "ACHOMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040503",
                    "fullubigeo" => "040503 CABANACONDE - CAYLLOMA - AREQUIPA",
                    "distrito" => "CABANACONDE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040504",
                    "fullubigeo" => "040504 CALLALLI - CAYLLOMA - AREQUIPA",
                    "distrito" => "CALLALLI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040505",
                    "fullubigeo" => "040505 CAYLLOMA - CAYLLOMA - AREQUIPA",
                    "distrito" => "CAYLLOMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040506",
                    "fullubigeo" => "040506 COPORAQUE - CAYLLOMA - AREQUIPA",
                    "distrito" => "COPORAQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040507",
                    "fullubigeo" => "040507 HUAMBO - CAYLLOMA - AREQUIPA",
                    "distrito" => "HUAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040508",
                    "fullubigeo" => "040508 HUANCA - CAYLLOMA - AREQUIPA",
                    "distrito" => "HUANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040509",
                    "fullubigeo" => "040509 ICHUPAMPA - CAYLLOMA - AREQUIPA",
                    "distrito" => "ICHUPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040510",
                    "fullubigeo" => "040510 LARI - CAYLLOMA - AREQUIPA",
                    "distrito" => "LARI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040511",
                    "fullubigeo" => "040511 LLUTA - CAYLLOMA - AREQUIPA",
                    "distrito" => "LLUTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040512",
                    "fullubigeo" => "040512 MACA - CAYLLOMA - AREQUIPA",
                    "distrito" => "MACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040513",
                    "fullubigeo" => "040513 MADRIGAL - CAYLLOMA - AREQUIPA",
                    "distrito" => "MADRIGAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040514",
                    "fullubigeo" => "040514 SAN ANTONIO DE CHUCA - CAYLLOMA - AREQUIPA",
                    "distrito" => "SAN ANTONIO DE CHUCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040515",
                    "fullubigeo" => "040515 SIBAYO - CAYLLOMA - AREQUIPA",
                    "distrito" => "SIBAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040516",
                    "fullubigeo" => "040516 TAPAY - CAYLLOMA - AREQUIPA",
                    "distrito" => "TAPAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040517",
                    "fullubigeo" => "040517 TISCO - CAYLLOMA - AREQUIPA",
                    "distrito" => "TISCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040518",
                    "fullubigeo" => "040518 TUTI - CAYLLOMA - AREQUIPA",
                    "distrito" => "TUTI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040519",
                    "fullubigeo" => "040519 YANQUE - CAYLLOMA - AREQUIPA",
                    "distrito" => "YANQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040520",
                    "fullubigeo" => "040520 MAJES - CAYLLOMA - AREQUIPA",
                    "distrito" => "MAJES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040601",
                    "fullubigeo" => "040601 CHUQUIBAMBA - CONDESUYOS - AREQUIPA",
                    "distrito" => "CHUQUIBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040602",
                    "fullubigeo" => "040602 ANDARAY - CONDESUYOS - AREQUIPA",
                    "distrito" => "ANDARAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040603",
                    "fullubigeo" => "040603 CAYARANI - CONDESUYOS - AREQUIPA",
                    "distrito" => "CAYARANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040604",
                    "fullubigeo" => "040604 CHICHAS - CONDESUYOS - AREQUIPA",
                    "distrito" => "CHICHAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040605",
                    "fullubigeo" => "040605 IRAY - CONDESUYOS - AREQUIPA",
                    "distrito" => "IRAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040606",
                    "fullubigeo" => "040606 RIO GRANDE - CONDESUYOS - AREQUIPA",
                    "distrito" => "RIO GRANDE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040607",
                    "fullubigeo" => "040607 SALAMANCA - CONDESUYOS - AREQUIPA",
                    "distrito" => "SALAMANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040608",
                    "fullubigeo" => "040608 YANAQUIHUA - CONDESUYOS - AREQUIPA",
                    "distrito" => "YANAQUIHUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040701",
                    "fullubigeo" => "040701 MOLLENDO - ISLAY - AREQUIPA",
                    "distrito" => "MOLLENDO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040702",
                    "fullubigeo" => "040702 COCACHACRA - ISLAY - AREQUIPA",
                    "distrito" => "COCACHACRA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040703",
                    "fullubigeo" => "040703 DEAN VALDIVIA - ISLAY - AREQUIPA",
                    "distrito" => "DEAN VALDIVIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040704",
                    "fullubigeo" => "040704 ISLAY - ISLAY - AREQUIPA",
                    "distrito" => "ISLAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040705",
                    "fullubigeo" => "040705 MEJIA - ISLAY - AREQUIPA",
                    "distrito" => "MEJIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040706",
                    "fullubigeo" => "040706 PUNTA DE BOMBON - ISLAY - AREQUIPA",
                    "distrito" => "PUNTA DE BOMBON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040801",
                    "fullubigeo" => "040801 COTAHUASI - LA UNION - AREQUIPA",
                    "distrito" => "COTAHUASI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040802",
                    "fullubigeo" => "040802 ALCA - LA UNION - AREQUIPA",
                    "distrito" => "ALCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040803",
                    "fullubigeo" => "040803 CHARCANA - LA UNION - AREQUIPA",
                    "distrito" => "CHARCANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040804",
                    "fullubigeo" => "040804 HUAYNACOTAS - LA UNION - AREQUIPA",
                    "distrito" => "HUAYNACOTAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040805",
                    "fullubigeo" => "040805 PAMPAMARCA - LA UNION - AREQUIPA",
                    "distrito" => "PAMPAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040806",
                    "fullubigeo" => "040806 PUYCA - LA UNION - AREQUIPA",
                    "distrito" => "PUYCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040807",
                    "fullubigeo" => "040807 QUECHUALLA - LA UNION - AREQUIPA",
                    "distrito" => "QUECHUALLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040808",
                    "fullubigeo" => "040808 SAYLA - LA UNION - AREQUIPA",
                    "distrito" => "SAYLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040809",
                    "fullubigeo" => "040809 TAURIA - LA UNION - AREQUIPA",
                    "distrito" => "TAURIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040810",
                    "fullubigeo" => "040810 TOMEPAMPA - LA UNION - AREQUIPA",
                    "distrito" => "TOMEPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "040811",
                    "fullubigeo" => "040811 TORO - LA UNION - AREQUIPA",
                    "distrito" => "TORO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050101",
                    "fullubigeo" => "050101 AYACUCHO - HUAMANGA - AYACUCHO",
                    "distrito" => "AYACUCHO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050102",
                    "fullubigeo" => "050102 ACOCRO - HUAMANGA - AYACUCHO",
                    "distrito" => "ACOCRO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050103",
                    "fullubigeo" => "050103 ACOS VINCHOS - HUAMANGA - AYACUCHO",
                    "distrito" => "ACOS VINCHOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050104",
                    "fullubigeo" => "050104 CARMEN ALTO - HUAMANGA - AYACUCHO",
                    "distrito" => "CARMEN ALTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050105",
                    "fullubigeo" => "050105 CHIARA - HUAMANGA - AYACUCHO",
                    "distrito" => "CHIARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050106",
                    "fullubigeo" => "050106 OCROS - HUAMANGA - AYACUCHO",
                    "distrito" => "OCROS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050107",
                    "fullubigeo" => "050107 PACAYCASA - HUAMANGA - AYACUCHO",
                    "distrito" => "PACAYCASA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050108",
                    "fullubigeo" => "050108 QUINUA - HUAMANGA - AYACUCHO",
                    "distrito" => "QUINUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050109",
                    "fullubigeo" => "050109 SAN JOSE DE TICLLAS - HUAMANGA - AYACUCHO",
                    "distrito" => "SAN JOSE DE TICLLAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050110",
                    "fullubigeo" => "050110 SAN JUAN BAUTISTA - HUAMANGA - AYACUCHO",
                    "distrito" => "SAN JUAN BAUTISTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050111",
                    "fullubigeo" => "050111 SANTIAGO DE PISCHA - HUAMANGA - AYACUCHO",
                    "distrito" => "SANTIAGO DE PISCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050112",
                    "fullubigeo" => "050112 SOCOS - HUAMANGA - AYACUCHO",
                    "distrito" => "SOCOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050113",
                    "fullubigeo" => "050113 TAMBILLO - HUAMANGA - AYACUCHO",
                    "distrito" => "TAMBILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050114",
                    "fullubigeo" => "050114 VINCHOS - HUAMANGA - AYACUCHO",
                    "distrito" => "VINCHOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050115",
                    "fullubigeo" => "050115 JESUS NAZARENO - HUAMANGA - AYACUCHO",
                    "distrito" => "JESUS NAZARENO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050201",
                    "fullubigeo" => "050201 CANGALLO - CANGALLO - AYACUCHO",
                    "distrito" => "CANGALLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050202",
                    "fullubigeo" => "050202 CHUSCHI - CANGALLO - AYACUCHO",
                    "distrito" => "CHUSCHI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050203",
                    "fullubigeo" => "050203 LOS MOROCHUCOS - CANGALLO - AYACUCHO",
                    "distrito" => "LOS MOROCHUCOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050204",
                    "fullubigeo" => "050204 MARIA PARADO DE BELLIDO - CANGALLO - AYACUCHO",
                    "distrito" => "MARIA PARADO DE BELLIDO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050205",
                    "fullubigeo" => "050205 PARAS - CANGALLO - AYACUCHO",
                    "distrito" => "PARAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050206",
                    "fullubigeo" => "050206 TOTOS - CANGALLO - AYACUCHO",
                    "distrito" => "TOTOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050301",
                    "fullubigeo" => "050301 SANCOS - HUANCA SANCOS - AYACUCHO",
                    "distrito" => "SANCOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050302",
                    "fullubigeo" => "050302 CARAPO - HUANCA SANCOS - AYACUCHO",
                    "distrito" => "CARAPO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050303",
                    "fullubigeo" => "050303 SACSAMARCA - HUANCA SANCOS - AYACUCHO",
                    "distrito" => "SACSAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050304",
                    "fullubigeo" => "050304 SANTIAGO DE LUCANAMARCA - HUANCA SANCOS - AYACUCHO",
                    "distrito" => "SANTIAGO DE LUCANAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050401",
                    "fullubigeo" => "050401 HUANTA - HUANTA - AYACUCHO",
                    "distrito" => "HUANTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050402",
                    "fullubigeo" => "050402 AYAHUANCO - HUANTA - AYACUCHO",
                    "distrito" => "AYAHUANCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050403",
                    "fullubigeo" => "050403 HUAMANGUILLA - HUANTA - AYACUCHO",
                    "distrito" => "HUAMANGUILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050404",
                    "fullubigeo" => "050404 IGUAIN - HUANTA - AYACUCHO",
                    "distrito" => "IGUAIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050405",
                    "fullubigeo" => "050405 LURICOCHA - HUANTA - AYACUCHO",
                    "distrito" => "LURICOCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050406",
                    "fullubigeo" => "050406 SANTILLANA - HUANTA - AYACUCHO",
                    "distrito" => "SANTILLANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050407",
                    "fullubigeo" => "050407 SIVIA - HUANTA - AYACUCHO",
                    "distrito" => "SIVIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050408",
                    "fullubigeo" => "050408 LLOCHEGUA - HUANTA - AYACUCHO",
                    "distrito" => "LLOCHEGUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050501",
                    "fullubigeo" => "050501 SAN MIGUEL - LA MAR - AYACUCHO",
                    "distrito" => "SAN MIGUEL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050502",
                    "fullubigeo" => "050502 ANCO - LA MAR - AYACUCHO",
                    "distrito" => "ANCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050503",
                    "fullubigeo" => "050503 AYNA - LA MAR - AYACUCHO",
                    "distrito" => "AYNA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050504",
                    "fullubigeo" => "050504 CHILCAS - LA MAR - AYACUCHO",
                    "distrito" => "CHILCAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050505",
                    "fullubigeo" => "050505 CHUNGUI - LA MAR - AYACUCHO",
                    "distrito" => "CHUNGUI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050506",
                    "fullubigeo" => "050506 LUIS CARRANZA - LA MAR - AYACUCHO",
                    "distrito" => "LUIS CARRANZA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050507",
                    "fullubigeo" => "050507 SANTA ROSA - LA MAR - AYACUCHO",
                    "distrito" => "SANTA ROSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050508",
                    "fullubigeo" => "050508 TAMBO - LA MAR - AYACUCHO",
                    "distrito" => "TAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050601",
                    "fullubigeo" => "050601 PUQUIO - LUCANAS - AYACUCHO",
                    "distrito" => "PUQUIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050602",
                    "fullubigeo" => "050602 AUCARA - LUCANAS - AYACUCHO",
                    "distrito" => "AUCARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050603",
                    "fullubigeo" => "050603 CABANA - LUCANAS - AYACUCHO",
                    "distrito" => "CABANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050604",
                    "fullubigeo" => "050604 CARMEN SALCEDO - LUCANAS - AYACUCHO",
                    "distrito" => "CARMEN SALCEDO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050605",
                    "fullubigeo" => "050605 CHAVIÑA - LUCANAS - AYACUCHO",
                    "distrito" => "CHAVIÑA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050606",
                    "fullubigeo" => "050606 CHIPAO - LUCANAS - AYACUCHO",
                    "distrito" => "CHIPAO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050607",
                    "fullubigeo" => "050607 HUAC-HUAS - LUCANAS - AYACUCHO",
                    "distrito" => "HUAC-HUAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050608",
                    "fullubigeo" => "050608 LARAMATE - LUCANAS - AYACUCHO",
                    "distrito" => "LARAMATE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050609",
                    "fullubigeo" => "050609 LEONCIO PRADO - LUCANAS - AYACUCHO",
                    "distrito" => "LEONCIO PRADO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050610",
                    "fullubigeo" => "050610 LLAUTA - LUCANAS - AYACUCHO",
                    "distrito" => "LLAUTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050611",
                    "fullubigeo" => "050611 LUCANAS - LUCANAS - AYACUCHO",
                    "distrito" => "LUCANAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050612",
                    "fullubigeo" => "050612 OCAÑA - LUCANAS - AYACUCHO",
                    "distrito" => "OCAÑA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050613",
                    "fullubigeo" => "050613 OTOCA - LUCANAS - AYACUCHO",
                    "distrito" => "OTOCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050614",
                    "fullubigeo" => "050614 SAISA - LUCANAS - AYACUCHO",
                    "distrito" => "SAISA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050615",
                    "fullubigeo" => "050615 SAN CRISTOBAL - LUCANAS - AYACUCHO",
                    "distrito" => "SAN CRISTOBAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050616",
                    "fullubigeo" => "050616 SAN JUAN - LUCANAS - AYACUCHO",
                    "distrito" => "SAN JUAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050617",
                    "fullubigeo" => "050617 SAN PEDRO - LUCANAS - AYACUCHO",
                    "distrito" => "SAN PEDRO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050618",
                    "fullubigeo" => "050618 SAN PEDRO DE PALCO - LUCANAS - AYACUCHO",
                    "distrito" => "SAN PEDRO DE PALCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050619",
                    "fullubigeo" => "050619 SANCOS - LUCANAS - AYACUCHO",
                    "distrito" => "SANCOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050620",
                    "fullubigeo" => "050620 SANTA ANA DE HUAYCAHUACHO - LUCANAS - AYACUCHO",
                    "distrito" => "SANTA ANA DE HUAYCAHUACHO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050621",
                    "fullubigeo" => "050621 SANTA LUCIA - LUCANAS - AYACUCHO",
                    "distrito" => "SANTA LUCIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050701",
                    "fullubigeo" => "050701 CORACORA - PARINACOCHAS - AYACUCHO",
                    "distrito" => "CORACORA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050702",
                    "fullubigeo" => "050702 CHUMPI - PARINACOCHAS - AYACUCHO",
                    "distrito" => "CHUMPI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050703",
                    "fullubigeo" => "050703 CORONEL CASTAÑEDA - PARINACOCHAS - AYACUCHO",
                    "distrito" => "CORONEL CASTAÑEDA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050704",
                    "fullubigeo" => "050704 PACAPAUSA - PARINACOCHAS - AYACUCHO",
                    "distrito" => "PACAPAUSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050705",
                    "fullubigeo" => "050705 PULLO - PARINACOCHAS - AYACUCHO",
                    "distrito" => "PULLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050706",
                    "fullubigeo" => "050706 PUYUSCA - PARINACOCHAS - AYACUCHO",
                    "distrito" => "PUYUSCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050707",
                    "fullubigeo" => "050707 SAN FRANCISCO DE RAVACAYCO - PARINACOCHAS - AYACUCHO",
                    "distrito" => "SAN FRANCISCO DE RAVACAYCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050708",
                    "fullubigeo" => "050708 UPAHUACHO - PARINACOCHAS - AYACUCHO",
                    "distrito" => "UPAHUACHO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050801",
                    "fullubigeo" => "050801 PAUSA - PAUCAR DEL SARA SARA - AYACUCHO",
                    "distrito" => "PAUSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050802",
                    "fullubigeo" => "050802 COLTA - PAUCAR DEL SARA SARA - AYACUCHO",
                    "distrito" => "COLTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050803",
                    "fullubigeo" => "050803 CORCULLA - PAUCAR DEL SARA SARA - AYACUCHO",
                    "distrito" => "CORCULLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050804",
                    "fullubigeo" => "050804 LAMPA - PAUCAR DEL SARA SARA - AYACUCHO",
                    "distrito" => "LAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050805",
                    "fullubigeo" => "050805 MARCABAMBA - PAUCAR DEL SARA SARA - AYACUCHO",
                    "distrito" => "MARCABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050806",
                    "fullubigeo" => "050806 OYOLO - PAUCAR DEL SARA SARA - AYACUCHO",
                    "distrito" => "OYOLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050807",
                    "fullubigeo" => "050807 PARARCA - PAUCAR DEL SARA SARA - AYACUCHO",
                    "distrito" => "PARARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050808",
                    "fullubigeo" => "050808 SAN JAVIER DE ALPABAMBA - PAUCAR DEL SARA SARA - AYACUCHO",
                    "distrito" => "SAN JAVIER DE ALPABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050809",
                    "fullubigeo" => "050809 SAN JOSE DE USHUA - PAUCAR DEL SARA SARA - AYACUCHO",
                    "distrito" => "SAN JOSE DE USHUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050810",
                    "fullubigeo" => "050810 SARA SARA - PAUCAR DEL SARA SARA - AYACUCHO",
                    "distrito" => "SARA SARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050901",
                    "fullubigeo" => "050901 QUEROBAMBA - SUCRE - AYACUCHO",
                    "distrito" => "QUEROBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050902",
                    "fullubigeo" => "050902 BELEN - SUCRE - AYACUCHO",
                    "distrito" => "BELEN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050903",
                    "fullubigeo" => "050903 CHALCOS - SUCRE - AYACUCHO",
                    "distrito" => "CHALCOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050904",
                    "fullubigeo" => "050904 CHILCAYOC - SUCRE - AYACUCHO",
                    "distrito" => "CHILCAYOC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050905",
                    "fullubigeo" => "050905 HUACAÑA - SUCRE - AYACUCHO",
                    "distrito" => "HUACAÑA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050906",
                    "fullubigeo" => "050906 MORCOLLA - SUCRE - AYACUCHO",
                    "distrito" => "MORCOLLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050907",
                    "fullubigeo" => "050907 PAICO - SUCRE - AYACUCHO",
                    "distrito" => "PAICO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050908",
                    "fullubigeo" => "050908 SAN PEDRO DE LARCAY - SUCRE - AYACUCHO",
                    "distrito" => "SAN PEDRO DE LARCAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050909",
                    "fullubigeo" => "050909 SAN SALVADOR DE QUIJE - SUCRE - AYACUCHO",
                    "distrito" => "SAN SALVADOR DE QUIJE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050910",
                    "fullubigeo" => "050910 SANTIAGO DE PAUCARAY - SUCRE - AYACUCHO",
                    "distrito" => "SANTIAGO DE PAUCARAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "050911",
                    "fullubigeo" => "050911 SORAS - SUCRE - AYACUCHO",
                    "distrito" => "SORAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051001",
                    "fullubigeo" => "051001 HUANCAPI - VICTOR FAJARDO - AYACUCHO",
                    "distrito" => "HUANCAPI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051002",
                    "fullubigeo" => "051002 ALCAMENCA - VICTOR FAJARDO - AYACUCHO",
                    "distrito" => "ALCAMENCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051003",
                    "fullubigeo" => "051003 APONGO - VICTOR FAJARDO - AYACUCHO",
                    "distrito" => "APONGO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051004",
                    "fullubigeo" => "051004 ASQUIPATA - VICTOR FAJARDO - AYACUCHO",
                    "distrito" => "ASQUIPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051005",
                    "fullubigeo" => "051005 CANARIA - VICTOR FAJARDO - AYACUCHO",
                    "distrito" => "CANARIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051006",
                    "fullubigeo" => "051006 CAYARA - VICTOR FAJARDO - AYACUCHO",
                    "distrito" => "CAYARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051007",
                    "fullubigeo" => "051007 COLCA - VICTOR FAJARDO - AYACUCHO",
                    "distrito" => "COLCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051008",
                    "fullubigeo" => "051008 HUAMANQUIQUIA - VICTOR FAJARDO - AYACUCHO",
                    "distrito" => "HUAMANQUIQUIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051009",
                    "fullubigeo" => "051009 HUANCARAYLLA - VICTOR FAJARDO - AYACUCHO",
                    "distrito" => "HUANCARAYLLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051010",
                    "fullubigeo" => "051010 HUAYA - VICTOR FAJARDO - AYACUCHO",
                    "distrito" => "HUAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051011",
                    "fullubigeo" => "051011 SARHUA - VICTOR FAJARDO - AYACUCHO",
                    "distrito" => "SARHUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051012",
                    "fullubigeo" => "051012 VILCANCHOS - VICTOR FAJARDO - AYACUCHO",
                    "distrito" => "VILCANCHOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051101",
                    "fullubigeo" => "051101 VILCAS HUAMAN - VILCAS HUAMAN - AYACUCHO",
                    "distrito" => "VILCAS HUAMAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051102",
                    "fullubigeo" => "051102 ACCOMARCA - VILCAS HUAMAN - AYACUCHO",
                    "distrito" => "ACCOMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051103",
                    "fullubigeo" => "051103 CARHUANCA - VILCAS HUAMAN - AYACUCHO",
                    "distrito" => "CARHUANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051104",
                    "fullubigeo" => "051104 CONCEPCION - VILCAS HUAMAN - AYACUCHO",
                    "distrito" => "CONCEPCION", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051105",
                    "fullubigeo" => "051105 HUAMBALPA - VILCAS HUAMAN - AYACUCHO",
                    "distrito" => "HUAMBALPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051106",
                    "fullubigeo" => "051106 INDEPENDENCIA - VILCAS HUAMAN - AYACUCHO",
                    "distrito" => "INDEPENDENCIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051107",
                    "fullubigeo" => "051107 SAURAMA - VILCAS HUAMAN - AYACUCHO",
                    "distrito" => "SAURAMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "051108",
                    "fullubigeo" => "051108 VISCHONGO - VILCAS HUAMAN - AYACUCHO",
                    "distrito" => "VISCHONGO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060101",
                    "fullubigeo" => "060101 CAJAMARCA - CAJAMARCA - CAJAMARCA",
                    "distrito" => "CAJAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060102",
                    "fullubigeo" => "060102 ASUNCION - CAJAMARCA - CAJAMARCA",
                    "distrito" => "ASUNCION", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060103",
                    "fullubigeo" => "060103 CHETILLA - CAJAMARCA - CAJAMARCA",
                    "distrito" => "CHETILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060104",
                    "fullubigeo" => "060104 COSPAN - CAJAMARCA - CAJAMARCA",
                    "distrito" => "COSPAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060105",
                    "fullubigeo" => "060105 ENCAÑADA - CAJAMARCA - CAJAMARCA",
                    "distrito" => "ENCAÑADA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060106",
                    "fullubigeo" => "060106 JESUS - CAJAMARCA - CAJAMARCA",
                    "distrito" => "JESUS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060107",
                    "fullubigeo" => "060107 LLACANORA - CAJAMARCA - CAJAMARCA",
                    "distrito" => "LLACANORA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060108",
                    "fullubigeo" => "060108 LOS BAÑOS DEL INCA - CAJAMARCA - CAJAMARCA",
                    "distrito" => "LOS BAÑOS DEL INCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060109",
                    "fullubigeo" => "060109 MAGDALENA - CAJAMARCA - CAJAMARCA",
                    "distrito" => "MAGDALENA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060110",
                    "fullubigeo" => "060110 MATARA - CAJAMARCA - CAJAMARCA",
                    "distrito" => "MATARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060111",
                    "fullubigeo" => "060111 NAMORA - CAJAMARCA - CAJAMARCA",
                    "distrito" => "NAMORA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060112",
                    "fullubigeo" => "060112 SAN JUAN - CAJAMARCA - CAJAMARCA",
                    "distrito" => "SAN JUAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060201",
                    "fullubigeo" => "060201 CAJABAMBA - CAJABAMBA - CAJAMARCA",
                    "distrito" => "CAJABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060202",
                    "fullubigeo" => "060202 CACHACHI - CAJABAMBA - CAJAMARCA",
                    "distrito" => "CACHACHI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060203",
                    "fullubigeo" => "060203 CONDEBAMBA - CAJABAMBA - CAJAMARCA",
                    "distrito" => "CONDEBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060204",
                    "fullubigeo" => "060204 SITACOCHA - CAJABAMBA - CAJAMARCA",
                    "distrito" => "SITACOCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060301",
                    "fullubigeo" => "060301 CELENDIN - CELENDIN - CAJAMARCA",
                    "distrito" => "CELENDIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060302",
                    "fullubigeo" => "060302 CHUMUCH - CELENDIN - CAJAMARCA",
                    "distrito" => "CHUMUCH", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060303",
                    "fullubigeo" => "060303 CORTEGANA - CELENDIN - CAJAMARCA",
                    "distrito" => "CORTEGANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060304",
                    "fullubigeo" => "060304 HUASMIN - CELENDIN - CAJAMARCA",
                    "distrito" => "HUASMIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060305",
                    "fullubigeo" => "060305 JORGE CHAVEZ - CELENDIN - CAJAMARCA",
                    "distrito" => "JORGE CHAVEZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060306",
                    "fullubigeo" => "060306 JOSE GALVEZ - CELENDIN - CAJAMARCA",
                    "distrito" => "JOSE GALVEZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060307",
                    "fullubigeo" => "060307 MIGUEL IGLESIAS - CELENDIN - CAJAMARCA",
                    "distrito" => "MIGUEL IGLESIAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060308",
                    "fullubigeo" => "060308 OXAMARCA - CELENDIN - CAJAMARCA",
                    "distrito" => "OXAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060309",
                    "fullubigeo" => "060309 SOROCHUCO - CELENDIN - CAJAMARCA",
                    "distrito" => "SOROCHUCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060310",
                    "fullubigeo" => "060310 SUCRE - CELENDIN - CAJAMARCA",
                    "distrito" => "SUCRE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060311",
                    "fullubigeo" => "060311 UTCO - CELENDIN - CAJAMARCA",
                    "distrito" => "UTCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060312",
                    "fullubigeo" => "060312 LA LIBERTAD DE PALLAN - CELENDIN - CAJAMARCA",
                    "distrito" => "LA LIBERTAD DE PALLAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060401",
                    "fullubigeo" => "060401 CHOTA - CHOTA - CAJAMARCA",
                    "distrito" => "CHOTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060402",
                    "fullubigeo" => "060402 ANGUIA - CHOTA - CAJAMARCA",
                    "distrito" => "ANGUIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060403",
                    "fullubigeo" => "060403 CHADIN - CHOTA - CAJAMARCA",
                    "distrito" => "CHADIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060404",
                    "fullubigeo" => "060404 CHIGUIRIP - CHOTA - CAJAMARCA",
                    "distrito" => "CHIGUIRIP", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060405",
                    "fullubigeo" => "060405 CHIMBAN - CHOTA - CAJAMARCA",
                    "distrito" => "CHIMBAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060406",
                    "fullubigeo" => "060406 CHOROPAMPA - CHOTA - CAJAMARCA",
                    "distrito" => "CHOROPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060407",
                    "fullubigeo" => "060407 COCHABAMBA - CHOTA - CAJAMARCA",
                    "distrito" => "COCHABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060408",
                    "fullubigeo" => "060408 CONCHAN - CHOTA - CAJAMARCA",
                    "distrito" => "CONCHAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060409",
                    "fullubigeo" => "060409 HUAMBOS - CHOTA - CAJAMARCA",
                    "distrito" => "HUAMBOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060410",
                    "fullubigeo" => "060410 LAJAS - CHOTA - CAJAMARCA",
                    "distrito" => "LAJAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060411",
                    "fullubigeo" => "060411 LLAMA - CHOTA - CAJAMARCA",
                    "distrito" => "LLAMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060412",
                    "fullubigeo" => "060412 MIRACOSTA - CHOTA - CAJAMARCA",
                    "distrito" => "MIRACOSTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060413",
                    "fullubigeo" => "060413 PACCHA - CHOTA - CAJAMARCA",
                    "distrito" => "PACCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060414",
                    "fullubigeo" => "060414 PION - CHOTA - CAJAMARCA",
                    "distrito" => "PION", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060415",
                    "fullubigeo" => "060415 QUEROCOTO - CHOTA - CAJAMARCA",
                    "distrito" => "QUEROCOTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060416",
                    "fullubigeo" => "060416 SAN JUAN DE LICUPIS - CHOTA - CAJAMARCA",
                    "distrito" => "SAN JUAN DE LICUPIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060417",
                    "fullubigeo" => "060417 TACABAMBA - CHOTA - CAJAMARCA",
                    "distrito" => "TACABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060418",
                    "fullubigeo" => "060418 TOCMOCHE - CHOTA - CAJAMARCA",
                    "distrito" => "TOCMOCHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060419",
                    "fullubigeo" => "060419 CHALAMARCA - CHOTA - CAJAMARCA",
                    "distrito" => "CHALAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060501",
                    "fullubigeo" => "060501 CONTUMAZA - CONTUMAZA - CAJAMARCA",
                    "distrito" => "CONTUMAZA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060502",
                    "fullubigeo" => "060502 CHILETE - CONTUMAZA - CAJAMARCA",
                    "distrito" => "CHILETE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060503",
                    "fullubigeo" => "060503 CUPISNIQUE - CONTUMAZA - CAJAMARCA",
                    "distrito" => "CUPISNIQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060504",
                    "fullubigeo" => "060504 GUZMANGO - CONTUMAZA - CAJAMARCA",
                    "distrito" => "GUZMANGO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060505",
                    "fullubigeo" => "060505 SAN BENITO - CONTUMAZA - CAJAMARCA",
                    "distrito" => "SAN BENITO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060506",
                    "fullubigeo" => "060506 SANTA CRUZ DE TOLED - CONTUMAZA - CAJAMARCA",
                    "distrito" => "SANTA CRUZ DE TOLED", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060507",
                    "fullubigeo" => "060507 TANTARICA - CONTUMAZA - CAJAMARCA",
                    "distrito" => "TANTARICA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060508",
                    "fullubigeo" => "060508 YONAN - CONTUMAZA - CAJAMARCA",
                    "distrito" => "YONAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060601",
                    "fullubigeo" => "060601 CUTERVO - CUTERVO - CAJAMARCA",
                    "distrito" => "CUTERVO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060602",
                    "fullubigeo" => "060602 CALLAYUC - CUTERVO - CAJAMARCA",
                    "distrito" => "CALLAYUC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060603",
                    "fullubigeo" => "060603 CHOROS - CUTERVO - CAJAMARCA",
                    "distrito" => "CHOROS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060604",
                    "fullubigeo" => "060604 CUJILLO - CUTERVO - CAJAMARCA",
                    "distrito" => "CUJILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060605",
                    "fullubigeo" => "060605 LA RAMADA - CUTERVO - CAJAMARCA",
                    "distrito" => "LA RAMADA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060606",
                    "fullubigeo" => "060606 PIMPINGOS - CUTERVO - CAJAMARCA",
                    "distrito" => "PIMPINGOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060607",
                    "fullubigeo" => "060607 QUEROCOTILLO - CUTERVO - CAJAMARCA",
                    "distrito" => "QUEROCOTILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060608",
                    "fullubigeo" => "060608 SAN ANDRES DE CUTERVO - CUTERVO - CAJAMARCA",
                    "distrito" => "SAN ANDRES DE CUTERVO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060609",
                    "fullubigeo" => "060609 SAN JUAN DE CUTERVO - CUTERVO - CAJAMARCA",
                    "distrito" => "SAN JUAN DE CUTERVO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060610",
                    "fullubigeo" => "060610 SAN LUIS DE LUCMA - CUTERVO - CAJAMARCA",
                    "distrito" => "SAN LUIS DE LUCMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060611",
                    "fullubigeo" => "060611 SANTA CRUZ - CUTERVO - CAJAMARCA",
                    "distrito" => "SANTA CRUZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060612",
                    "fullubigeo" => "060612 SANTO DOMINGO DE LA CAPILLA - CUTERVO - CAJAMARCA",
                    "distrito" => "SANTO DOMINGO DE LA CAPILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060613",
                    "fullubigeo" => "060613 SANTO TOMAS - CUTERVO - CAJAMARCA",
                    "distrito" => "SANTO TOMAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060614",
                    "fullubigeo" => "060614 SOCOTA - CUTERVO - CAJAMARCA",
                    "distrito" => "SOCOTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060615",
                    "fullubigeo" => "060615 TORIBIO CASANOVA - CUTERVO - CAJAMARCA",
                    "distrito" => "TORIBIO CASANOVA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060701",
                    "fullubigeo" => "060701 BAMBAMARCA - HUALGAYOC - CAJAMARCA",
                    "distrito" => "BAMBAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060702",
                    "fullubigeo" => "060702 CHUGUR - HUALGAYOC - CAJAMARCA",
                    "distrito" => "CHUGUR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060703",
                    "fullubigeo" => "060703 HUALGAYOC - HUALGAYOC - CAJAMARCA",
                    "distrito" => "HUALGAYOC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060801",
                    "fullubigeo" => "060801 JAEN - JAEN - CAJAMARCA",
                    "distrito" => "JAEN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060802",
                    "fullubigeo" => "060802 BELLAVISTA - JAEN - CAJAMARCA",
                    "distrito" => "BELLAVISTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060803",
                    "fullubigeo" => "060803 CHONTALI - JAEN - CAJAMARCA",
                    "distrito" => "CHONTALI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060804",
                    "fullubigeo" => "060804 COLASAY - JAEN - CAJAMARCA",
                    "distrito" => "COLASAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060805",
                    "fullubigeo" => "060805 HUABAL - JAEN - CAJAMARCA",
                    "distrito" => "HUABAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060806",
                    "fullubigeo" => "060806 LAS PIRIAS - JAEN - CAJAMARCA",
                    "distrito" => "LAS PIRIAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060807",
                    "fullubigeo" => "060807 POMAHUACA - JAEN - CAJAMARCA",
                    "distrito" => "POMAHUACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060808",
                    "fullubigeo" => "060808 PUCARA - JAEN - CAJAMARCA",
                    "distrito" => "PUCARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060809",
                    "fullubigeo" => "060809 SALLIQUE - JAEN - CAJAMARCA",
                    "distrito" => "SALLIQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060810",
                    "fullubigeo" => "060810 SAN FELIPE - JAEN - CAJAMARCA",
                    "distrito" => "SAN FELIPE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060811",
                    "fullubigeo" => "060811 SAN JOSE DEL ALTO - JAEN - CAJAMARCA",
                    "distrito" => "SAN JOSE DEL ALTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060812",
                    "fullubigeo" => "060812 SANTA ROSA - JAEN - CAJAMARCA",
                    "distrito" => "SANTA ROSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060901",
                    "fullubigeo" => "060901 SAN IGNACIO - SAN IGNACIO - CAJAMARCA",
                    "distrito" => "SAN IGNACIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060902",
                    "fullubigeo" => "060902 CHIRINOS - SAN IGNACIO - CAJAMARCA",
                    "distrito" => "CHIRINOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060903",
                    "fullubigeo" => "060903 HUARANGO - SAN IGNACIO - CAJAMARCA",
                    "distrito" => "HUARANGO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060904",
                    "fullubigeo" => "060904 LA COIPA - SAN IGNACIO - CAJAMARCA",
                    "distrito" => "LA COIPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060905",
                    "fullubigeo" => "060905 NAMBALLE - SAN IGNACIO - CAJAMARCA",
                    "distrito" => "NAMBALLE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060906",
                    "fullubigeo" => "060906 SAN JOSE DE LOURDES - SAN IGNACIO - CAJAMARCA",
                    "distrito" => "SAN JOSE DE LOURDES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "060907",
                    "fullubigeo" => "060907 TABACONAS - SAN IGNACIO - CAJAMARCA",
                    "distrito" => "TABACONAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061001",
                    "fullubigeo" => "061001 PEDRO GALVEZ - SAN MARCOS - CAJAMARCA",
                    "distrito" => "PEDRO GALVEZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061002",
                    "fullubigeo" => "061002 CHANCAY - SAN MARCOS - CAJAMARCA",
                    "distrito" => "CHANCAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061003",
                    "fullubigeo" => "061003 EDUARDO VILLANUEVA - SAN MARCOS - CAJAMARCA",
                    "distrito" => "EDUARDO VILLANUEVA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061004",
                    "fullubigeo" => "061004 GREGORIO PITA - SAN MARCOS - CAJAMARCA",
                    "distrito" => "GREGORIO PITA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061005",
                    "fullubigeo" => "061005 ICHOCAN - SAN MARCOS - CAJAMARCA",
                    "distrito" => "ICHOCAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061006",
                    "fullubigeo" => "061006 JOSE MANUEL QUIROZ - SAN MARCOS - CAJAMARCA",
                    "distrito" => "JOSE MANUEL QUIROZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061007",
                    "fullubigeo" => "061007 JOSE SABOGAL - SAN MARCOS - CAJAMARCA",
                    "distrito" => "JOSE SABOGAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061101",
                    "fullubigeo" => "061101 SAN MIGUEL - SAN MIGUEL - CAJAMARCA",
                    "distrito" => "SAN MIGUEL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061102",
                    "fullubigeo" => "061102 BOLIVAR - SAN MIGUEL - CAJAMARCA",
                    "distrito" => "BOLIVAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061103",
                    "fullubigeo" => "061103 CALQUIS - SAN MIGUEL - CAJAMARCA",
                    "distrito" => "CALQUIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061104",
                    "fullubigeo" => "061104 CATILLUC - SAN MIGUEL - CAJAMARCA",
                    "distrito" => "CATILLUC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061105",
                    "fullubigeo" => "061105 EL PRADO - SAN MIGUEL - CAJAMARCA",
                    "distrito" => "EL PRADO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061106",
                    "fullubigeo" => "061106 LA FLORIDA - SAN MIGUEL - CAJAMARCA",
                    "distrito" => "LA FLORIDA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061107",
                    "fullubigeo" => "061107 LLAPA - SAN MIGUEL - CAJAMARCA",
                    "distrito" => "LLAPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061108",
                    "fullubigeo" => "061108 NANCHOC - SAN MIGUEL - CAJAMARCA",
                    "distrito" => "NANCHOC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061109",
                    "fullubigeo" => "061109 NIEPOS - SAN MIGUEL - CAJAMARCA",
                    "distrito" => "NIEPOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061110",
                    "fullubigeo" => "061110 SAN GREGORIO - SAN MIGUEL - CAJAMARCA",
                    "distrito" => "SAN GREGORIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061111",
                    "fullubigeo" => "061111 SAN SILVESTRE DE COCHAN - SAN MIGUEL - CAJAMARCA",
                    "distrito" => "SAN SILVESTRE DE COCHAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061112",
                    "fullubigeo" => "061112 TONGOD - SAN MIGUEL - CAJAMARCA",
                    "distrito" => "TONGOD", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061113",
                    "fullubigeo" => "061113 UNION AGUA BLANCA - SAN MIGUEL - CAJAMARCA",
                    "distrito" => "UNION AGUA BLANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061201",
                    "fullubigeo" => "061201 SAN PABLO - SAN PABLO - CAJAMARCA",
                    "distrito" => "SAN PABLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061202",
                    "fullubigeo" => "061202 SAN BERNARDINO - SAN PABLO - CAJAMARCA",
                    "distrito" => "SAN BERNARDINO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061203",
                    "fullubigeo" => "061203 SAN LUIS - SAN PABLO - CAJAMARCA",
                    "distrito" => "SAN LUIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061204",
                    "fullubigeo" => "061204 TUMBADEN - SAN PABLO - CAJAMARCA",
                    "distrito" => "TUMBADEN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061301",
                    "fullubigeo" => "061301 SANTA CRUZ - SANTA CRUZ - CAJAMARCA",
                    "distrito" => "SANTA CRUZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061302",
                    "fullubigeo" => "061302 ANDABAMBA - SANTA CRUZ - CAJAMARCA",
                    "distrito" => "ANDABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061303",
                    "fullubigeo" => "061303 CATACHE - SANTA CRUZ - CAJAMARCA",
                    "distrito" => "CATACHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061304",
                    "fullubigeo" => "061304 CHANCAYBAÑOS - SANTA CRUZ - CAJAMARCA",
                    "distrito" => "CHANCAYBAÑOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061305",
                    "fullubigeo" => "061305 LA ESPERANZA - SANTA CRUZ - CAJAMARCA",
                    "distrito" => "LA ESPERANZA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061306",
                    "fullubigeo" => "061306 NINABAMBA - SANTA CRUZ - CAJAMARCA",
                    "distrito" => "NINABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061307",
                    "fullubigeo" => "061307 PULAN - SANTA CRUZ - CAJAMARCA",
                    "distrito" => "PULAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061308",
                    "fullubigeo" => "061308 SAUCEPAMPA - SANTA CRUZ - CAJAMARCA",
                    "distrito" => "SAUCEPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061309",
                    "fullubigeo" => "061309 SEXI - SANTA CRUZ - CAJAMARCA",
                    "distrito" => "SEXI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061310",
                    "fullubigeo" => "061310 UTICYACU - SANTA CRUZ - CAJAMARCA",
                    "distrito" => "UTICYACU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "061311",
                    "fullubigeo" => "061311 YAUYUCAN - SANTA CRUZ - CAJAMARCA",
                    "distrito" => "YAUYUCAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "070101",
                    "fullubigeo" => "070101 CALLAO - PROV. CONST. DEL CALLAO - CALLAO",
                    "distrito" => "CALLAO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "070102",
                    "fullubigeo" => "070102 BELLAVISTA - PROV. CONST. DEL CALLAO - CALLAO",
                    "distrito" => "BELLAVISTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "070103",
                    "fullubigeo" => "070103 CARMEN DE LA LEGUA REYNOSO - PROV. CONST. DEL CALLAO - CALLAO",
                    "distrito" => "CARMEN DE LA LEGUA REYNOSO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "070104",
                    "fullubigeo" => "070104 LA PERLA - PROV. CONST. DEL CALLAO - CALLAO",
                    "distrito" => "LA PERLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "070105",
                    "fullubigeo" => "070105 LA PUNTA - PROV. CONST. DEL CALLAO - CALLAO",
                    "distrito" => "LA PUNTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "070106",
                    "fullubigeo" => "070106 VENTANILLA - PROV. CONST. DEL CALLAO - CALLAO",
                    "distrito" => "VENTANILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080101",
                    "fullubigeo" => "080101 CUSCO - CUSCO - CUSCO",
                    "distrito" => "CUSCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080102",
                    "fullubigeo" => "080102 CCORCA - CUSCO - CUSCO",
                    "distrito" => "CCORCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080103",
                    "fullubigeo" => "080103 POROY - CUSCO - CUSCO",
                    "distrito" => "POROY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080104",
                    "fullubigeo" => "080104 SAN JERONIMO - CUSCO - CUSCO",
                    "distrito" => "SAN JERONIMO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080105",
                    "fullubigeo" => "080105 SAN SEBASTIAN - CUSCO - CUSCO",
                    "distrito" => "SAN SEBASTIAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080106",
                    "fullubigeo" => "080106 SANTIAGO - CUSCO - CUSCO",
                    "distrito" => "SANTIAGO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080107",
                    "fullubigeo" => "080107 SAYLLA - CUSCO - CUSCO",
                    "distrito" => "SAYLLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080108",
                    "fullubigeo" => "080108 WANCHAQ - CUSCO - CUSCO",
                    "distrito" => "WANCHAQ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080201",
                    "fullubigeo" => "080201 ACOMAYO - ACOMAYO - CUSCO",
                    "distrito" => "ACOMAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080202",
                    "fullubigeo" => "080202 ACOPIA - ACOMAYO - CUSCO",
                    "distrito" => "ACOPIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080203",
                    "fullubigeo" => "080203 ACOS - ACOMAYO - CUSCO",
                    "distrito" => "ACOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080204",
                    "fullubigeo" => "080204 MOSOC LLACTA - ACOMAYO - CUSCO",
                    "distrito" => "MOSOC LLACTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080205",
                    "fullubigeo" => "080205 POMACANCHI - ACOMAYO - CUSCO",
                    "distrito" => "POMACANCHI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080206",
                    "fullubigeo" => "080206 RONDOCAN - ACOMAYO - CUSCO",
                    "distrito" => "RONDOCAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080207",
                    "fullubigeo" => "080207 SANGARARA - ACOMAYO - CUSCO",
                    "distrito" => "SANGARARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080301",
                    "fullubigeo" => "080301 ANTA - ANTA - CUSCO",
                    "distrito" => "ANTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080302",
                    "fullubigeo" => "080302 ANCAHUASI - ANTA - CUSCO",
                    "distrito" => "ANCAHUASI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080303",
                    "fullubigeo" => "080303 CACHIMAYO - ANTA - CUSCO",
                    "distrito" => "CACHIMAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080304",
                    "fullubigeo" => "080304 CHINCHAYPUJIO - ANTA - CUSCO",
                    "distrito" => "CHINCHAYPUJIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080305",
                    "fullubigeo" => "080305 HUAROCONDO - ANTA - CUSCO",
                    "distrito" => "HUAROCONDO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080306",
                    "fullubigeo" => "080306 LIMATAMBO - ANTA - CUSCO",
                    "distrito" => "LIMATAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080307",
                    "fullubigeo" => "080307 MOLLEPATA - ANTA - CUSCO",
                    "distrito" => "MOLLEPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080308",
                    "fullubigeo" => "080308 PUCYURA - ANTA - CUSCO",
                    "distrito" => "PUCYURA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080309",
                    "fullubigeo" => "080309 ZURITE - ANTA - CUSCO",
                    "distrito" => "ZURITE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080401",
                    "fullubigeo" => "080401 CALCA - CALCA - CUSCO",
                    "distrito" => "CALCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080402",
                    "fullubigeo" => "080402 COYA - CALCA - CUSCO",
                    "distrito" => "COYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080403",
                    "fullubigeo" => "080403 LAMAY - CALCA - CUSCO",
                    "distrito" => "LAMAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080404",
                    "fullubigeo" => "080404 LARES - CALCA - CUSCO",
                    "distrito" => "LARES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080405",
                    "fullubigeo" => "080405 PISAC - CALCA - CUSCO",
                    "distrito" => "PISAC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080406",
                    "fullubigeo" => "080406 SAN SALVADOR - CALCA - CUSCO",
                    "distrito" => "SAN SALVADOR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080407",
                    "fullubigeo" => "080407 TARAY - CALCA - CUSCO",
                    "distrito" => "TARAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080408",
                    "fullubigeo" => "080408 YANATILE - CALCA - CUSCO",
                    "distrito" => "YANATILE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080501",
                    "fullubigeo" => "080501 YANAOCA - CANAS - CUSCO",
                    "distrito" => "YANAOCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080502",
                    "fullubigeo" => "080502 CHECCA - CANAS - CUSCO",
                    "distrito" => "CHECCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080503",
                    "fullubigeo" => "080503 KUNTURKANKI - CANAS - CUSCO",
                    "distrito" => "KUNTURKANKI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080504",
                    "fullubigeo" => "080504 LANGUI - CANAS - CUSCO",
                    "distrito" => "LANGUI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080505",
                    "fullubigeo" => "080505 LAYO - CANAS - CUSCO",
                    "distrito" => "LAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080506",
                    "fullubigeo" => "080506 PAMPAMARCA - CANAS - CUSCO",
                    "distrito" => "PAMPAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080507",
                    "fullubigeo" => "080507 QUEHUE - CANAS - CUSCO",
                    "distrito" => "QUEHUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080508",
                    "fullubigeo" => "080508 TUPAC AMARU - CANAS - CUSCO",
                    "distrito" => "TUPAC AMARU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080601",
                    "fullubigeo" => "080601 SICUANI - CANCHIS - CUSCO",
                    "distrito" => "SICUANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080602",
                    "fullubigeo" => "080602 CHECACUPE - CANCHIS - CUSCO",
                    "distrito" => "CHECACUPE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080603",
                    "fullubigeo" => "080603 COMBAPATA - CANCHIS - CUSCO",
                    "distrito" => "COMBAPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080604",
                    "fullubigeo" => "080604 MARANGANI - CANCHIS - CUSCO",
                    "distrito" => "MARANGANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080605",
                    "fullubigeo" => "080605 PITUMARCA - CANCHIS - CUSCO",
                    "distrito" => "PITUMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080606",
                    "fullubigeo" => "080606 SAN PABLO - CANCHIS - CUSCO",
                    "distrito" => "SAN PABLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080607",
                    "fullubigeo" => "080607 SAN PEDRO - CANCHIS - CUSCO",
                    "distrito" => "SAN PEDRO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080608",
                    "fullubigeo" => "080608 TINTA - CANCHIS - CUSCO",
                    "distrito" => "TINTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080701",
                    "fullubigeo" => "080701 SANTO TOMAS - CHUMBIVILCAS - CUSCO",
                    "distrito" => "SANTO TOMAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080702",
                    "fullubigeo" => "080702 CAPACMARCA - CHUMBIVILCAS - CUSCO",
                    "distrito" => "CAPACMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080703",
                    "fullubigeo" => "080703 CHAMACA - CHUMBIVILCAS - CUSCO",
                    "distrito" => "CHAMACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080704",
                    "fullubigeo" => "080704 COLQUEMARCA - CHUMBIVILCAS - CUSCO",
                    "distrito" => "COLQUEMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080705",
                    "fullubigeo" => "080705 LIVITACA - CHUMBIVILCAS - CUSCO",
                    "distrito" => "LIVITACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080706",
                    "fullubigeo" => "080706 LLUSCO - CHUMBIVILCAS - CUSCO",
                    "distrito" => "LLUSCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080707",
                    "fullubigeo" => "080707 QUIÑOTA - CHUMBIVILCAS - CUSCO",
                    "distrito" => "QUIÑOTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080708",
                    "fullubigeo" => "080708 VELILLE - CHUMBIVILCAS - CUSCO",
                    "distrito" => "VELILLE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080801",
                    "fullubigeo" => "080801 ESPINAR - ESPINAR - CUSCO",
                    "distrito" => "ESPINAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080802",
                    "fullubigeo" => "080802 CONDOROMA - ESPINAR - CUSCO",
                    "distrito" => "CONDOROMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080803",
                    "fullubigeo" => "080803 COPORAQUE - ESPINAR - CUSCO",
                    "distrito" => "COPORAQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080804",
                    "fullubigeo" => "080804 OCORURO - ESPINAR - CUSCO",
                    "distrito" => "OCORURO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080805",
                    "fullubigeo" => "080805 PALLPATA - ESPINAR - CUSCO",
                    "distrito" => "PALLPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080806",
                    "fullubigeo" => "080806 PICHIGUA - ESPINAR - CUSCO",
                    "distrito" => "PICHIGUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080807",
                    "fullubigeo" => "080807 SUYCKUTAMBO - ESPINAR - CUSCO",
                    "distrito" => "SUYCKUTAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080808",
                    "fullubigeo" => "080808 ALTO PICHIGUA - ESPINAR - CUSCO",
                    "distrito" => "ALTO PICHIGUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080901",
                    "fullubigeo" => "080901 SANTA ANA - LA CONVENCION - CUSCO",
                    "distrito" => "SANTA ANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080902",
                    "fullubigeo" => "080902 ECHARATE - LA CONVENCION - CUSCO",
                    "distrito" => "ECHARATE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080903",
                    "fullubigeo" => "080903 HUAYOPATA - LA CONVENCION - CUSCO",
                    "distrito" => "HUAYOPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080904",
                    "fullubigeo" => "080904 MARANURA - LA CONVENCION - CUSCO",
                    "distrito" => "MARANURA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080905",
                    "fullubigeo" => "080905 OCOBAMBA - LA CONVENCION - CUSCO",
                    "distrito" => "OCOBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080906",
                    "fullubigeo" => "080906 QUELLOUNO - LA CONVENCION - CUSCO",
                    "distrito" => "QUELLOUNO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080907",
                    "fullubigeo" => "080907 KIMBIRI - LA CONVENCION - CUSCO",
                    "distrito" => "KIMBIRI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080908",
                    "fullubigeo" => "080908 SANTA TERESA - LA CONVENCION - CUSCO",
                    "distrito" => "SANTA TERESA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080909",
                    "fullubigeo" => "080909 VILCABAMBA - LA CONVENCION - CUSCO",
                    "distrito" => "VILCABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "080910",
                    "fullubigeo" => "080910 PICHARI - LA CONVENCION - CUSCO",
                    "distrito" => "PICHARI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081001",
                    "fullubigeo" => "081001 PARURO - PARURO - CUSCO",
                    "distrito" => "PARURO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081002",
                    "fullubigeo" => "081002 ACCHA - PARURO - CUSCO",
                    "distrito" => "ACCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081003",
                    "fullubigeo" => "081003 CCAPI - PARURO - CUSCO",
                    "distrito" => "CCAPI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081004",
                    "fullubigeo" => "081004 COLCHA - PARURO - CUSCO",
                    "distrito" => "COLCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081005",
                    "fullubigeo" => "081005 HUANOQUITE - PARURO - CUSCO",
                    "distrito" => "HUANOQUITE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081006",
                    "fullubigeo" => "081006 OMACHA - PARURO - CUSCO",
                    "distrito" => "OMACHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081007",
                    "fullubigeo" => "081007 PACCARITAMBO - PARURO - CUSCO",
                    "distrito" => "PACCARITAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081008",
                    "fullubigeo" => "081008 PILLPINTO - PARURO - CUSCO",
                    "distrito" => "PILLPINTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081009",
                    "fullubigeo" => "081009 YAURISQUE - PARURO - CUSCO",
                    "distrito" => "YAURISQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081101",
                    "fullubigeo" => "081101 PAUCARTAMBO - PAUCARTAMBO - CUSCO",
                    "distrito" => "PAUCARTAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081102",
                    "fullubigeo" => "081102 CAICAY - PAUCARTAMBO - CUSCO",
                    "distrito" => "CAICAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081103",
                    "fullubigeo" => "081103 CHALLABAMBA - PAUCARTAMBO - CUSCO",
                    "distrito" => "CHALLABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081104",
                    "fullubigeo" => "081104 COLQUEPATA - PAUCARTAMBO - CUSCO",
                    "distrito" => "COLQUEPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081105",
                    "fullubigeo" => "081105 HUANCARANI - PAUCARTAMBO - CUSCO",
                    "distrito" => "HUANCARANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081106",
                    "fullubigeo" => "081106 KOSÑIPATA - PAUCARTAMBO - CUSCO",
                    "distrito" => "KOSÑIPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081201",
                    "fullubigeo" => "081201 URCOS - QUISPICANCHI - CUSCO",
                    "distrito" => "URCOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081202",
                    "fullubigeo" => "081202 ANDAHUAYLILLAS - QUISPICANCHI - CUSCO",
                    "distrito" => "ANDAHUAYLILLAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081203",
                    "fullubigeo" => "081203 CAMANTI - QUISPICANCHI - CUSCO",
                    "distrito" => "CAMANTI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081204",
                    "fullubigeo" => "081204 CCARHUAYO - QUISPICANCHI - CUSCO",
                    "distrito" => "CCARHUAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081205",
                    "fullubigeo" => "081205 CCATCA - QUISPICANCHI - CUSCO",
                    "distrito" => "CCATCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081206",
                    "fullubigeo" => "081206 CUSIPATA - QUISPICANCHI - CUSCO",
                    "distrito" => "CUSIPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081207",
                    "fullubigeo" => "081207 HUARO - QUISPICANCHI - CUSCO",
                    "distrito" => "HUARO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081208",
                    "fullubigeo" => "081208 LUCRE - QUISPICANCHI - CUSCO",
                    "distrito" => "LUCRE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081209",
                    "fullubigeo" => "081209 MARCAPATA - QUISPICANCHI - CUSCO",
                    "distrito" => "MARCAPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081210",
                    "fullubigeo" => "081210 OCONGATE - QUISPICANCHI - CUSCO",
                    "distrito" => "OCONGATE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081211",
                    "fullubigeo" => "081211 OROPESA - QUISPICANCHI - CUSCO",
                    "distrito" => "OROPESA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081212",
                    "fullubigeo" => "081212 QUIQUIJANA - QUISPICANCHI - CUSCO",
                    "distrito" => "QUIQUIJANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081301",
                    "fullubigeo" => "081301 URUBAMBA - URUBAMBA - CUSCO",
                    "distrito" => "URUBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081302",
                    "fullubigeo" => "081302 CHINCHERO - URUBAMBA - CUSCO",
                    "distrito" => "CHINCHERO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081303",
                    "fullubigeo" => "081303 HUAYLLABAMBA - URUBAMBA - CUSCO",
                    "distrito" => "HUAYLLABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081304",
                    "fullubigeo" => "081304 MACHUPICCHU - URUBAMBA - CUSCO",
                    "distrito" => "MACHUPICCHU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081305",
                    "fullubigeo" => "081305 MARAS - URUBAMBA - CUSCO",
                    "distrito" => "MARAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081306",
                    "fullubigeo" => "081306 OLLANTAYTAMBO - URUBAMBA - CUSCO",
                    "distrito" => "OLLANTAYTAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "081307",
                    "fullubigeo" => "081307 YUCAY - URUBAMBA - CUSCO",
                    "distrito" => "YUCAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090101",
                    "fullubigeo" => "090101 HUANCAVELICA - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "HUANCAVELICA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090102",
                    "fullubigeo" => "090102 ACOBAMBILLA - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "ACOBAMBILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090103",
                    "fullubigeo" => "090103 ACORIA - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "ACORIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090104",
                    "fullubigeo" => "090104 CONAYCA - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "CONAYCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090105",
                    "fullubigeo" => "090105 CUENCA - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "CUENCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090106",
                    "fullubigeo" => "090106 HUACHOCOLPA - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "HUACHOCOLPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090107",
                    "fullubigeo" => "090107 HUAYLLAHUARA - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "HUAYLLAHUARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090108",
                    "fullubigeo" => "090108 IZCUCHACA - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "IZCUCHACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090109",
                    "fullubigeo" => "090109 LARIA - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "LARIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090110",
                    "fullubigeo" => "090110 MANTA - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "MANTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090111",
                    "fullubigeo" => "090111 MARISCAL CACERES - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "MARISCAL CACERES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090112",
                    "fullubigeo" => "090112 MOYA - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "MOYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090113",
                    "fullubigeo" => "090113 NUEVO OCCORO - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "NUEVO OCCORO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090114",
                    "fullubigeo" => "090114 PALCA - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "PALCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090115",
                    "fullubigeo" => "090115 PILCHACA - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "PILCHACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090116",
                    "fullubigeo" => "090116 VILCA - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "VILCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090117",
                    "fullubigeo" => "090117 YAULI - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "YAULI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090118",
                    "fullubigeo" => "090118 ASCENSION - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "ASCENSION", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090119",
                    "fullubigeo" => "090119 HUANDO - HUANCAVELICA - HUANCAVELICA",
                    "distrito" => "HUANDO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090201",
                    "fullubigeo" => "090201 ACOBAMBA - ACOBAMBA - HUANCAVELICA",
                    "distrito" => "ACOBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090202",
                    "fullubigeo" => "090202 ANDABAMBA - ACOBAMBA - HUANCAVELICA",
                    "distrito" => "ANDABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090203",
                    "fullubigeo" => "090203 ANTA - ACOBAMBA - HUANCAVELICA",
                    "distrito" => "ANTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090204",
                    "fullubigeo" => "090204 CAJA - ACOBAMBA - HUANCAVELICA",
                    "distrito" => "CAJA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090205",
                    "fullubigeo" => "090205 MARCAS - ACOBAMBA - HUANCAVELICA",
                    "distrito" => "MARCAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090206",
                    "fullubigeo" => "090206 PAUCARA - ACOBAMBA - HUANCAVELICA",
                    "distrito" => "PAUCARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090207",
                    "fullubigeo" => "090207 POMACOCHA - ACOBAMBA - HUANCAVELICA",
                    "distrito" => "POMACOCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090208",
                    "fullubigeo" => "090208 ROSARIO - ACOBAMBA - HUANCAVELICA",
                    "distrito" => "ROSARIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090301",
                    "fullubigeo" => "090301 LIRCAY - ANGARAES - HUANCAVELICA",
                    "distrito" => "LIRCAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090302",
                    "fullubigeo" => "090302 ANCHONGA - ANGARAES - HUANCAVELICA",
                    "distrito" => "ANCHONGA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090303",
                    "fullubigeo" => "090303 CALLANMARCA - ANGARAES - HUANCAVELICA",
                    "distrito" => "CALLANMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090304",
                    "fullubigeo" => "090304 CCOCHACCASA - ANGARAES - HUANCAVELICA",
                    "distrito" => "CCOCHACCASA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090305",
                    "fullubigeo" => "090305 CHINCHO - ANGARAES - HUANCAVELICA",
                    "distrito" => "CHINCHO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090306",
                    "fullubigeo" => "090306 CONGALLA - ANGARAES - HUANCAVELICA",
                    "distrito" => "CONGALLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090307",
                    "fullubigeo" => "090307 HUANCA-HUANCA - ANGARAES - HUANCAVELICA",
                    "distrito" => "HUANCA-HUANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090308",
                    "fullubigeo" => "090308 HUAYLLAY GRANDE - ANGARAES - HUANCAVELICA",
                    "distrito" => "HUAYLLAY GRANDE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090309",
                    "fullubigeo" => "090309 JULCAMARCA - ANGARAES - HUANCAVELICA",
                    "distrito" => "JULCAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090310",
                    "fullubigeo" => "090310 SAN ANTONIO DE ANTAPARCO - ANGARAES - HUANCAVELICA",
                    "distrito" => "SAN ANTONIO DE ANTAPARCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090311",
                    "fullubigeo" => "090311 SANTO TOMAS DE PATA - ANGARAES - HUANCAVELICA",
                    "distrito" => "SANTO TOMAS DE PATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090312",
                    "fullubigeo" => "090312 SECCLLA - ANGARAES - HUANCAVELICA",
                    "distrito" => "SECCLLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090401",
                    "fullubigeo" => "090401 CASTROVIRREYNA - CASTROVIRREYNA - HUANCAVELICA",
                    "distrito" => "CASTROVIRREYNA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090402",
                    "fullubigeo" => "090402 ARMA - CASTROVIRREYNA - HUANCAVELICA",
                    "distrito" => "ARMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090403",
                    "fullubigeo" => "090403 AURAHUA - CASTROVIRREYNA - HUANCAVELICA",
                    "distrito" => "AURAHUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090404",
                    "fullubigeo" => "090404 CAPILLAS - CASTROVIRREYNA - HUANCAVELICA",
                    "distrito" => "CAPILLAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090405",
                    "fullubigeo" => "090405 CHUPAMARCA - CASTROVIRREYNA - HUANCAVELICA",
                    "distrito" => "CHUPAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090406",
                    "fullubigeo" => "090406 COCAS - CASTROVIRREYNA - HUANCAVELICA",
                    "distrito" => "COCAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090407",
                    "fullubigeo" => "090407 HUACHOS - CASTROVIRREYNA - HUANCAVELICA",
                    "distrito" => "HUACHOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090408",
                    "fullubigeo" => "090408 HUAMATAMBO - CASTROVIRREYNA - HUANCAVELICA",
                    "distrito" => "HUAMATAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090409",
                    "fullubigeo" => "090409 MOLLEPAMPA - CASTROVIRREYNA - HUANCAVELICA",
                    "distrito" => "MOLLEPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090410",
                    "fullubigeo" => "090410 SAN JUAN - CASTROVIRREYNA - HUANCAVELICA",
                    "distrito" => "SAN JUAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090411",
                    "fullubigeo" => "090411 SANTA ANA - CASTROVIRREYNA - HUANCAVELICA",
                    "distrito" => "SANTA ANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090412",
                    "fullubigeo" => "090412 TANTARA - CASTROVIRREYNA - HUANCAVELICA",
                    "distrito" => "TANTARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090413",
                    "fullubigeo" => "090413 TICRAPO - CASTROVIRREYNA - HUANCAVELICA",
                    "distrito" => "TICRAPO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090501",
                    "fullubigeo" => "090501 CHURCAMPA - CHURCAMPA - HUANCAVELICA",
                    "distrito" => "CHURCAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090502",
                    "fullubigeo" => "090502 ANCO - CHURCAMPA - HUANCAVELICA",
                    "distrito" => "ANCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090503",
                    "fullubigeo" => "090503 CHINCHIHUASI - CHURCAMPA - HUANCAVELICA",
                    "distrito" => "CHINCHIHUASI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090504",
                    "fullubigeo" => "090504 EL CARMEN - CHURCAMPA - HUANCAVELICA",
                    "distrito" => "EL CARMEN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090505",
                    "fullubigeo" => "090505 LA MERCED - CHURCAMPA - HUANCAVELICA",
                    "distrito" => "LA MERCED", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090506",
                    "fullubigeo" => "090506 LOCROJA - CHURCAMPA - HUANCAVELICA",
                    "distrito" => "LOCROJA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090507",
                    "fullubigeo" => "090507 PAUCARBAMBA - CHURCAMPA - HUANCAVELICA",
                    "distrito" => "PAUCARBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090508",
                    "fullubigeo" => "090508 SAN MIGUEL DE MAYOCC - CHURCAMPA - HUANCAVELICA",
                    "distrito" => "SAN MIGUEL DE MAYOCC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090509",
                    "fullubigeo" => "090509 SAN PEDRO DE CORIS - CHURCAMPA - HUANCAVELICA",
                    "distrito" => "SAN PEDRO DE CORIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090510",
                    "fullubigeo" => "090510 PACHAMARCA - CHURCAMPA - HUANCAVELICA",
                    "distrito" => "PACHAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090601",
                    "fullubigeo" => "090601 HUAYTARA - HUAYTARA - HUANCAVELICA",
                    "distrito" => "HUAYTARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090602",
                    "fullubigeo" => "090602 AYAVI - HUAYTARA - HUANCAVELICA",
                    "distrito" => "AYAVI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090603",
                    "fullubigeo" => "090603 CORDOVA - HUAYTARA - HUANCAVELICA",
                    "distrito" => "CORDOVA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090604",
                    "fullubigeo" => "090604 HUAYACUNDO ARMA - HUAYTARA - HUANCAVELICA",
                    "distrito" => "HUAYACUNDO ARMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090605",
                    "fullubigeo" => "090605 LARAMARCA - HUAYTARA - HUANCAVELICA",
                    "distrito" => "LARAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090606",
                    "fullubigeo" => "090606 OCOYO - HUAYTARA - HUANCAVELICA",
                    "distrito" => "OCOYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090607",
                    "fullubigeo" => "090607 PILPICHACA - HUAYTARA - HUANCAVELICA",
                    "distrito" => "PILPICHACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090608",
                    "fullubigeo" => "090608 QUERCO - HUAYTARA - HUANCAVELICA",
                    "distrito" => "QUERCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090609",
                    "fullubigeo" => "090609 QUITO-ARMA - HUAYTARA - HUANCAVELICA",
                    "distrito" => "QUITO-ARMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090610",
                    "fullubigeo" => "090610 SAN ANTONIO DE CUSICANCHA - HUAYTARA - HUANCAVELICA",
                    "distrito" => "SAN ANTONIO DE CUSICANCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090611",
                    "fullubigeo" => "090611 SAN FRANCISCO DE SANGAYAICO - HUAYTARA - HUANCAVELICA",
                    "distrito" => "SAN FRANCISCO DE SANGAYAICO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090612",
                    "fullubigeo" => "090612 SAN ISIDRO - HUAYTARA - HUANCAVELICA",
                    "distrito" => "SAN ISIDRO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090613",
                    "fullubigeo" => "090613 SANTIAGO DE CHOCORVOS - HUAYTARA - HUANCAVELICA",
                    "distrito" => "SANTIAGO DE CHOCORVOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090614",
                    "fullubigeo" => "090614 SANTIAGO DE QUIRAHUARA - HUAYTARA - HUANCAVELICA",
                    "distrito" => "SANTIAGO DE QUIRAHUARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090615",
                    "fullubigeo" => "090615 SANTO DOMINGO DE CAPILLAS - HUAYTARA - HUANCAVELICA",
                    "distrito" => "SANTO DOMINGO DE CAPILLAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090616",
                    "fullubigeo" => "090616 TAMBO - HUAYTARA - HUANCAVELICA",
                    "distrito" => "TAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090701",
                    "fullubigeo" => "090701 PAMPAS - TAYACAJA - HUANCAVELICA",
                    "distrito" => "PAMPAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090702",
                    "fullubigeo" => "090702 ACOSTAMBO - TAYACAJA - HUANCAVELICA",
                    "distrito" => "ACOSTAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090703",
                    "fullubigeo" => "090703 ACRAQUIA - TAYACAJA - HUANCAVELICA",
                    "distrito" => "ACRAQUIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090704",
                    "fullubigeo" => "090704 AHUAYCHA - TAYACAJA - HUANCAVELICA",
                    "distrito" => "AHUAYCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090705",
                    "fullubigeo" => "090705 COLCABAMBA - TAYACAJA - HUANCAVELICA",
                    "distrito" => "COLCABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090706",
                    "fullubigeo" => "090706 DANIEL HERNANDEZ - TAYACAJA - HUANCAVELICA",
                    "distrito" => "DANIEL HERNANDEZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090707",
                    "fullubigeo" => "090707 HUACHOCOLPA - TAYACAJA - HUANCAVELICA",
                    "distrito" => "HUACHOCOLPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090709",
                    "fullubigeo" => "090709 HUARIBAMBA - TAYACAJA - HUANCAVELICA",
                    "distrito" => "HUARIBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090710",
                    "fullubigeo" => "090710 ÑAHUIMPUQUIO - TAYACAJA - HUANCAVELICA",
                    "distrito" => "ÑAHUIMPUQUIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090711",
                    "fullubigeo" => "090711 PAZOS - TAYACAJA - HUANCAVELICA",
                    "distrito" => "PAZOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090713",
                    "fullubigeo" => "090713 QUISHUAR - TAYACAJA - HUANCAVELICA",
                    "distrito" => "QUISHUAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090714",
                    "fullubigeo" => "090714 SALCABAMBA - TAYACAJA - HUANCAVELICA",
                    "distrito" => "SALCABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090715",
                    "fullubigeo" => "090715 SALCAHUASI - TAYACAJA - HUANCAVELICA",
                    "distrito" => "SALCAHUASI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090716",
                    "fullubigeo" => "090716 SAN MARCOS DE ROCCHAC - TAYACAJA - HUANCAVELICA",
                    "distrito" => "SAN MARCOS DE ROCCHAC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090717",
                    "fullubigeo" => "090717 SURCUBAMBA - TAYACAJA - HUANCAVELICA",
                    "distrito" => "SURCUBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "090718",
                    "fullubigeo" => "090718 TINTAY PUNCU - TAYACAJA - HUANCAVELICA",
                    "distrito" => "TINTAY PUNCU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100101",
                    "fullubigeo" => "100101 HUANUCO - HUANUCO - HUÁNUCO",
                    "distrito" => "HUANUCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100102",
                    "fullubigeo" => "100102 AMARILIS - HUANUCO - HUÁNUCO",
                    "distrito" => "AMARILIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100103",
                    "fullubigeo" => "100103 CHINCHAO - HUANUCO - HUÁNUCO",
                    "distrito" => "CHINCHAO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100104",
                    "fullubigeo" => "100104 CHURUBAMBA - HUANUCO - HUÁNUCO",
                    "distrito" => "CHURUBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100105",
                    "fullubigeo" => "100105 MARGOS - HUANUCO - HUÁNUCO",
                    "distrito" => "MARGOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100106",
                    "fullubigeo" => "100106 QUISQUI - HUANUCO - HUÁNUCO",
                    "distrito" => "QUISQUI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100107",
                    "fullubigeo" => "100107 SAN FRANCISCO DE CAYRAN - HUANUCO - HUÁNUCO",
                    "distrito" => "SAN FRANCISCO DE CAYRAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100108",
                    "fullubigeo" => "100108 SAN PEDRO DE CHAULAN - HUANUCO - HUÁNUCO",
                    "distrito" => "SAN PEDRO DE CHAULAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100109",
                    "fullubigeo" => "100109 SANTA MARIA DEL VALLE - HUANUCO - HUÁNUCO",
                    "distrito" => "SANTA MARIA DEL VALLE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100110",
                    "fullubigeo" => "100110 YARUMAYO - HUANUCO - HUÁNUCO",
                    "distrito" => "YARUMAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100111",
                    "fullubigeo" => "100111 PILLCO MARCA - HUANUCO - HUÁNUCO",
                    "distrito" => "PILLCO MARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100201",
                    "fullubigeo" => "100201 AMBO - AMBO - HUÁNUCO",
                    "distrito" => "AMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100202",
                    "fullubigeo" => "100202 CAYNA - AMBO - HUÁNUCO",
                    "distrito" => "CAYNA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100203",
                    "fullubigeo" => "100203 COLPAS - AMBO - HUÁNUCO",
                    "distrito" => "COLPAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100204",
                    "fullubigeo" => "100204 CONCHAMARCA - AMBO - HUÁNUCO",
                    "distrito" => "CONCHAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100205",
                    "fullubigeo" => "100205 HUACAR - AMBO - HUÁNUCO",
                    "distrito" => "HUACAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100206",
                    "fullubigeo" => "100206 SAN FRANCISCO - AMBO - HUÁNUCO",
                    "distrito" => "SAN FRANCISCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100207",
                    "fullubigeo" => "100207 SAN RAFAEL - AMBO - HUÁNUCO",
                    "distrito" => "SAN RAFAEL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100208",
                    "fullubigeo" => "100208 TOMAY KICHWA - AMBO - HUÁNUCO",
                    "distrito" => "TOMAY KICHWA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100301",
                    "fullubigeo" => "100301 LA UNION - DOS DE MAYO - HUÁNUCO",
                    "distrito" => "LA UNION", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100307",
                    "fullubigeo" => "100307 CHUQUIS - DOS DE MAYO - HUÁNUCO",
                    "distrito" => "CHUQUIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100311",
                    "fullubigeo" => "100311 MARIAS - DOS DE MAYO - HUÁNUCO",
                    "distrito" => "MARIAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100313",
                    "fullubigeo" => "100313 PACHAS - DOS DE MAYO - HUÁNUCO",
                    "distrito" => "PACHAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100316",
                    "fullubigeo" => "100316 QUIVILLA - DOS DE MAYO - HUÁNUCO",
                    "distrito" => "QUIVILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100317",
                    "fullubigeo" => "100317 RIPAN - DOS DE MAYO - HUÁNUCO",
                    "distrito" => "RIPAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100321",
                    "fullubigeo" => "100321 SHUNQUI - DOS DE MAYO - HUÁNUCO",
                    "distrito" => "SHUNQUI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100322",
                    "fullubigeo" => "100322 SILLAPATA - DOS DE MAYO - HUÁNUCO",
                    "distrito" => "SILLAPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100323",
                    "fullubigeo" => "100323 YANAS - DOS DE MAYO - HUÁNUCO",
                    "distrito" => "YANAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100401",
                    "fullubigeo" => "100401 HUACAYBAMBA - HUACAYBAMBA - HUÁNUCO",
                    "distrito" => "HUACAYBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100402",
                    "fullubigeo" => "100402 CANCHABAMBA - HUACAYBAMBA - HUÁNUCO",
                    "distrito" => "CANCHABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100403",
                    "fullubigeo" => "100403 COCHABAMBA - HUACAYBAMBA - HUÁNUCO",
                    "distrito" => "COCHABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100404",
                    "fullubigeo" => "100404 PINRA - HUACAYBAMBA - HUÁNUCO",
                    "distrito" => "PINRA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100501",
                    "fullubigeo" => "100501 LLATA - HUAMALIES - HUÁNUCO",
                    "distrito" => "LLATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100502",
                    "fullubigeo" => "100502 ARANCAY - HUAMALIES - HUÁNUCO",
                    "distrito" => "ARANCAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100503",
                    "fullubigeo" => "100503 CHAVIN DE PARIARCA - HUAMALIES - HUÁNUCO",
                    "distrito" => "CHAVIN DE PARIARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100504",
                    "fullubigeo" => "100504 JACAS GRANDE - HUAMALIES - HUÁNUCO",
                    "distrito" => "JACAS GRANDE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100505",
                    "fullubigeo" => "100505 JIRCAN - HUAMALIES - HUÁNUCO",
                    "distrito" => "JIRCAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100506",
                    "fullubigeo" => "100506 MIRAFLORES - HUAMALIES - HUÁNUCO",
                    "distrito" => "MIRAFLORES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100507",
                    "fullubigeo" => "100507 MONZON - HUAMALIES - HUÁNUCO",
                    "distrito" => "MONZON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100508",
                    "fullubigeo" => "100508 PUNCHAO - HUAMALIES - HUÁNUCO",
                    "distrito" => "PUNCHAO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100509",
                    "fullubigeo" => "100509 PUÑOS - HUAMALIES - HUÁNUCO",
                    "distrito" => "PUÑOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100510",
                    "fullubigeo" => "100510 SINGA - HUAMALIES - HUÁNUCO",
                    "distrito" => "SINGA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100511",
                    "fullubigeo" => "100511 TANTAMAYO - HUAMALIES - HUÁNUCO",
                    "distrito" => "TANTAMAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100601",
                    "fullubigeo" => "100601 RUPA-RUPA - LEONCIO PRADO - HUÁNUCO",
                    "distrito" => "RUPA-RUPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100602",
                    "fullubigeo" => "100602 DANIEL ALOMIA ROBLES - LEONCIO PRADO - HUÁNUCO",
                    "distrito" => "DANIEL ALOMIA ROBLES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100603",
                    "fullubigeo" => "100603 HERMILIO VALDIZAN - LEONCIO PRADO - HUÁNUCO",
                    "distrito" => "HERMILIO VALDIZAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100604",
                    "fullubigeo" => "100604 JOSE CRESPO Y CASTILLO - LEONCIO PRADO - HUÁNUCO",
                    "distrito" => "JOSE CRESPO Y CASTILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100605",
                    "fullubigeo" => "100605 LUYANDO - LEONCIO PRADO - HUÁNUCO",
                    "distrito" => "LUYANDO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100606",
                    "fullubigeo" => "100606 MARIANO DAMASO BERAUN - LEONCIO PRADO - HUÁNUCO",
                    "distrito" => "MARIANO DAMASO BERAUN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100701",
                    "fullubigeo" => "100701 HUACRACHUCO - MARAÑON - HUÁNUCO",
                    "distrito" => "HUACRACHUCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100702",
                    "fullubigeo" => "100702 CHOLON - MARAÑON - HUÁNUCO",
                    "distrito" => "CHOLON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100703",
                    "fullubigeo" => "100703 SAN BUENAVENTURA - MARAÑON - HUÁNUCO",
                    "distrito" => "SAN BUENAVENTURA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100801",
                    "fullubigeo" => "100801 PANAO - PACHITEA - HUÁNUCO",
                    "distrito" => "PANAO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100802",
                    "fullubigeo" => "100802 CHAGLLA - PACHITEA - HUÁNUCO",
                    "distrito" => "CHAGLLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100803",
                    "fullubigeo" => "100803 MOLINO - PACHITEA - HUÁNUCO",
                    "distrito" => "MOLINO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100804",
                    "fullubigeo" => "100804 UMARI - PACHITEA - HUÁNUCO",
                    "distrito" => "UMARI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100901",
                    "fullubigeo" => "100901 PUERTO INCA - PUERTO INCA - HUÁNUCO",
                    "distrito" => "PUERTO INCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100902",
                    "fullubigeo" => "100902 CODO DEL POZUZO - PUERTO INCA - HUÁNUCO",
                    "distrito" => "CODO DEL POZUZO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100903",
                    "fullubigeo" => "100903 HONORIA - PUERTO INCA - HUÁNUCO",
                    "distrito" => "HONORIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100904",
                    "fullubigeo" => "100904 TOURNAVISTA - PUERTO INCA - HUÁNUCO",
                    "distrito" => "TOURNAVISTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "100905",
                    "fullubigeo" => "100905 YUYAPICHIS - PUERTO INCA - HUÁNUCO",
                    "distrito" => "YUYAPICHIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101001",
                    "fullubigeo" => "101001 JESUS - LAURICOCHA - HUÁNUCO",
                    "distrito" => "JESUS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101002",
                    "fullubigeo" => "101002 BAÑOS - LAURICOCHA - HUÁNUCO",
                    "distrito" => "BAÑOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101003",
                    "fullubigeo" => "101003 JIVIA - LAURICOCHA - HUÁNUCO",
                    "distrito" => "JIVIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101004",
                    "fullubigeo" => "101004 QUEROPALCA - LAURICOCHA - HUÁNUCO",
                    "distrito" => "QUEROPALCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101005",
                    "fullubigeo" => "101005 RONDOS - LAURICOCHA - HUÁNUCO",
                    "distrito" => "RONDOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101006",
                    "fullubigeo" => "101006 SAN FRANCISCO DE ASIS - LAURICOCHA - HUÁNUCO",
                    "distrito" => "SAN FRANCISCO DE ASIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101007",
                    "fullubigeo" => "101007 SAN MIGUEL DE CAURI - LAURICOCHA - HUÁNUCO",
                    "distrito" => "SAN MIGUEL DE CAURI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101101",
                    "fullubigeo" => "101101 CHAVINILLO - YAROWILCA - HUÁNUCO",
                    "distrito" => "CHAVINILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101102",
                    "fullubigeo" => "101102 CAHUAC - YAROWILCA - HUÁNUCO",
                    "distrito" => "CAHUAC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101103",
                    "fullubigeo" => "101103 CHACABAMBA - YAROWILCA - HUÁNUCO",
                    "distrito" => "CHACABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101104",
                    "fullubigeo" => "101104 APARICIO POMARES - YAROWILCA - HUÁNUCO",
                    "distrito" => "APARICIO POMARES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101105",
                    "fullubigeo" => "101105 JACAS CHICO - YAROWILCA - HUÁNUCO",
                    "distrito" => "JACAS CHICO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101106",
                    "fullubigeo" => "101106 OBAS - YAROWILCA - HUÁNUCO",
                    "distrito" => "OBAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101107",
                    "fullubigeo" => "101107 PAMPAMARCA - YAROWILCA - HUÁNUCO",
                    "distrito" => "PAMPAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "101108",
                    "fullubigeo" => "101108 CHORAS - YAROWILCA - HUÁNUCO",
                    "distrito" => "CHORAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110101",
                    "fullubigeo" => "110101 ICA - ICA - ICA",
                    "distrito" => "ICA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110102",
                    "fullubigeo" => "110102 LA TINGUIÑA - ICA - ICA",
                    "distrito" => "LA TINGUIÑA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110103",
                    "fullubigeo" => "110103 LOS AQUIJES - ICA - ICA",
                    "distrito" => "LOS AQUIJES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110104",
                    "fullubigeo" => "110104 OCUCAJE - ICA - ICA",
                    "distrito" => "OCUCAJE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110105",
                    "fullubigeo" => "110105 PACHACUTEC - ICA - ICA",
                    "distrito" => "PACHACUTEC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110106",
                    "fullubigeo" => "110106 PARCONA - ICA - ICA",
                    "distrito" => "PARCONA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110107",
                    "fullubigeo" => "110107 PUEBLO NUEVO - ICA - ICA",
                    "distrito" => "PUEBLO NUEVO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110108",
                    "fullubigeo" => "110108 SALAS - ICA - ICA",
                    "distrito" => "SALAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110109",
                    "fullubigeo" => "110109 SAN JOSE DE LOS MOLINOS - ICA - ICA",
                    "distrito" => "SAN JOSE DE LOS MOLINOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110110",
                    "fullubigeo" => "110110 SAN JUAN BAUTISTA - ICA - ICA",
                    "distrito" => "SAN JUAN BAUTISTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110111",
                    "fullubigeo" => "110111 SANTIAGO - ICA - ICA",
                    "distrito" => "SANTIAGO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110112",
                    "fullubigeo" => "110112 SUBTANJALLA - ICA - ICA",
                    "distrito" => "SUBTANJALLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110113",
                    "fullubigeo" => "110113 TATE - ICA - ICA",
                    "distrito" => "TATE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110114",
                    "fullubigeo" => "110114 YAUCA DEL ROSARIO - ICA - ICA",
                    "distrito" => "YAUCA DEL ROSARIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110201",
                    "fullubigeo" => "110201 CHINCHA ALTA - CHINCHA - ICA",
                    "distrito" => "CHINCHA ALTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110202",
                    "fullubigeo" => "110202 ALTO LARAN - CHINCHA - ICA",
                    "distrito" => "ALTO LARAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110203",
                    "fullubigeo" => "110203 CHAVIN - CHINCHA - ICA",
                    "distrito" => "CHAVIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110204",
                    "fullubigeo" => "110204 CHINCHA BAJA - CHINCHA - ICA",
                    "distrito" => "CHINCHA BAJA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110205",
                    "fullubigeo" => "110205 EL CARMEN - CHINCHA - ICA",
                    "distrito" => "EL CARMEN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110206",
                    "fullubigeo" => "110206 GROCIO PRADO - CHINCHA - ICA",
                    "distrito" => "GROCIO PRADO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110207",
                    "fullubigeo" => "110207 PUEBLO NUEVO - CHINCHA - ICA",
                    "distrito" => "PUEBLO NUEVO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110208",
                    "fullubigeo" => "110208 SAN JUAN DE YANAC - CHINCHA - ICA",
                    "distrito" => "SAN JUAN DE YANAC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110209",
                    "fullubigeo" => "110209 SAN PEDRO DE HUACARPANA - CHINCHA - ICA",
                    "distrito" => "SAN PEDRO DE HUACARPANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110210",
                    "fullubigeo" => "110210 SUNAMPE - CHINCHA - ICA",
                    "distrito" => "SUNAMPE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110211",
                    "fullubigeo" => "110211 TAMBO DE MORA - CHINCHA - ICA",
                    "distrito" => "TAMBO DE MORA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110301",
                    "fullubigeo" => "110301 NAZCA - NAZCA - ICA",
                    "distrito" => "NAZCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110302",
                    "fullubigeo" => "110302 CHANGUILLO - NAZCA - ICA",
                    "distrito" => "CHANGUILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110303",
                    "fullubigeo" => "110303 EL INGENIO - NAZCA - ICA",
                    "distrito" => "EL INGENIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110304",
                    "fullubigeo" => "110304 MARCONA - NAZCA - ICA",
                    "distrito" => "MARCONA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110305",
                    "fullubigeo" => "110305 VISTA ALEGRE - NAZCA - ICA",
                    "distrito" => "VISTA ALEGRE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110401",
                    "fullubigeo" => "110401 PALPA - PALPA - ICA",
                    "distrito" => "PALPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110402",
                    "fullubigeo" => "110402 LLIPATA - PALPA - ICA",
                    "distrito" => "LLIPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110403",
                    "fullubigeo" => "110403 RIO GRANDE - PALPA - ICA",
                    "distrito" => "RIO GRANDE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110404",
                    "fullubigeo" => "110404 SANTA CRUZ - PALPA - ICA",
                    "distrito" => "SANTA CRUZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110405",
                    "fullubigeo" => "110405 TIBILLO - PALPA - ICA",
                    "distrito" => "TIBILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110501",
                    "fullubigeo" => "110501 PISCO - PISCO - ICA",
                    "distrito" => "PISCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110502",
                    "fullubigeo" => "110502 HUANCANO - PISCO - ICA",
                    "distrito" => "HUANCANO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110503",
                    "fullubigeo" => "110503 HUMAY - PISCO - ICA",
                    "distrito" => "HUMAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110504",
                    "fullubigeo" => "110504 INDEPENDENCIA - PISCO - ICA",
                    "distrito" => "INDEPENDENCIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110505",
                    "fullubigeo" => "110505 PARACAS - PISCO - ICA",
                    "distrito" => "PARACAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110506",
                    "fullubigeo" => "110506 SAN ANDRES - PISCO - ICA",
                    "distrito" => "SAN ANDRES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110507",
                    "fullubigeo" => "110507 SAN CLEMENTE - PISCO - ICA",
                    "distrito" => "SAN CLEMENTE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "110508",
                    "fullubigeo" => "110508 TUPAC AMARU INCA - PISCO - ICA",
                    "distrito" => "TUPAC AMARU INCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120101",
                    "fullubigeo" => "120101 HUANCAYO - HUANCAYO - JUNÍN",
                    "distrito" => "HUANCAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120104",
                    "fullubigeo" => "120104 CARHUACALLANGA - HUANCAYO - JUNÍN",
                    "distrito" => "CARHUACALLANGA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120105",
                    "fullubigeo" => "120105 CHACAPAMPA - HUANCAYO - JUNÍN",
                    "distrito" => "CHACAPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120106",
                    "fullubigeo" => "120106 CHICCHE - HUANCAYO - JUNÍN",
                    "distrito" => "CHICCHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120107",
                    "fullubigeo" => "120107 CHILCA - HUANCAYO - JUNÍN",
                    "distrito" => "CHILCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120108",
                    "fullubigeo" => "120108 CHONGOS ALTO - HUANCAYO - JUNÍN",
                    "distrito" => "CHONGOS ALTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120111",
                    "fullubigeo" => "120111 CHUPURO - HUANCAYO - JUNÍN",
                    "distrito" => "CHUPURO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120112",
                    "fullubigeo" => "120112 COLCA - HUANCAYO - JUNÍN",
                    "distrito" => "COLCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120113",
                    "fullubigeo" => "120113 CULLHUAS - HUANCAYO - JUNÍN",
                    "distrito" => "CULLHUAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120114",
                    "fullubigeo" => "120114 EL TAMBO - HUANCAYO - JUNÍN",
                    "distrito" => "EL TAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120116",
                    "fullubigeo" => "120116 HUACRAPUQUIO - HUANCAYO - JUNÍN",
                    "distrito" => "HUACRAPUQUIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120117",
                    "fullubigeo" => "120117 HUALHUAS - HUANCAYO - JUNÍN",
                    "distrito" => "HUALHUAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120119",
                    "fullubigeo" => "120119 HUANCAN - HUANCAYO - JUNÍN",
                    "distrito" => "HUANCAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120120",
                    "fullubigeo" => "120120 HUASICANCHA - HUANCAYO - JUNÍN",
                    "distrito" => "HUASICANCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120121",
                    "fullubigeo" => "120121 HUAYUCACHI - HUANCAYO - JUNÍN",
                    "distrito" => "HUAYUCACHI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120122",
                    "fullubigeo" => "120122 INGENIO - HUANCAYO - JUNÍN",
                    "distrito" => "INGENIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120124",
                    "fullubigeo" => "120124 PARIAHUANCA - HUANCAYO - JUNÍN",
                    "distrito" => "PARIAHUANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120125",
                    "fullubigeo" => "120125 PILCOMAYO - HUANCAYO - JUNÍN",
                    "distrito" => "PILCOMAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120126",
                    "fullubigeo" => "120126 PUCARA - HUANCAYO - JUNÍN",
                    "distrito" => "PUCARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120127",
                    "fullubigeo" => "120127 QUICHUAY - HUANCAYO - JUNÍN",
                    "distrito" => "QUICHUAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120128",
                    "fullubigeo" => "120128 QUILCAS - HUANCAYO - JUNÍN",
                    "distrito" => "QUILCAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120129",
                    "fullubigeo" => "120129 SAN AGUSTIN - HUANCAYO - JUNÍN",
                    "distrito" => "SAN AGUSTIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120130",
                    "fullubigeo" => "120130 SAN JERONIMO DE TUNAN - HUANCAYO - JUNÍN",
                    "distrito" => "SAN JERONIMO DE TUNAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120132",
                    "fullubigeo" => "120132 SAÑO - HUANCAYO - JUNÍN",
                    "distrito" => "SAÑO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120133",
                    "fullubigeo" => "120133 SAPALLANGA - HUANCAYO - JUNÍN",
                    "distrito" => "SAPALLANGA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120134",
                    "fullubigeo" => "120134 SICAYA - HUANCAYO - JUNÍN",
                    "distrito" => "SICAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120135",
                    "fullubigeo" => "120135 SANTO DOMINGO DE ACOBAMBA - HUANCAYO - JUNÍN",
                    "distrito" => "SANTO DOMINGO DE ACOBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120136",
                    "fullubigeo" => "120136 VIQUES - HUANCAYO - JUNÍN",
                    "distrito" => "VIQUES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120201",
                    "fullubigeo" => "120201 CONCEPCION - CONCEPCION - JUNÍN",
                    "distrito" => "CONCEPCION", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120202",
                    "fullubigeo" => "120202 ACO - CONCEPCION - JUNÍN",
                    "distrito" => "ACO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120203",
                    "fullubigeo" => "120203 ANDAMARCA - CONCEPCION - JUNÍN",
                    "distrito" => "ANDAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120204",
                    "fullubigeo" => "120204 CHAMBARA - CONCEPCION - JUNÍN",
                    "distrito" => "CHAMBARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120205",
                    "fullubigeo" => "120205 COCHAS - CONCEPCION - JUNÍN",
                    "distrito" => "COCHAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120206",
                    "fullubigeo" => "120206 COMAS - CONCEPCION - JUNÍN",
                    "distrito" => "COMAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120207",
                    "fullubigeo" => "120207 HEROINAS TOLEDO - CONCEPCION - JUNÍN",
                    "distrito" => "HEROINAS TOLEDO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120208",
                    "fullubigeo" => "120208 MANZANARES - CONCEPCION - JUNÍN",
                    "distrito" => "MANZANARES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120209",
                    "fullubigeo" => "120209 MARISCAL CASTILLA - CONCEPCION - JUNÍN",
                    "distrito" => "MARISCAL CASTILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120210",
                    "fullubigeo" => "120210 MATAHUASI - CONCEPCION - JUNÍN",
                    "distrito" => "MATAHUASI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120211",
                    "fullubigeo" => "120211 MITO - CONCEPCION - JUNÍN",
                    "distrito" => "MITO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120212",
                    "fullubigeo" => "120212 NUEVE DE JULIO - CONCEPCION - JUNÍN",
                    "distrito" => "NUEVE DE JULIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120213",
                    "fullubigeo" => "120213 ORCOTUNA - CONCEPCION - JUNÍN",
                    "distrito" => "ORCOTUNA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120214",
                    "fullubigeo" => "120214 SAN JOSE DE QUERO - CONCEPCION - JUNÍN",
                    "distrito" => "SAN JOSE DE QUERO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120215",
                    "fullubigeo" => "120215 SANTA ROSA DE OCOPA - CONCEPCION - JUNÍN",
                    "distrito" => "SANTA ROSA DE OCOPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120301",
                    "fullubigeo" => "120301 CHANCHAMAYO - CHANCHAMAYO - JUNÍN",
                    "distrito" => "CHANCHAMAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120302",
                    "fullubigeo" => "120302 PERENE - CHANCHAMAYO - JUNÍN",
                    "distrito" => "PERENE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120303",
                    "fullubigeo" => "120303 PICHANAQUI - CHANCHAMAYO - JUNÍN",
                    "distrito" => "PICHANAQUI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120304",
                    "fullubigeo" => "120304 SAN LUIS DE SHUARO - CHANCHAMAYO - JUNÍN",
                    "distrito" => "SAN LUIS DE SHUARO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120305",
                    "fullubigeo" => "120305 SAN RAMON - CHANCHAMAYO - JUNÍN",
                    "distrito" => "SAN RAMON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120306",
                    "fullubigeo" => "120306 VITOC - CHANCHAMAYO - JUNÍN",
                    "distrito" => "VITOC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120401",
                    "fullubigeo" => "120401 JAUJA - JAUJA - JUNÍN",
                    "distrito" => "JAUJA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120402",
                    "fullubigeo" => "120402 ACOLLA - JAUJA - JUNÍN",
                    "distrito" => "ACOLLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120403",
                    "fullubigeo" => "120403 APATA - JAUJA - JUNÍN",
                    "distrito" => "APATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120404",
                    "fullubigeo" => "120404 ATAURA - JAUJA - JUNÍN",
                    "distrito" => "ATAURA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120405",
                    "fullubigeo" => "120405 CANCHAYLLO - JAUJA - JUNÍN",
                    "distrito" => "CANCHAYLLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120406",
                    "fullubigeo" => "120406 CURICACA - JAUJA - JUNÍN",
                    "distrito" => "CURICACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120407",
                    "fullubigeo" => "120407 EL MANTARO - JAUJA - JUNÍN",
                    "distrito" => "EL MANTARO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120408",
                    "fullubigeo" => "120408 HUAMALI - JAUJA - JUNÍN",
                    "distrito" => "HUAMALI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120409",
                    "fullubigeo" => "120409 HUARIPAMPA - JAUJA - JUNÍN",
                    "distrito" => "HUARIPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120410",
                    "fullubigeo" => "120410 HUERTAS - JAUJA - JUNÍN",
                    "distrito" => "HUERTAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120411",
                    "fullubigeo" => "120411 JANJAILLO - JAUJA - JUNÍN",
                    "distrito" => "JANJAILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120412",
                    "fullubigeo" => "120412 JULCAN - JAUJA - JUNÍN",
                    "distrito" => "JULCAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120413",
                    "fullubigeo" => "120413 LEONOR ORDOÑEZ - JAUJA - JUNÍN",
                    "distrito" => "LEONOR ORDOÑEZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120414",
                    "fullubigeo" => "120414 LLOCLLAPAMPA - JAUJA - JUNÍN",
                    "distrito" => "LLOCLLAPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120415",
                    "fullubigeo" => "120415 MARCO - JAUJA - JUNÍN",
                    "distrito" => "MARCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120416",
                    "fullubigeo" => "120416 MASMA - JAUJA - JUNÍN",
                    "distrito" => "MASMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120417",
                    "fullubigeo" => "120417 MASMA CHICCHE - JAUJA - JUNÍN",
                    "distrito" => "MASMA CHICCHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120418",
                    "fullubigeo" => "120418 MOLINOS - JAUJA - JUNÍN",
                    "distrito" => "MOLINOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120419",
                    "fullubigeo" => "120419 MONOBAMBA - JAUJA - JUNÍN",
                    "distrito" => "MONOBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120420",
                    "fullubigeo" => "120420 MUQUI - JAUJA - JUNÍN",
                    "distrito" => "MUQUI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120421",
                    "fullubigeo" => "120421 MUQUIYAUYO - JAUJA - JUNÍN",
                    "distrito" => "MUQUIYAUYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120422",
                    "fullubigeo" => "120422 PACA - JAUJA - JUNÍN",
                    "distrito" => "PACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120423",
                    "fullubigeo" => "120423 PACCHA - JAUJA - JUNÍN",
                    "distrito" => "PACCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120424",
                    "fullubigeo" => "120424 PANCAN - JAUJA - JUNÍN",
                    "distrito" => "PANCAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120425",
                    "fullubigeo" => "120425 PARCO - JAUJA - JUNÍN",
                    "distrito" => "PARCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120426",
                    "fullubigeo" => "120426 POMACANCHA - JAUJA - JUNÍN",
                    "distrito" => "POMACANCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120427",
                    "fullubigeo" => "120427 RICRAN - JAUJA - JUNÍN",
                    "distrito" => "RICRAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120428",
                    "fullubigeo" => "120428 SAN LORENZO - JAUJA - JUNÍN",
                    "distrito" => "SAN LORENZO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120429",
                    "fullubigeo" => "120429 SAN PEDRO DE CHUNAN - JAUJA - JUNÍN",
                    "distrito" => "SAN PEDRO DE CHUNAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120430",
                    "fullubigeo" => "120430 SAUSA - JAUJA - JUNÍN",
                    "distrito" => "SAUSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120431",
                    "fullubigeo" => "120431 SINCOS - JAUJA - JUNÍN",
                    "distrito" => "SINCOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120432",
                    "fullubigeo" => "120432 TUNAN MARCA - JAUJA - JUNÍN",
                    "distrito" => "TUNAN MARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120433",
                    "fullubigeo" => "120433 YAULI - JAUJA - JUNÍN",
                    "distrito" => "YAULI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120434",
                    "fullubigeo" => "120434 YAUYOS - JAUJA - JUNÍN",
                    "distrito" => "YAUYOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120501",
                    "fullubigeo" => "120501 JUNIN - JUNIN - JUNÍN",
                    "distrito" => "JUNIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120502",
                    "fullubigeo" => "120502 CARHUAMAYO - JUNIN - JUNÍN",
                    "distrito" => "CARHUAMAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120503",
                    "fullubigeo" => "120503 ONDORES - JUNIN - JUNÍN",
                    "distrito" => "ONDORES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120504",
                    "fullubigeo" => "120504 ULCUMAYO - JUNIN - JUNÍN",
                    "distrito" => "ULCUMAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120601",
                    "fullubigeo" => "120601 SATIPO - SATIPO - JUNÍN",
                    "distrito" => "SATIPO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120602",
                    "fullubigeo" => "120602 COVIRIALI - SATIPO - JUNÍN",
                    "distrito" => "COVIRIALI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120603",
                    "fullubigeo" => "120603 LLAYLLA - SATIPO - JUNÍN",
                    "distrito" => "LLAYLLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120604",
                    "fullubigeo" => "120604 MAZAMARI - SATIPO - JUNÍN",
                    "distrito" => "MAZAMARI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120605",
                    "fullubigeo" => "120605 PAMPA HERMOSA - SATIPO - JUNÍN",
                    "distrito" => "PAMPA HERMOSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120606",
                    "fullubigeo" => "120606 PANGOA - SATIPO - JUNÍN",
                    "distrito" => "PANGOA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120607",
                    "fullubigeo" => "120607 RIO NEGRO - SATIPO - JUNÍN",
                    "distrito" => "RIO NEGRO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120608",
                    "fullubigeo" => "120608 RIO TAMBO - SATIPO - JUNÍN",
                    "distrito" => "RIO TAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120701",
                    "fullubigeo" => "120701 TARMA - TARMA - JUNÍN",
                    "distrito" => "TARMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120702",
                    "fullubigeo" => "120702 ACOBAMBA - TARMA - JUNÍN",
                    "distrito" => "ACOBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120703",
                    "fullubigeo" => "120703 HUARICOLCA - TARMA - JUNÍN",
                    "distrito" => "HUARICOLCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120704",
                    "fullubigeo" => "120704 HUASAHUASI - TARMA - JUNÍN",
                    "distrito" => "HUASAHUASI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120705",
                    "fullubigeo" => "120705 LA UNION - TARMA - JUNÍN",
                    "distrito" => "LA UNION", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120706",
                    "fullubigeo" => "120706 PALCA - TARMA - JUNÍN",
                    "distrito" => "PALCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120707",
                    "fullubigeo" => "120707 PALCAMAYO - TARMA - JUNÍN",
                    "distrito" => "PALCAMAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120708",
                    "fullubigeo" => "120708 SAN PEDRO DE CAJAS - TARMA - JUNÍN",
                    "distrito" => "SAN PEDRO DE CAJAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120709",
                    "fullubigeo" => "120709 TAPO - TARMA - JUNÍN",
                    "distrito" => "TAPO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120801",
                    "fullubigeo" => "120801 LA OROYA - YAULI - JUNÍN",
                    "distrito" => "LA OROYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120802",
                    "fullubigeo" => "120802 CHACAPALPA - YAULI - JUNÍN",
                    "distrito" => "CHACAPALPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120803",
                    "fullubigeo" => "120803 HUAY-HUAY - YAULI - JUNÍN",
                    "distrito" => "HUAY-HUAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120804",
                    "fullubigeo" => "120804 MARCAPOMACOCHA - YAULI - JUNÍN",
                    "distrito" => "MARCAPOMACOCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120805",
                    "fullubigeo" => "120805 MOROCOCHA - YAULI - JUNÍN",
                    "distrito" => "MOROCOCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120806",
                    "fullubigeo" => "120806 PACCHA - YAULI - JUNÍN",
                    "distrito" => "PACCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120807",
                    "fullubigeo" => "120807 SANTA BARBARA DE CARHUACAY - YAULI - JUNÍN",
                    "distrito" => "SANTA BARBARA DE CARHUACAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120808",
                    "fullubigeo" => "120808 SANTA ROSA DE SACCO - YAULI - JUNÍN",
                    "distrito" => "SANTA ROSA DE SACCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120809",
                    "fullubigeo" => "120809 SUITUCANCHA - YAULI - JUNÍN",
                    "distrito" => "SUITUCANCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120810",
                    "fullubigeo" => "120810 YAULI - YAULI - JUNÍN",
                    "distrito" => "YAULI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120901",
                    "fullubigeo" => "120901 CHUPACA - CHUPACA - JUNÍN",
                    "distrito" => "CHUPACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120902",
                    "fullubigeo" => "120902 AHUAC - CHUPACA - JUNÍN",
                    "distrito" => "AHUAC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120903",
                    "fullubigeo" => "120903 CHONGOS BAJO - CHUPACA - JUNÍN",
                    "distrito" => "CHONGOS BAJO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120904",
                    "fullubigeo" => "120904 HUACHAC - CHUPACA - JUNÍN",
                    "distrito" => "HUACHAC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120905",
                    "fullubigeo" => "120905 HUAMANCACA CHICO - CHUPACA - JUNÍN",
                    "distrito" => "HUAMANCACA CHICO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120906",
                    "fullubigeo" => "120906 SAN JUAN DE ISCOS - CHUPACA - JUNÍN",
                    "distrito" => "SAN JUAN DE ISCOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120907",
                    "fullubigeo" => "120907 SAN JUAN DE JARPA - CHUPACA - JUNÍN",
                    "distrito" => "SAN JUAN DE JARPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120908",
                    "fullubigeo" => "120908 TRES DE DICIEMBRE - CHUPACA - JUNÍN",
                    "distrito" => "TRES DE DICIEMBRE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "120909",
                    "fullubigeo" => "120909 YANACANCHA - CHUPACA - JUNÍN",
                    "distrito" => "YANACANCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130101",
                    "fullubigeo" => "130101 TRUJILLO - TRUJILLO - LA LIBERTAD",
                    "distrito" => "TRUJILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130102",
                    "fullubigeo" => "130102 EL PORVENIR - TRUJILLO - LA LIBERTAD",
                    "distrito" => "EL PORVENIR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130103",
                    "fullubigeo" => "130103 FLORENCIA DE MORA - TRUJILLO - LA LIBERTAD",
                    "distrito" => "FLORENCIA DE MORA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130104",
                    "fullubigeo" => "130104 HUANCHACO - TRUJILLO - LA LIBERTAD",
                    "distrito" => "HUANCHACO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130105",
                    "fullubigeo" => "130105 LA ESPERANZA - TRUJILLO - LA LIBERTAD",
                    "distrito" => "LA ESPERANZA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130106",
                    "fullubigeo" => "130106 LAREDO - TRUJILLO - LA LIBERTAD",
                    "distrito" => "LAREDO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130107",
                    "fullubigeo" => "130107 MOCHE - TRUJILLO - LA LIBERTAD",
                    "distrito" => "MOCHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130108",
                    "fullubigeo" => "130108 POROTO - TRUJILLO - LA LIBERTAD",
                    "distrito" => "POROTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130109",
                    "fullubigeo" => "130109 SALAVERRY - TRUJILLO - LA LIBERTAD",
                    "distrito" => "SALAVERRY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130110",
                    "fullubigeo" => "130110 SIMBAL - TRUJILLO - LA LIBERTAD",
                    "distrito" => "SIMBAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130111",
                    "fullubigeo" => "130111 VICTOR LARCO HERRERA - TRUJILLO - LA LIBERTAD",
                    "distrito" => "VICTOR LARCO HERRERA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130201",
                    "fullubigeo" => "130201 ASCOPE - ASCOPE - LA LIBERTAD",
                    "distrito" => "ASCOPE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130202",
                    "fullubigeo" => "130202 CHICAMA - ASCOPE - LA LIBERTAD",
                    "distrito" => "CHICAMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130203",
                    "fullubigeo" => "130203 CHOCOPE - ASCOPE - LA LIBERTAD",
                    "distrito" => "CHOCOPE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130204",
                    "fullubigeo" => "130204 MAGDALENA DE CAO - ASCOPE - LA LIBERTAD",
                    "distrito" => "MAGDALENA DE CAO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130205",
                    "fullubigeo" => "130205 PAIJAN - ASCOPE - LA LIBERTAD",
                    "distrito" => "PAIJAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130206",
                    "fullubigeo" => "130206 RAZURI - ASCOPE - LA LIBERTAD",
                    "distrito" => "RAZURI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130207",
                    "fullubigeo" => "130207 SANTIAGO DE CAO - ASCOPE - LA LIBERTAD",
                    "distrito" => "SANTIAGO DE CAO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130208",
                    "fullubigeo" => "130208 CASA GRANDE - ASCOPE - LA LIBERTAD",
                    "distrito" => "CASA GRANDE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130301",
                    "fullubigeo" => "130301 BOLIVAR - BOLIVAR - LA LIBERTAD",
                    "distrito" => "BOLIVAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130302",
                    "fullubigeo" => "130302 BAMBAMARCA - BOLIVAR - LA LIBERTAD",
                    "distrito" => "BAMBAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130303",
                    "fullubigeo" => "130303 CONDORMARCA - BOLIVAR - LA LIBERTAD",
                    "distrito" => "CONDORMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130304",
                    "fullubigeo" => "130304 LONGOTEA - BOLIVAR - LA LIBERTAD",
                    "distrito" => "LONGOTEA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130305",
                    "fullubigeo" => "130305 UCHUMARCA - BOLIVAR - LA LIBERTAD",
                    "distrito" => "UCHUMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130306",
                    "fullubigeo" => "130306 UCUNCHA - BOLIVAR - LA LIBERTAD",
                    "distrito" => "UCUNCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130401",
                    "fullubigeo" => "130401 CHEPEN - CHEPEN - LA LIBERTAD",
                    "distrito" => "CHEPEN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130402",
                    "fullubigeo" => "130402 PACANGA - CHEPEN - LA LIBERTAD",
                    "distrito" => "PACANGA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130403",
                    "fullubigeo" => "130403 PUEBLO NUEVO - CHEPEN - LA LIBERTAD",
                    "distrito" => "PUEBLO NUEVO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130501",
                    "fullubigeo" => "130501 JULCAN - JULCAN - LA LIBERTAD",
                    "distrito" => "JULCAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130502",
                    "fullubigeo" => "130502 CALAMARCA - JULCAN - LA LIBERTAD",
                    "distrito" => "CALAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130503",
                    "fullubigeo" => "130503 CARABAMBA - JULCAN - LA LIBERTAD",
                    "distrito" => "CARABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130504",
                    "fullubigeo" => "130504 HUASO - JULCAN - LA LIBERTAD",
                    "distrito" => "HUASO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130601",
                    "fullubigeo" => "130601 OTUZCO - OTUZCO - LA LIBERTAD",
                    "distrito" => "OTUZCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130602",
                    "fullubigeo" => "130602 AGALLPAMPA - OTUZCO - LA LIBERTAD",
                    "distrito" => "AGALLPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130604",
                    "fullubigeo" => "130604 CHARAT - OTUZCO - LA LIBERTAD",
                    "distrito" => "CHARAT", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130605",
                    "fullubigeo" => "130605 HUARANCHAL - OTUZCO - LA LIBERTAD",
                    "distrito" => "HUARANCHAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130606",
                    "fullubigeo" => "130606 LA CUESTA - OTUZCO - LA LIBERTAD",
                    "distrito" => "LA CUESTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130608",
                    "fullubigeo" => "130608 MACHE - OTUZCO - LA LIBERTAD",
                    "distrito" => "MACHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130610",
                    "fullubigeo" => "130610 PARANDAY - OTUZCO - LA LIBERTAD",
                    "distrito" => "PARANDAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130611",
                    "fullubigeo" => "130611 SALPO - OTUZCO - LA LIBERTAD",
                    "distrito" => "SALPO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130613",
                    "fullubigeo" => "130613 SINSICAP - OTUZCO - LA LIBERTAD",
                    "distrito" => "SINSICAP", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130614",
                    "fullubigeo" => "130614 USQUIL - OTUZCO - LA LIBERTAD",
                    "distrito" => "USQUIL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130701",
                    "fullubigeo" => "130701 SAN PEDRO DE LLOC - PACASMAYO - LA LIBERTAD",
                    "distrito" => "SAN PEDRO DE LLOC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130702",
                    "fullubigeo" => "130702 GUADALUPE - PACASMAYO - LA LIBERTAD",
                    "distrito" => "GUADALUPE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130703",
                    "fullubigeo" => "130703 JEQUETEPEQUE - PACASMAYO - LA LIBERTAD",
                    "distrito" => "JEQUETEPEQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130704",
                    "fullubigeo" => "130704 PACASMAYO - PACASMAYO - LA LIBERTAD",
                    "distrito" => "PACASMAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130705",
                    "fullubigeo" => "130705 SAN JOSE - PACASMAYO - LA LIBERTAD",
                    "distrito" => "SAN JOSE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130801",
                    "fullubigeo" => "130801 TAYABAMBA - PATAZ - LA LIBERTAD",
                    "distrito" => "TAYABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130802",
                    "fullubigeo" => "130802 BULDIBUYO - PATAZ - LA LIBERTAD",
                    "distrito" => "BULDIBUYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130803",
                    "fullubigeo" => "130803 CHILLIA - PATAZ - LA LIBERTAD",
                    "distrito" => "CHILLIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130804",
                    "fullubigeo" => "130804 HUANCASPATA - PATAZ - LA LIBERTAD",
                    "distrito" => "HUANCASPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130805",
                    "fullubigeo" => "130805 HUAYLILLAS - PATAZ - LA LIBERTAD",
                    "distrito" => "HUAYLILLAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130806",
                    "fullubigeo" => "130806 HUAYO - PATAZ - LA LIBERTAD",
                    "distrito" => "HUAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130807",
                    "fullubigeo" => "130807 ONGON - PATAZ - LA LIBERTAD",
                    "distrito" => "ONGON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130808",
                    "fullubigeo" => "130808 PARCOY - PATAZ - LA LIBERTAD",
                    "distrito" => "PARCOY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130809",
                    "fullubigeo" => "130809 PATAZ - PATAZ - LA LIBERTAD",
                    "distrito" => "PATAZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130810",
                    "fullubigeo" => "130810 PIAS - PATAZ - LA LIBERTAD",
                    "distrito" => "PIAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130811",
                    "fullubigeo" => "130811 SANTIAGO DE CHALLAS - PATAZ - LA LIBERTAD",
                    "distrito" => "SANTIAGO DE CHALLAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130812",
                    "fullubigeo" => "130812 TAURIJA - PATAZ - LA LIBERTAD",
                    "distrito" => "TAURIJA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130813",
                    "fullubigeo" => "130813 URPAY - PATAZ - LA LIBERTAD",
                    "distrito" => "URPAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130901",
                    "fullubigeo" => "130901 HUAMACHUCO - SANCHEZ CARRION - LA LIBERTAD",
                    "distrito" => "HUAMACHUCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130902",
                    "fullubigeo" => "130902 CHUGAY - SANCHEZ CARRION - LA LIBERTAD",
                    "distrito" => "CHUGAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130903",
                    "fullubigeo" => "130903 COCHORCO - SANCHEZ CARRION - LA LIBERTAD",
                    "distrito" => "COCHORCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130904",
                    "fullubigeo" => "130904 CURGOS - SANCHEZ CARRION - LA LIBERTAD",
                    "distrito" => "CURGOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130905",
                    "fullubigeo" => "130905 MARCABAL - SANCHEZ CARRION - LA LIBERTAD",
                    "distrito" => "MARCABAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130906",
                    "fullubigeo" => "130906 SANAGORAN - SANCHEZ CARRION - LA LIBERTAD",
                    "distrito" => "SANAGORAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130907",
                    "fullubigeo" => "130907 SARIN - SANCHEZ CARRION - LA LIBERTAD",
                    "distrito" => "SARIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "130908",
                    "fullubigeo" => "130908 SARTIMBAMBA - SANCHEZ CARRION - LA LIBERTAD",
                    "distrito" => "SARTIMBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131001",
                    "fullubigeo" => "131001 SANTIAGO DE CHUCO - SANTIAGO DE CHUCO - LA LIBERTAD",
                    "distrito" => "SANTIAGO DE CHUCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131002",
                    "fullubigeo" => "131002 ANGASMARCA - SANTIAGO DE CHUCO - LA LIBERTAD",
                    "distrito" => "ANGASMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131003",
                    "fullubigeo" => "131003 CACHICADAN - SANTIAGO DE CHUCO - LA LIBERTAD",
                    "distrito" => "CACHICADAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131004",
                    "fullubigeo" => "131004 MOLLEBAMBA - SANTIAGO DE CHUCO - LA LIBERTAD",
                    "distrito" => "MOLLEBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131005",
                    "fullubigeo" => "131005 MOLLEPATA - SANTIAGO DE CHUCO - LA LIBERTAD",
                    "distrito" => "MOLLEPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131006",
                    "fullubigeo" => "131006 QUIRUVILCA - SANTIAGO DE CHUCO - LA LIBERTAD",
                    "distrito" => "QUIRUVILCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131007",
                    "fullubigeo" => "131007 SANTA CRUZ DE CHUCA - SANTIAGO DE CHUCO - LA LIBERTAD",
                    "distrito" => "SANTA CRUZ DE CHUCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131008",
                    "fullubigeo" => "131008 SITABAMBA - SANTIAGO DE CHUCO - LA LIBERTAD",
                    "distrito" => "SITABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131101",
                    "fullubigeo" => "131101 CASCAS - GRAN CHIMU - LA LIBERTAD",
                    "distrito" => "CASCAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131102",
                    "fullubigeo" => "131102 LUCMA - GRAN CHIMU - LA LIBERTAD",
                    "distrito" => "LUCMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131103",
                    "fullubigeo" => "131103 COMPIN - GRAN CHIMU - LA LIBERTAD",
                    "distrito" => "COMPIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131104",
                    "fullubigeo" => "131104 SAYAPULLO - GRAN CHIMU - LA LIBERTAD",
                    "distrito" => "SAYAPULLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131201",
                    "fullubigeo" => "131201 VIRU - VIRU - LA LIBERTAD",
                    "distrito" => "VIRU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131202",
                    "fullubigeo" => "131202 CHAO - VIRU - LA LIBERTAD",
                    "distrito" => "CHAO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "131203",
                    "fullubigeo" => "131203 GUADALUPITO - VIRU - LA LIBERTAD",
                    "distrito" => "GUADALUPITO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140101",
                    "fullubigeo" => "140101 CHICLAYO - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "CHICLAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140102",
                    "fullubigeo" => "140102 CHONGOYAPE - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "CHONGOYAPE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140103",
                    "fullubigeo" => "140103 ETEN - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "ETEN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140104",
                    "fullubigeo" => "140104 ETEN PUERTO - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "ETEN PUERTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140105",
                    "fullubigeo" => "140105 JOSE LEONARDO ORTIZ - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "JOSE LEONARDO ORTIZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140106",
                    "fullubigeo" => "140106 LA VICTORIA - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "LA VICTORIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140107",
                    "fullubigeo" => "140107 LAGUNAS - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "LAGUNAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140108",
                    "fullubigeo" => "140108 MONSEFU - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "MONSEFU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140109",
                    "fullubigeo" => "140109 NUEVA ARICA - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "NUEVA ARICA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140110",
                    "fullubigeo" => "140110 OYOTUN - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "OYOTUN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140111",
                    "fullubigeo" => "140111 PICSI - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "PICSI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140112",
                    "fullubigeo" => "140112 PIMENTEL - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "PIMENTEL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140113",
                    "fullubigeo" => "140113 REQUE - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "REQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140114",
                    "fullubigeo" => "140114 SANTA ROSA - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "SANTA ROSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140115",
                    "fullubigeo" => "140115 SAÑA - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "SAÑA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140116",
                    "fullubigeo" => "140116 CAYALTI - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "CAYALTI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140117",
                    "fullubigeo" => "140117 PATAPO - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "PATAPO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140118",
                    "fullubigeo" => "140118 POMALCA - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "POMALCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140119",
                    "fullubigeo" => "140119 PUCALA - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "PUCALA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140120",
                    "fullubigeo" => "140120 TUMAN - CHICLAYO - LAMBAYEQUE",
                    "distrito" => "TUMAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140201",
                    "fullubigeo" => "140201 FERREÑAFE - FERREÑAFE - LAMBAYEQUE",
                    "distrito" => "FERREÑAFE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140202",
                    "fullubigeo" => "140202 CAÑARIS - FERREÑAFE - LAMBAYEQUE",
                    "distrito" => "CAÑARIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140203",
                    "fullubigeo" => "140203 INCAHUASI - FERREÑAFE - LAMBAYEQUE",
                    "distrito" => "INCAHUASI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140204",
                    "fullubigeo" => "140204 MANUEL ANTONIO MESONES MURO - FERREÑAFE - LAMBAYEQUE",
                    "distrito" => "MANUEL ANTONIO MESONES MURO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140205",
                    "fullubigeo" => "140205 PITIPO - FERREÑAFE - LAMBAYEQUE",
                    "distrito" => "PITIPO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140206",
                    "fullubigeo" => "140206 PUEBLO NUEVO - FERREÑAFE - LAMBAYEQUE",
                    "distrito" => "PUEBLO NUEVO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140301",
                    "fullubigeo" => "140301 LAMBAYEQUE - LAMBAYEQUE - LAMBAYEQUE",
                    "distrito" => "LAMBAYEQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140302",
                    "fullubigeo" => "140302 CHOCHOPE - LAMBAYEQUE - LAMBAYEQUE",
                    "distrito" => "CHOCHOPE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140303",
                    "fullubigeo" => "140303 ILLIMO - LAMBAYEQUE - LAMBAYEQUE",
                    "distrito" => "ILLIMO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140304",
                    "fullubigeo" => "140304 JAYANCA - LAMBAYEQUE - LAMBAYEQUE",
                    "distrito" => "JAYANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140305",
                    "fullubigeo" => "140305 MOCHUMI - LAMBAYEQUE - LAMBAYEQUE",
                    "distrito" => "MOCHUMI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140306",
                    "fullubigeo" => "140306 MORROPE - LAMBAYEQUE - LAMBAYEQUE",
                    "distrito" => "MORROPE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140307",
                    "fullubigeo" => "140307 MOTUPE - LAMBAYEQUE - LAMBAYEQUE",
                    "distrito" => "MOTUPE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140308",
                    "fullubigeo" => "140308 OLMOS - LAMBAYEQUE - LAMBAYEQUE",
                    "distrito" => "OLMOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140309",
                    "fullubigeo" => "140309 PACORA - LAMBAYEQUE - LAMBAYEQUE",
                    "distrito" => "PACORA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140310",
                    "fullubigeo" => "140310 SALAS - LAMBAYEQUE - LAMBAYEQUE",
                    "distrito" => "SALAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140311",
                    "fullubigeo" => "140311 SAN JOSE - LAMBAYEQUE - LAMBAYEQUE",
                    "distrito" => "SAN JOSE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "140312",
                    "fullubigeo" => "140312 TUCUME - LAMBAYEQUE - LAMBAYEQUE",
                    "distrito" => "TUCUME", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150101",
                    "fullubigeo" => "150101 LIMA - LIMA - LIMA",
                    "distrito" => "LIMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150102",
                    "fullubigeo" => "150102 ANCON - LIMA - LIMA",
                    "distrito" => "ANCON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150103",
                    "fullubigeo" => "150103 ATE - LIMA - LIMA",
                    "distrito" => "ATE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150104",
                    "fullubigeo" => "150104 BARRANCO - LIMA - LIMA",
                    "distrito" => "BARRANCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150105",
                    "fullubigeo" => "150105 BREÑA - LIMA - LIMA",
                    "distrito" => "BREÑA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150106",
                    "fullubigeo" => "150106 CARABAYLLO - LIMA - LIMA",
                    "distrito" => "CARABAYLLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150107",
                    "fullubigeo" => "150107 CHACLACAYO - LIMA - LIMA",
                    "distrito" => "CHACLACAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150108",
                    "fullubigeo" => "150108 CHORRILLOS - LIMA - LIMA",
                    "distrito" => "CHORRILLOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150109",
                    "fullubigeo" => "150109 CIENEGUILLA - LIMA - LIMA",
                    "distrito" => "CIENEGUILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150110",
                    "fullubigeo" => "150110 COMAS - LIMA - LIMA",
                    "distrito" => "COMAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150111",
                    "fullubigeo" => "150111 EL AGUSTINO - LIMA - LIMA",
                    "distrito" => "EL AGUSTINO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150112",
                    "fullubigeo" => "150112 INDEPENDENCIA - LIMA - LIMA",
                    "distrito" => "INDEPENDENCIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150113",
                    "fullubigeo" => "150113 JESUS MARIA - LIMA - LIMA",
                    "distrito" => "JESUS MARIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150114",
                    "fullubigeo" => "150114 LA MOLINA - LIMA - LIMA",
                    "distrito" => "LA MOLINA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150115",
                    "fullubigeo" => "150115 LA VICTORIA - LIMA - LIMA",
                    "distrito" => "LA VICTORIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150116",
                    "fullubigeo" => "150116 LINCE - LIMA - LIMA",
                    "distrito" => "LINCE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150117",
                    "fullubigeo" => "150117 LOS OLIVOS - LIMA - LIMA",
                    "distrito" => "LOS OLIVOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150118",
                    "fullubigeo" => "150118 LURIGANCHO - LIMA - LIMA",
                    "distrito" => "LURIGANCHO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150119",
                    "fullubigeo" => "150119 LURIN - LIMA - LIMA",
                    "distrito" => "LURIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150120",
                    "fullubigeo" => "150120 MAGDALENA DEL MAR - LIMA - LIMA",
                    "distrito" => "MAGDALENA DEL MAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150121",
                    "fullubigeo" => "150121 PUEBLO LIBRE - LIMA - LIMA",
                    "distrito" => "PUEBLO LIBRE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150122",
                    "fullubigeo" => "150122 MIRAFLORES - LIMA - LIMA",
                    "distrito" => "MIRAFLORES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150123",
                    "fullubigeo" => "150123 PACHACAMAC - LIMA - LIMA",
                    "distrito" => "PACHACAMAC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150124",
                    "fullubigeo" => "150124 PUCUSANA - LIMA - LIMA",
                    "distrito" => "PUCUSANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150125",
                    "fullubigeo" => "150125 PUENTE PIEDRA - LIMA - LIMA",
                    "distrito" => "PUENTE PIEDRA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150126",
                    "fullubigeo" => "150126 PUNTA HERMOSA - LIMA - LIMA",
                    "distrito" => "PUNTA HERMOSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150127",
                    "fullubigeo" => "150127 PUNTA NEGRA - LIMA - LIMA",
                    "distrito" => "PUNTA NEGRA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150128",
                    "fullubigeo" => "150128 RIMAC - LIMA - LIMA",
                    "distrito" => "RIMAC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150129",
                    "fullubigeo" => "150129 SAN BARTOLO - LIMA - LIMA",
                    "distrito" => "SAN BARTOLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150130",
                    "fullubigeo" => "150130 SAN BORJA - LIMA - LIMA",
                    "distrito" => "SAN BORJA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150131",
                    "fullubigeo" => "150131 SAN ISIDRO - LIMA - LIMA",
                    "distrito" => "SAN ISIDRO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150132",
                    "fullubigeo" => "150132 SAN JUAN DE LURIGANCHO - LIMA - LIMA",
                    "distrito" => "SAN JUAN DE LURIGANCHO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150133",
                    "fullubigeo" => "150133 SAN JUAN DE MIRAFLORES - LIMA - LIMA",
                    "distrito" => "SAN JUAN DE MIRAFLORES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150134",
                    "fullubigeo" => "150134 SAN LUIS - LIMA - LIMA",
                    "distrito" => "SAN LUIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150135",
                    "fullubigeo" => "150135 SAN MARTIN DE PORRES - LIMA - LIMA",
                    "distrito" => "SAN MARTIN DE PORRES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150136",
                    "fullubigeo" => "150136 SAN MIGUEL - LIMA - LIMA",
                    "distrito" => "SAN MIGUEL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150137",
                    "fullubigeo" => "150137 SANTA ANITA - LIMA - LIMA",
                    "distrito" => "SANTA ANITA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150138",
                    "fullubigeo" => "150138 SANTA MARIA DEL MAR - LIMA - LIMA",
                    "distrito" => "SANTA MARIA DEL MAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150139",
                    "fullubigeo" => "150139 SANTA ROSA - LIMA - LIMA",
                    "distrito" => "SANTA ROSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150140",
                    "fullubigeo" => "150140 SANTIAGO DE SURCO - LIMA - LIMA",
                    "distrito" => "SANTIAGO DE SURCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150141",
                    "fullubigeo" => "150141 SURQUILLO - LIMA - LIMA",
                    "distrito" => "SURQUILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150142",
                    "fullubigeo" => "150142 VILLA EL SALVADOR - LIMA - LIMA",
                    "distrito" => "VILLA EL SALVADOR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150143",
                    "fullubigeo" => "150143 VILLA MARIA DEL TRIUNFO - LIMA - LIMA",
                    "distrito" => "VILLA MARIA DEL TRIUNFO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150201",
                    "fullubigeo" => "150201 BARRANCA - BARRANCA - LIMA",
                    "distrito" => "BARRANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150202",
                    "fullubigeo" => "150202 PARAMONGA - BARRANCA - LIMA",
                    "distrito" => "PARAMONGA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150203",
                    "fullubigeo" => "150203 PATIVILCA - BARRANCA - LIMA",
                    "distrito" => "PATIVILCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150204",
                    "fullubigeo" => "150204 SUPE - BARRANCA - LIMA",
                    "distrito" => "SUPE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150205",
                    "fullubigeo" => "150205 SUPE PUERTO - BARRANCA - LIMA",
                    "distrito" => "SUPE PUERTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150301",
                    "fullubigeo" => "150301 CAJATAMBO - CAJATAMBO - LIMA",
                    "distrito" => "CAJATAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150302",
                    "fullubigeo" => "150302 COPA - CAJATAMBO - LIMA",
                    "distrito" => "COPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150303",
                    "fullubigeo" => "150303 GORGOR - CAJATAMBO - LIMA",
                    "distrito" => "GORGOR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150304",
                    "fullubigeo" => "150304 HUANCAPON - CAJATAMBO - LIMA",
                    "distrito" => "HUANCAPON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150305",
                    "fullubigeo" => "150305 MANAS - CAJATAMBO - LIMA",
                    "distrito" => "MANAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150401",
                    "fullubigeo" => "150401 CANTA - CANTA - LIMA",
                    "distrito" => "CANTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150402",
                    "fullubigeo" => "150402 ARAHUAY - CANTA - LIMA",
                    "distrito" => "ARAHUAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150403",
                    "fullubigeo" => "150403 HUAMANTANGA - CANTA - LIMA",
                    "distrito" => "HUAMANTANGA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150404",
                    "fullubigeo" => "150404 HUAROS - CANTA - LIMA",
                    "distrito" => "HUAROS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150405",
                    "fullubigeo" => "150405 LACHAQUI - CANTA - LIMA",
                    "distrito" => "LACHAQUI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150406",
                    "fullubigeo" => "150406 SAN BUENAVENTURA - CANTA - LIMA",
                    "distrito" => "SAN BUENAVENTURA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150407",
                    "fullubigeo" => "150407 SANTA ROSA DE QUIVES - CANTA - LIMA",
                    "distrito" => "SANTA ROSA DE QUIVES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150501",
                    "fullubigeo" => "150501 SAN VICENTE DE CAÑETE - CAÑETE - LIMA",
                    "distrito" => "SAN VICENTE DE CAÑETE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150502",
                    "fullubigeo" => "150502 ASIA - CAÑETE - LIMA",
                    "distrito" => "ASIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150503",
                    "fullubigeo" => "150503 CALANGO - CAÑETE - LIMA",
                    "distrito" => "CALANGO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150504",
                    "fullubigeo" => "150504 CERRO AZUL - CAÑETE - LIMA",
                    "distrito" => "CERRO AZUL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150505",
                    "fullubigeo" => "150505 CHILCA - CAÑETE - LIMA",
                    "distrito" => "CHILCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150506",
                    "fullubigeo" => "150506 COAYLLO - CAÑETE - LIMA",
                    "distrito" => "COAYLLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150507",
                    "fullubigeo" => "150507 IMPERIAL - CAÑETE - LIMA",
                    "distrito" => "IMPERIAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150508",
                    "fullubigeo" => "150508 LUNAHUANA - CAÑETE - LIMA",
                    "distrito" => "LUNAHUANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150509",
                    "fullubigeo" => "150509 MALA - CAÑETE - LIMA",
                    "distrito" => "MALA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150510",
                    "fullubigeo" => "150510 NUEVO IMPERIAL - CAÑETE - LIMA",
                    "distrito" => "NUEVO IMPERIAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150511",
                    "fullubigeo" => "150511 PACARAN - CAÑETE - LIMA",
                    "distrito" => "PACARAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150512",
                    "fullubigeo" => "150512 QUILMANA - CAÑETE - LIMA",
                    "distrito" => "QUILMANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150513",
                    "fullubigeo" => "150513 SAN ANTONIO - CAÑETE - LIMA",
                    "distrito" => "SAN ANTONIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150514",
                    "fullubigeo" => "150514 SAN LUIS - CAÑETE - LIMA",
                    "distrito" => "SAN LUIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150515",
                    "fullubigeo" => "150515 SANTA CRUZ DE FLORES - CAÑETE - LIMA",
                    "distrito" => "SANTA CRUZ DE FLORES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150516",
                    "fullubigeo" => "150516 ZUÑIGA - CAÑETE - LIMA",
                    "distrito" => "ZUÑIGA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150601",
                    "fullubigeo" => "150601 HUARAL - HUARAL - LIMA",
                    "distrito" => "HUARAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150602",
                    "fullubigeo" => "150602 ATAVILLOS ALTO - HUARAL - LIMA",
                    "distrito" => "ATAVILLOS ALTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150603",
                    "fullubigeo" => "150603 ATAVILLOS BAJO - HUARAL - LIMA",
                    "distrito" => "ATAVILLOS BAJO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150604",
                    "fullubigeo" => "150604 AUCALLAMA - HUARAL - LIMA",
                    "distrito" => "AUCALLAMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150605",
                    "fullubigeo" => "150605 CHANCAY - HUARAL - LIMA",
                    "distrito" => "CHANCAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150606",
                    "fullubigeo" => "150606 IHUARI - HUARAL - LIMA",
                    "distrito" => "IHUARI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150607",
                    "fullubigeo" => "150607 LAMPIAN - HUARAL - LIMA",
                    "distrito" => "LAMPIAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150608",
                    "fullubigeo" => "150608 PACARAOS - HUARAL - LIMA",
                    "distrito" => "PACARAOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150609",
                    "fullubigeo" => "150609 SAN MIGUEL DE ACOS - HUARAL - LIMA",
                    "distrito" => "SAN MIGUEL DE ACOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150610",
                    "fullubigeo" => "150610 SANTA CRUZ DE ANDAMARCA - HUARAL - LIMA",
                    "distrito" => "SANTA CRUZ DE ANDAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150611",
                    "fullubigeo" => "150611 SUMBILCA - HUARAL - LIMA",
                    "distrito" => "SUMBILCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150612",
                    "fullubigeo" => "150612 VEINTISIETE DE NOVIEMBRE - HUARAL - LIMA",
                    "distrito" => "VEINTISIETE DE NOVIEMBRE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150701",
                    "fullubigeo" => "150701 MATUCANA - HUAROCHIRI - LIMA",
                    "distrito" => "MATUCANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150702",
                    "fullubigeo" => "150702 ANTIOQUIA - HUAROCHIRI - LIMA",
                    "distrito" => "ANTIOQUIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150703",
                    "fullubigeo" => "150703 CALLAHUANCA - HUAROCHIRI - LIMA",
                    "distrito" => "CALLAHUANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150704",
                    "fullubigeo" => "150704 CARAMPOMA - HUAROCHIRI - LIMA",
                    "distrito" => "CARAMPOMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150705",
                    "fullubigeo" => "150705 CHICLA - HUAROCHIRI - LIMA",
                    "distrito" => "CHICLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150706",
                    "fullubigeo" => "150706 CUENCA - HUAROCHIRI - LIMA",
                    "distrito" => "CUENCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150707",
                    "fullubigeo" => "150707 HUACHUPAMPA - HUAROCHIRI - LIMA",
                    "distrito" => "HUACHUPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150708",
                    "fullubigeo" => "150708 HUANZA - HUAROCHIRI - LIMA",
                    "distrito" => "HUANZA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150709",
                    "fullubigeo" => "150709 HUAROCHIRI - HUAROCHIRI - LIMA",
                    "distrito" => "HUAROCHIRI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150710",
                    "fullubigeo" => "150710 LAHUAYTAMBO - HUAROCHIRI - LIMA",
                    "distrito" => "LAHUAYTAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150711",
                    "fullubigeo" => "150711 LANGA - HUAROCHIRI - LIMA",
                    "distrito" => "LANGA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150712",
                    "fullubigeo" => "150712 LARAOS - HUAROCHIRI - LIMA",
                    "distrito" => "LARAOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150713",
                    "fullubigeo" => "150713 MARIATANA - HUAROCHIRI - LIMA",
                    "distrito" => "MARIATANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150714",
                    "fullubigeo" => "150714 RICARDO PALMA - HUAROCHIRI - LIMA",
                    "distrito" => "RICARDO PALMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150715",
                    "fullubigeo" => "150715 SAN ANDRES DE TUPICOCHA - HUAROCHIRI - LIMA",
                    "distrito" => "SAN ANDRES DE TUPICOCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150716",
                    "fullubigeo" => "150716 SAN ANTONIO - HUAROCHIRI - LIMA",
                    "distrito" => "SAN ANTONIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150717",
                    "fullubigeo" => "150717 SAN BARTOLOME - HUAROCHIRI - LIMA",
                    "distrito" => "SAN BARTOLOME", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150718",
                    "fullubigeo" => "150718 SAN DAMIAN - HUAROCHIRI - LIMA",
                    "distrito" => "SAN DAMIAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150719",
                    "fullubigeo" => "150719 SAN JUAN DE IRIS - HUAROCHIRI - LIMA",
                    "distrito" => "SAN JUAN DE IRIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150720",
                    "fullubigeo" => "150720 SAN JUAN DE TANTARANCHE - HUAROCHIRI - LIMA",
                    "distrito" => "SAN JUAN DE TANTARANCHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150721",
                    "fullubigeo" => "150721 SAN LORENZO DE QUINTI - HUAROCHIRI - LIMA",
                    "distrito" => "SAN LORENZO DE QUINTI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150722",
                    "fullubigeo" => "150722 SAN MATEO - HUAROCHIRI - LIMA",
                    "distrito" => "SAN MATEO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150723",
                    "fullubigeo" => "150723 SAN MATEO DE OTAO - HUAROCHIRI - LIMA",
                    "distrito" => "SAN MATEO DE OTAO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150724",
                    "fullubigeo" => "150724 SAN PEDRO DE CASTA - HUAROCHIRI - LIMA",
                    "distrito" => "SAN PEDRO DE CASTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150725",
                    "fullubigeo" => "150725 SAN PEDRO DE HUANCAYRE - HUAROCHIRI - LIMA",
                    "distrito" => "SAN PEDRO DE HUANCAYRE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150726",
                    "fullubigeo" => "150726 SANGALLAYA - HUAROCHIRI - LIMA",
                    "distrito" => "SANGALLAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150727",
                    "fullubigeo" => "150727 SANTA CRUZ DE COCACHACRA - HUAROCHIRI - LIMA",
                    "distrito" => "SANTA CRUZ DE COCACHACRA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150728",
                    "fullubigeo" => "150728 SANTA EULALIA - HUAROCHIRI - LIMA",
                    "distrito" => "SANTA EULALIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150729",
                    "fullubigeo" => "150729 SANTIAGO DE ANCHUCAYA - HUAROCHIRI - LIMA",
                    "distrito" => "SANTIAGO DE ANCHUCAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150730",
                    "fullubigeo" => "150730 SANTIAGO DE TUNA - HUAROCHIRI - LIMA",
                    "distrito" => "SANTIAGO DE TUNA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150731",
                    "fullubigeo" => "150731 SANTO DOMINGO DE LOS OLLEROS - HUAROCHIRI - LIMA",
                    "distrito" => "SANTO DOMINGO DE LOS OLLEROS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150732",
                    "fullubigeo" => "150732 SURCO - HUAROCHIRI - LIMA",
                    "distrito" => "SURCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150801",
                    "fullubigeo" => "150801 HUACHO - HUAURA - LIMA",
                    "distrito" => "HUACHO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150802",
                    "fullubigeo" => "150802 AMBAR - HUAURA - LIMA",
                    "distrito" => "AMBAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150803",
                    "fullubigeo" => "150803 CALETA DE CARQUIN - HUAURA - LIMA",
                    "distrito" => "CALETA DE CARQUIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150804",
                    "fullubigeo" => "150804 CHECRAS - HUAURA - LIMA",
                    "distrito" => "CHECRAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150805",
                    "fullubigeo" => "150805 HUALMAY - HUAURA - LIMA",
                    "distrito" => "HUALMAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150806",
                    "fullubigeo" => "150806 HUAURA - HUAURA - LIMA",
                    "distrito" => "HUAURA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150807",
                    "fullubigeo" => "150807 LEONCIO PRADO - HUAURA - LIMA",
                    "distrito" => "LEONCIO PRADO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150808",
                    "fullubigeo" => "150808 PACCHO - HUAURA - LIMA",
                    "distrito" => "PACCHO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150809",
                    "fullubigeo" => "150809 SANTA LEONOR - HUAURA - LIMA",
                    "distrito" => "SANTA LEONOR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150810",
                    "fullubigeo" => "150810 SANTA MARIA - HUAURA - LIMA",
                    "distrito" => "SANTA MARIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150811",
                    "fullubigeo" => "150811 SAYAN - HUAURA - LIMA",
                    "distrito" => "SAYAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150812",
                    "fullubigeo" => "150812 VEGUETA - HUAURA - LIMA",
                    "distrito" => "VEGUETA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150901",
                    "fullubigeo" => "150901 OYON - OYON - LIMA",
                    "distrito" => "OYON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150902",
                    "fullubigeo" => "150902 ANDAJES - OYON - LIMA",
                    "distrito" => "ANDAJES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150903",
                    "fullubigeo" => "150903 CAUJUL - OYON - LIMA",
                    "distrito" => "CAUJUL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150904",
                    "fullubigeo" => "150904 COCHAMARCA - OYON - LIMA",
                    "distrito" => "COCHAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150905",
                    "fullubigeo" => "150905 NAVAN - OYON - LIMA",
                    "distrito" => "NAVAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "150906",
                    "fullubigeo" => "150906 PACHANGARA - OYON - LIMA",
                    "distrito" => "PACHANGARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151001",
                    "fullubigeo" => "151001 YAUYOS - YAUYOS - LIMA",
                    "distrito" => "YAUYOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151002",
                    "fullubigeo" => "151002 ALIS - YAUYOS - LIMA",
                    "distrito" => "ALIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151003",
                    "fullubigeo" => "151003 ALLAUCA - YAUYOS - LIMA",
                    "distrito" => "ALLAUCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151004",
                    "fullubigeo" => "151004 AYAVIRI - YAUYOS - LIMA",
                    "distrito" => "AYAVIRI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151005",
                    "fullubigeo" => "151005 AZANGARO - YAUYOS - LIMA",
                    "distrito" => "AZANGARO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151006",
                    "fullubigeo" => "151006 CACRA - YAUYOS - LIMA",
                    "distrito" => "CACRA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151007",
                    "fullubigeo" => "151007 CARANIA - YAUYOS - LIMA",
                    "distrito" => "CARANIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151008",
                    "fullubigeo" => "151008 CATAHUASI - YAUYOS - LIMA",
                    "distrito" => "CATAHUASI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151009",
                    "fullubigeo" => "151009 CHOCOS - YAUYOS - LIMA",
                    "distrito" => "CHOCOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151010",
                    "fullubigeo" => "151010 COCHAS - YAUYOS - LIMA",
                    "distrito" => "COCHAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151011",
                    "fullubigeo" => "151011 COLONIA - YAUYOS - LIMA",
                    "distrito" => "COLONIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151012",
                    "fullubigeo" => "151012 HONGOS - YAUYOS - LIMA",
                    "distrito" => "HONGOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151013",
                    "fullubigeo" => "151013 HUAMPARA - YAUYOS - LIMA",
                    "distrito" => "HUAMPARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151014",
                    "fullubigeo" => "151014 HUANCAYA - YAUYOS - LIMA",
                    "distrito" => "HUANCAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151015",
                    "fullubigeo" => "151015 HUANGASCAR - YAUYOS - LIMA",
                    "distrito" => "HUANGASCAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151016",
                    "fullubigeo" => "151016 HUANTAN - YAUYOS - LIMA",
                    "distrito" => "HUANTAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151017",
                    "fullubigeo" => "151017 HUAÑEC - YAUYOS - LIMA",
                    "distrito" => "HUAÑEC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151018",
                    "fullubigeo" => "151018 LARAOS - YAUYOS - LIMA",
                    "distrito" => "LARAOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151019",
                    "fullubigeo" => "151019 LINCHA - YAUYOS - LIMA",
                    "distrito" => "LINCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151020",
                    "fullubigeo" => "151020 MADEAN - YAUYOS - LIMA",
                    "distrito" => "MADEAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151021",
                    "fullubigeo" => "151021 MIRAFLORES - YAUYOS - LIMA",
                    "distrito" => "MIRAFLORES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151022",
                    "fullubigeo" => "151022 OMAS - YAUYOS - LIMA",
                    "distrito" => "OMAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151023",
                    "fullubigeo" => "151023 PUTINZA - YAUYOS - LIMA",
                    "distrito" => "PUTINZA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151024",
                    "fullubigeo" => "151024 QUINCHES - YAUYOS - LIMA",
                    "distrito" => "QUINCHES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151025",
                    "fullubigeo" => "151025 QUINOCAY - YAUYOS - LIMA",
                    "distrito" => "QUINOCAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151026",
                    "fullubigeo" => "151026 SAN JOAQUIN - YAUYOS - LIMA",
                    "distrito" => "SAN JOAQUIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151027",
                    "fullubigeo" => "151027 SAN PEDRO DE PILAS - YAUYOS - LIMA",
                    "distrito" => "SAN PEDRO DE PILAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151028",
                    "fullubigeo" => "151028 TANTA - YAUYOS - LIMA",
                    "distrito" => "TANTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151029",
                    "fullubigeo" => "151029 TAURIPAMPA - YAUYOS - LIMA",
                    "distrito" => "TAURIPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151030",
                    "fullubigeo" => "151030 TOMAS - YAUYOS - LIMA",
                    "distrito" => "TOMAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151031",
                    "fullubigeo" => "151031 TUPE - YAUYOS - LIMA",
                    "distrito" => "TUPE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151032",
                    "fullubigeo" => "151032 VIÑAC - YAUYOS - LIMA",
                    "distrito" => "VIÑAC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "151033",
                    "fullubigeo" => "151033 VITIS - YAUYOS - LIMA",
                    "distrito" => "VITIS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160101",
                    "fullubigeo" => "160101 IQUITOS - MAYNAS - LORETO",
                    "distrito" => "IQUITOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160102",
                    "fullubigeo" => "160102 ALTO NANAY - MAYNAS - LORETO",
                    "distrito" => "ALTO NANAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160103",
                    "fullubigeo" => "160103 FERNANDO LORES - MAYNAS - LORETO",
                    "distrito" => "FERNANDO LORES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160104",
                    "fullubigeo" => "160104 INDIANA - MAYNAS - LORETO",
                    "distrito" => "INDIANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160105",
                    "fullubigeo" => "160105 LAS AMAZONAS - MAYNAS - LORETO",
                    "distrito" => "LAS AMAZONAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160106",
                    "fullubigeo" => "160106 MAZAN - MAYNAS - LORETO",
                    "distrito" => "MAZAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160107",
                    "fullubigeo" => "160107 NAPO - MAYNAS - LORETO",
                    "distrito" => "NAPO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160108",
                    "fullubigeo" => "160108 PUNCHANA - MAYNAS - LORETO",
                    "distrito" => "PUNCHANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160109",
                    "fullubigeo" => "160109 PUTUMAYO - MAYNAS - LORETO",
                    "distrito" => "PUTUMAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160110",
                    "fullubigeo" => "160110 TORRES CAUSANA - MAYNAS - LORETO",
                    "distrito" => "TORRES CAUSANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160112",
                    "fullubigeo" => "160112 BELEN - MAYNAS - LORETO",
                    "distrito" => "BELEN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160113",
                    "fullubigeo" => "160113 SAN JUAN BAUTISTA - MAYNAS - LORETO",
                    "distrito" => "SAN JUAN BAUTISTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160114",
                    "fullubigeo" => "160114 TENIENTE MANUEL CLAVERO - MAYNAS - LORETO",
                    "distrito" => "TENIENTE MANUEL CLAVERO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160201",
                    "fullubigeo" => "160201 YURIMAGUAS - ALTO AMAZONAS - LORETO",
                    "distrito" => "YURIMAGUAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160202",
                    "fullubigeo" => "160202 BALSAPUERTO - ALTO AMAZONAS - LORETO",
                    "distrito" => "BALSAPUERTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160205",
                    "fullubigeo" => "160205 JEBEROS - ALTO AMAZONAS - LORETO",
                    "distrito" => "JEBEROS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160206",
                    "fullubigeo" => "160206 LAGUNAS - ALTO AMAZONAS - LORETO",
                    "distrito" => "LAGUNAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160210",
                    "fullubigeo" => "160210 SANTA CRUZ - ALTO AMAZONAS - LORETO",
                    "distrito" => "SANTA CRUZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160211",
                    "fullubigeo" => "160211 TENIENTE CESAR LOPEZ ROJAS - ALTO AMAZONAS - LORETO",
                    "distrito" => "TENIENTE CESAR LOPEZ ROJAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160301",
                    "fullubigeo" => "160301 NAUTA - LORETO - LORETO",
                    "distrito" => "NAUTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160302",
                    "fullubigeo" => "160302 PARINARI - LORETO - LORETO",
                    "distrito" => "PARINARI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160303",
                    "fullubigeo" => "160303 TIGRE - LORETO - LORETO",
                    "distrito" => "TIGRE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160304",
                    "fullubigeo" => "160304 TROMPETEROS - LORETO - LORETO",
                    "distrito" => "TROMPETEROS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160305",
                    "fullubigeo" => "160305 URARINAS - LORETO - LORETO",
                    "distrito" => "URARINAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160401",
                    "fullubigeo" => "160401 RAMON CASTILLA - MARISCAL RAMON CASTILLA - LORETO",
                    "distrito" => "RAMON CASTILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160402",
                    "fullubigeo" => "160402 PEBAS - MARISCAL RAMON CASTILLA - LORETO",
                    "distrito" => "PEBAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160403",
                    "fullubigeo" => "160403 YAVARI - MARISCAL RAMON CASTILLA - LORETO",
                    "distrito" => "YAVARI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160404",
                    "fullubigeo" => "160404 SAN PABLO - MARISCAL RAMON CASTILLA - LORETO",
                    "distrito" => "SAN PABLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160501",
                    "fullubigeo" => "160501 REQUENA - REQUENA - LORETO",
                    "distrito" => "REQUENA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160502",
                    "fullubigeo" => "160502 ALTO TAPICHE - REQUENA - LORETO",
                    "distrito" => "ALTO TAPICHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160503",
                    "fullubigeo" => "160503 CAPELO - REQUENA - LORETO",
                    "distrito" => "CAPELO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160504",
                    "fullubigeo" => "160504 EMILIO SAN MARTIN - REQUENA - LORETO",
                    "distrito" => "EMILIO SAN MARTIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160505",
                    "fullubigeo" => "160505 MAQUIA - REQUENA - LORETO",
                    "distrito" => "MAQUIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160506",
                    "fullubigeo" => "160506 PUINAHUA - REQUENA - LORETO",
                    "distrito" => "PUINAHUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160507",
                    "fullubigeo" => "160507 SAQUENA - REQUENA - LORETO",
                    "distrito" => "SAQUENA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160508",
                    "fullubigeo" => "160508 SOPLIN - REQUENA - LORETO",
                    "distrito" => "SOPLIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160509",
                    "fullubigeo" => "160509 TAPICHE - REQUENA - LORETO",
                    "distrito" => "TAPICHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160510",
                    "fullubigeo" => "160510 JENARO HERRERA - REQUENA - LORETO",
                    "distrito" => "JENARO HERRERA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160511",
                    "fullubigeo" => "160511 YAQUERANA - REQUENA - LORETO",
                    "distrito" => "YAQUERANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160601",
                    "fullubigeo" => "160601 CONTAMANA - UCAYALI - LORETO",
                    "distrito" => "CONTAMANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160602",
                    "fullubigeo" => "160602 INAHUAYA - UCAYALI - LORETO",
                    "distrito" => "INAHUAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160603",
                    "fullubigeo" => "160603 PADRE MARQUEZ - UCAYALI - LORETO",
                    "distrito" => "PADRE MARQUEZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160604",
                    "fullubigeo" => "160604 PAMPA HERMOSA - UCAYALI - LORETO",
                    "distrito" => "PAMPA HERMOSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160605",
                    "fullubigeo" => "160605 SARAYACU - UCAYALI - LORETO",
                    "distrito" => "SARAYACU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160606",
                    "fullubigeo" => "160606 VARGAS GUERRA - UCAYALI - LORETO",
                    "distrito" => "VARGAS GUERRA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160701",
                    "fullubigeo" => "160701 BARRANCA - DATEM DEL MARAÑON - LORETO",
                    "distrito" => "BARRANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160702",
                    "fullubigeo" => "160702 CAHUAPANAS - DATEM DEL MARAÑON - LORETO",
                    "distrito" => "CAHUAPANAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160703",
                    "fullubigeo" => "160703 MANSERICHE - DATEM DEL MARAÑON - LORETO",
                    "distrito" => "MANSERICHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160704",
                    "fullubigeo" => "160704 MORONA - DATEM DEL MARAÑON - LORETO",
                    "distrito" => "MORONA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160705",
                    "fullubigeo" => "160705 PASTAZA - DATEM DEL MARAÑON - LORETO",
                    "distrito" => "PASTAZA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "160706",
                    "fullubigeo" => "160706 ANDOAS - DATEM DEL MARAÑON - LORETO",
                    "distrito" => "ANDOAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "170101",
                    "fullubigeo" => "170101 TAMBOPATA - TAMBOPATA - MADRE DE DIOS",
                    "distrito" => "TAMBOPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "170102",
                    "fullubigeo" => "170102 INAMBARI - TAMBOPATA - MADRE DE DIOS",
                    "distrito" => "INAMBARI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "170103",
                    "fullubigeo" => "170103 LAS PIEDRAS - TAMBOPATA - MADRE DE DIOS",
                    "distrito" => "LAS PIEDRAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "170104",
                    "fullubigeo" => "170104 LABERINTO - TAMBOPATA - MADRE DE DIOS",
                    "distrito" => "LABERINTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "170201",
                    "fullubigeo" => "170201 MANU - MANU - MADRE DE DIOS",
                    "distrito" => "MANU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "170202",
                    "fullubigeo" => "170202 FITZCARRALD - MANU - MADRE DE DIOS",
                    "distrito" => "FITZCARRALD", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "170203",
                    "fullubigeo" => "170203 MADRE DE DIOS - MANU - MADRE DE DIOS",
                    "distrito" => "MADRE DE DIOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "170204",
                    "fullubigeo" => "170204 HUEPETUHE - MANU - MADRE DE DIOS",
                    "distrito" => "HUEPETUHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "170301",
                    "fullubigeo" => "170301 IÑAPARI - TAHUAMANU - MADRE DE DIOS",
                    "distrito" => "IÑAPARI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "170302",
                    "fullubigeo" => "170302 IBERIA - TAHUAMANU - MADRE DE DIOS",
                    "distrito" => "IBERIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "170303",
                    "fullubigeo" => "170303 TAHUAMANU - TAHUAMANU - MADRE DE DIOS",
                    "distrito" => "TAHUAMANU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180101",
                    "fullubigeo" => "180101 MOQUEGUA - MARISCAL NIETO - MOQUEGUA",
                    "distrito" => "MOQUEGUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180102",
                    "fullubigeo" => "180102 CARUMAS - MARISCAL NIETO - MOQUEGUA",
                    "distrito" => "CARUMAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180103",
                    "fullubigeo" => "180103 CUCHUMBAYA - MARISCAL NIETO - MOQUEGUA",
                    "distrito" => "CUCHUMBAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180104",
                    "fullubigeo" => "180104 SAMEGUA - MARISCAL NIETO - MOQUEGUA",
                    "distrito" => "SAMEGUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180105",
                    "fullubigeo" => "180105 SAN CRISTOBAL - MARISCAL NIETO - MOQUEGUA",
                    "distrito" => "SAN CRISTOBAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180106",
                    "fullubigeo" => "180106 TORATA - MARISCAL NIETO - MOQUEGUA",
                    "distrito" => "TORATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180201",
                    "fullubigeo" => "180201 OMATE - GENERAL SANCHEZ CERRO - MOQUEGUA",
                    "distrito" => "OMATE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180202",
                    "fullubigeo" => "180202 CHOJATA - GENERAL SANCHEZ CERRO - MOQUEGUA",
                    "distrito" => "CHOJATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180203",
                    "fullubigeo" => "180203 COALAQUE - GENERAL SANCHEZ CERRO - MOQUEGUA",
                    "distrito" => "COALAQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180204",
                    "fullubigeo" => "180204 ICHUÑA - GENERAL SANCHEZ CERRO - MOQUEGUA",
                    "distrito" => "ICHUÑA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180205",
                    "fullubigeo" => "180205 LA CAPILLA - GENERAL SANCHEZ CERRO - MOQUEGUA",
                    "distrito" => "LA CAPILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180206",
                    "fullubigeo" => "180206 LLOQUE - GENERAL SANCHEZ CERRO - MOQUEGUA",
                    "distrito" => "LLOQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180207",
                    "fullubigeo" => "180207 MATALAQUE - GENERAL SANCHEZ CERRO - MOQUEGUA",
                    "distrito" => "MATALAQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180208",
                    "fullubigeo" => "180208 PUQUINA - GENERAL SANCHEZ CERRO - MOQUEGUA",
                    "distrito" => "PUQUINA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180209",
                    "fullubigeo" => "180209 QUINISTAQUILLAS - GENERAL SANCHEZ CERRO - MOQUEGUA",
                    "distrito" => "QUINISTAQUILLAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180210",
                    "fullubigeo" => "180210 UBINAS - GENERAL SANCHEZ CERRO - MOQUEGUA",
                    "distrito" => "UBINAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180211",
                    "fullubigeo" => "180211 YUNGA - GENERAL SANCHEZ CERRO - MOQUEGUA",
                    "distrito" => "YUNGA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180301",
                    "fullubigeo" => "180301 ILO - ILO - MOQUEGUA",
                    "distrito" => "ILO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180302",
                    "fullubigeo" => "180302 EL ALGARROBAL - ILO - MOQUEGUA",
                    "distrito" => "EL ALGARROBAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "180303",
                    "fullubigeo" => "180303 PACOCHA - ILO - MOQUEGUA",
                    "distrito" => "PACOCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190101",
                    "fullubigeo" => "190101 CHAUPIMARCA - PASCO - PASCO",
                    "distrito" => "CHAUPIMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190102",
                    "fullubigeo" => "190102 HUACHON - PASCO - PASCO",
                    "distrito" => "HUACHON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190103",
                    "fullubigeo" => "190103 HUARIACA - PASCO - PASCO",
                    "distrito" => "HUARIACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190104",
                    "fullubigeo" => "190104 HUAYLLAY - PASCO - PASCO",
                    "distrito" => "HUAYLLAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190105",
                    "fullubigeo" => "190105 NINACACA - PASCO - PASCO",
                    "distrito" => "NINACACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190106",
                    "fullubigeo" => "190106 PALLANCHACRA - PASCO - PASCO",
                    "distrito" => "PALLANCHACRA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190107",
                    "fullubigeo" => "190107 PAUCARTAMBO - PASCO - PASCO",
                    "distrito" => "PAUCARTAMBO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190108",
                    "fullubigeo" => "190108 SAN FRANCISCO DE ASIS DE YARUSYACAN - PASCO - PASCO",
                    "distrito" => "SAN FRANCISCO DE ASIS DE YARUSYACAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190109",
                    "fullubigeo" => "190109 SIMON BOLIVAR - PASCO - PASCO",
                    "distrito" => "SIMON BOLIVAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190110",
                    "fullubigeo" => "190110 TICLACAYAN - PASCO - PASCO",
                    "distrito" => "TICLACAYAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190111",
                    "fullubigeo" => "190111 TINYAHUARCO - PASCO - PASCO",
                    "distrito" => "TINYAHUARCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190112",
                    "fullubigeo" => "190112 VICCO - PASCO - PASCO",
                    "distrito" => "VICCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190113",
                    "fullubigeo" => "190113 YANACANCHA - PASCO - PASCO",
                    "distrito" => "YANACANCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190201",
                    "fullubigeo" => "190201 YANAHUANCA - DANIEL ALCIDES CARRION - PASCO",
                    "distrito" => "YANAHUANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190202",
                    "fullubigeo" => "190202 CHACAYAN - DANIEL ALCIDES CARRION - PASCO",
                    "distrito" => "CHACAYAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190203",
                    "fullubigeo" => "190203 GOYLLARISQUIZGA - DANIEL ALCIDES CARRION - PASCO",
                    "distrito" => "GOYLLARISQUIZGA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190204",
                    "fullubigeo" => "190204 PAUCAR - DANIEL ALCIDES CARRION - PASCO",
                    "distrito" => "PAUCAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190205",
                    "fullubigeo" => "190205 SAN PEDRO DE PILLAO - DANIEL ALCIDES CARRION - PASCO",
                    "distrito" => "SAN PEDRO DE PILLAO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190206",
                    "fullubigeo" => "190206 SANTA ANA DE TUSI - DANIEL ALCIDES CARRION - PASCO",
                    "distrito" => "SANTA ANA DE TUSI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190207",
                    "fullubigeo" => "190207 TAPUC - DANIEL ALCIDES CARRION - PASCO",
                    "distrito" => "TAPUC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190208",
                    "fullubigeo" => "190208 VILCABAMBA - DANIEL ALCIDES CARRION - PASCO",
                    "distrito" => "VILCABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190301",
                    "fullubigeo" => "190301 OXAPAMPA - OXAPAMPA - PASCO",
                    "distrito" => "OXAPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190302",
                    "fullubigeo" => "190302 CHONTABAMBA - OXAPAMPA - PASCO",
                    "distrito" => "CHONTABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190303",
                    "fullubigeo" => "190303 HUANCABAMBA - OXAPAMPA - PASCO",
                    "distrito" => "HUANCABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190304",
                    "fullubigeo" => "190304 PALCAZU - OXAPAMPA - PASCO",
                    "distrito" => "PALCAZU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190305",
                    "fullubigeo" => "190305 POZUZO - OXAPAMPA - PASCO",
                    "distrito" => "POZUZO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190306",
                    "fullubigeo" => "190306 PUERTO BERMUDEZ - OXAPAMPA - PASCO",
                    "distrito" => "PUERTO BERMUDEZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "190307",
                    "fullubigeo" => "190307 VILLA RICA - OXAPAMPA - PASCO",
                    "distrito" => "VILLA RICA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200101",
                    "fullubigeo" => "200101 PIURA - PIURA - PIURA",
                    "distrito" => "PIURA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200104",
                    "fullubigeo" => "200104 CASTILLA - PIURA - PIURA",
                    "distrito" => "CASTILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200105",
                    "fullubigeo" => "200105 CATACAOS - PIURA - PIURA",
                    "distrito" => "CATACAOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200107",
                    "fullubigeo" => "200107 CURA MORI - PIURA - PIURA",
                    "distrito" => "CURA MORI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200108",
                    "fullubigeo" => "200108 EL TALLAN - PIURA - PIURA",
                    "distrito" => "EL TALLAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200109",
                    "fullubigeo" => "200109 LA ARENA - PIURA - PIURA",
                    "distrito" => "LA ARENA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200110",
                    "fullubigeo" => "200110 LA UNION - PIURA - PIURA",
                    "distrito" => "LA UNION", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200111",
                    "fullubigeo" => "200111 LAS LOMAS - PIURA - PIURA",
                    "distrito" => "LAS LOMAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200114",
                    "fullubigeo" => "200114 TAMBO GRANDE - PIURA - PIURA",
                    "distrito" => "TAMBO GRANDE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200201",
                    "fullubigeo" => "200201 AYABACA - AYABACA - PIURA",
                    "distrito" => "AYABACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200202",
                    "fullubigeo" => "200202 FRIAS - AYABACA - PIURA",
                    "distrito" => "FRIAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200203",
                    "fullubigeo" => "200203 JILILI - AYABACA - PIURA",
                    "distrito" => "JILILI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200204",
                    "fullubigeo" => "200204 LAGUNAS - AYABACA - PIURA",
                    "distrito" => "LAGUNAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200205",
                    "fullubigeo" => "200205 MONTERO - AYABACA - PIURA",
                    "distrito" => "MONTERO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200206",
                    "fullubigeo" => "200206 PACAIPAMPA - AYABACA - PIURA",
                    "distrito" => "PACAIPAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200207",
                    "fullubigeo" => "200207 PAIMAS - AYABACA - PIURA",
                    "distrito" => "PAIMAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200208",
                    "fullubigeo" => "200208 SAPILLICA - AYABACA - PIURA",
                    "distrito" => "SAPILLICA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200209",
                    "fullubigeo" => "200209 SICCHEZ - AYABACA - PIURA",
                    "distrito" => "SICCHEZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200210",
                    "fullubigeo" => "200210 SUYO - AYABACA - PIURA",
                    "distrito" => "SUYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200301",
                    "fullubigeo" => "200301 HUANCABAMBA - HUANCABAMBA - PIURA",
                    "distrito" => "HUANCABAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200302",
                    "fullubigeo" => "200302 CANCHAQUE - HUANCABAMBA - PIURA",
                    "distrito" => "CANCHAQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200303",
                    "fullubigeo" => "200303 EL CARMEN DE LA FRONTERA - HUANCABAMBA - PIURA",
                    "distrito" => "EL CARMEN DE LA FRONTERA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200304",
                    "fullubigeo" => "200304 HUARMACA - HUANCABAMBA - PIURA",
                    "distrito" => "HUARMACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200305",
                    "fullubigeo" => "200305 LALAQUIZ - HUANCABAMBA - PIURA",
                    "distrito" => "LALAQUIZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200306",
                    "fullubigeo" => "200306 SAN MIGUEL DE EL FAIQUE - HUANCABAMBA - PIURA",
                    "distrito" => "SAN MIGUEL DE EL FAIQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200307",
                    "fullubigeo" => "200307 SONDOR - HUANCABAMBA - PIURA",
                    "distrito" => "SONDOR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200308",
                    "fullubigeo" => "200308 SONDORILLO - HUANCABAMBA - PIURA",
                    "distrito" => "SONDORILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200401",
                    "fullubigeo" => "200401 CHULUCANAS - MORROPON - PIURA",
                    "distrito" => "CHULUCANAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200402",
                    "fullubigeo" => "200402 BUENOS AIRES - MORROPON - PIURA",
                    "distrito" => "BUENOS AIRES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200403",
                    "fullubigeo" => "200403 CHALACO - MORROPON - PIURA",
                    "distrito" => "CHALACO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200404",
                    "fullubigeo" => "200404 LA MATANZA - MORROPON - PIURA",
                    "distrito" => "LA MATANZA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200405",
                    "fullubigeo" => "200405 MORROPON - MORROPON - PIURA",
                    "distrito" => "MORROPON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200406",
                    "fullubigeo" => "200406 SALITRAL - MORROPON - PIURA",
                    "distrito" => "SALITRAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200407",
                    "fullubigeo" => "200407 SAN JUAN DE BIGOTE - MORROPON - PIURA",
                    "distrito" => "SAN JUAN DE BIGOTE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200408",
                    "fullubigeo" => "200408 SANTA CATALINA DE MOSSA - MORROPON - PIURA",
                    "distrito" => "SANTA CATALINA DE MOSSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200409",
                    "fullubigeo" => "200409 SANTO DOMINGO - MORROPON - PIURA",
                    "distrito" => "SANTO DOMINGO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200410",
                    "fullubigeo" => "200410 YAMANGO - MORROPON - PIURA",
                    "distrito" => "YAMANGO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200501",
                    "fullubigeo" => "200501 PAITA - PAITA - PIURA",
                    "distrito" => "PAITA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200502",
                    "fullubigeo" => "200502 AMOTAPE - PAITA - PIURA",
                    "distrito" => "AMOTAPE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200503",
                    "fullubigeo" => "200503 ARENAL - PAITA - PIURA",
                    "distrito" => "ARENAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200504",
                    "fullubigeo" => "200504 COLAN - PAITA - PIURA",
                    "distrito" => "COLAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200505",
                    "fullubigeo" => "200505 LA HUACA - PAITA - PIURA",
                    "distrito" => "LA HUACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200506",
                    "fullubigeo" => "200506 TAMARINDO - PAITA - PIURA",
                    "distrito" => "TAMARINDO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200507",
                    "fullubigeo" => "200507 VICHAYAL - PAITA - PIURA",
                    "distrito" => "VICHAYAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200601",
                    "fullubigeo" => "200601 SULLANA - SULLANA - PIURA",
                    "distrito" => "SULLANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200602",
                    "fullubigeo" => "200602 BELLAVISTA - SULLANA - PIURA",
                    "distrito" => "BELLAVISTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200603",
                    "fullubigeo" => "200603 IGNACIO ESCUDERO - SULLANA - PIURA",
                    "distrito" => "IGNACIO ESCUDERO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200604",
                    "fullubigeo" => "200604 LANCONES - SULLANA - PIURA",
                    "distrito" => "LANCONES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200605",
                    "fullubigeo" => "200605 MARCAVELICA - SULLANA - PIURA",
                    "distrito" => "MARCAVELICA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200606",
                    "fullubigeo" => "200606 MIGUEL CHECA - SULLANA - PIURA",
                    "distrito" => "MIGUEL CHECA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200607",
                    "fullubigeo" => "200607 QUERECOTILLO - SULLANA - PIURA",
                    "distrito" => "QUERECOTILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200608",
                    "fullubigeo" => "200608 SALITRAL - SULLANA - PIURA",
                    "distrito" => "SALITRAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200701",
                    "fullubigeo" => "200701 PARIÑAS - TALARA - PIURA",
                    "distrito" => "PARIÑAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200702",
                    "fullubigeo" => "200702 EL ALTO - TALARA - PIURA",
                    "distrito" => "EL ALTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200703",
                    "fullubigeo" => "200703 LA BREA - TALARA - PIURA",
                    "distrito" => "LA BREA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200704",
                    "fullubigeo" => "200704 LOBITOS - TALARA - PIURA",
                    "distrito" => "LOBITOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200705",
                    "fullubigeo" => "200705 LOS ORGANOS - TALARA - PIURA",
                    "distrito" => "LOS ORGANOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200706",
                    "fullubigeo" => "200706 MANCORA - TALARA - PIURA",
                    "distrito" => "MANCORA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200801",
                    "fullubigeo" => "200801 SECHURA - SECHURA - PIURA",
                    "distrito" => "SECHURA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200802",
                    "fullubigeo" => "200802 BELLAVISTA DE LA UNION - SECHURA - PIURA",
                    "distrito" => "BELLAVISTA DE LA UNION", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200803",
                    "fullubigeo" => "200803 BERNAL - SECHURA - PIURA",
                    "distrito" => "BERNAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200804",
                    "fullubigeo" => "200804 CRISTO NOS VALGA - SECHURA - PIURA",
                    "distrito" => "CRISTO NOS VALGA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200805",
                    "fullubigeo" => "200805 VICE - SECHURA - PIURA",
                    "distrito" => "VICE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "200806",
                    "fullubigeo" => "200806 RINCONADA LLICUAR - SECHURA - PIURA",
                    "distrito" => "RINCONADA LLICUAR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210101",
                    "fullubigeo" => "210101 PUNO - PUNO - PUNO",
                    "distrito" => "PUNO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210102",
                    "fullubigeo" => "210102 ACORA - PUNO - PUNO",
                    "distrito" => "ACORA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210103",
                    "fullubigeo" => "210103 AMANTANI - PUNO - PUNO",
                    "distrito" => "AMANTANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210104",
                    "fullubigeo" => "210104 ATUNCOLLA - PUNO - PUNO",
                    "distrito" => "ATUNCOLLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210105",
                    "fullubigeo" => "210105 CAPACHICA - PUNO - PUNO",
                    "distrito" => "CAPACHICA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210106",
                    "fullubigeo" => "210106 CHUCUITO - PUNO - PUNO",
                    "distrito" => "CHUCUITO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210107",
                    "fullubigeo" => "210107 COATA - PUNO - PUNO",
                    "distrito" => "COATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210108",
                    "fullubigeo" => "210108 HUATA - PUNO - PUNO",
                    "distrito" => "HUATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210109",
                    "fullubigeo" => "210109 MAÑAZO - PUNO - PUNO",
                    "distrito" => "MAÑAZO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210110",
                    "fullubigeo" => "210110 PAUCARCOLLA - PUNO - PUNO",
                    "distrito" => "PAUCARCOLLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210111",
                    "fullubigeo" => "210111 PICHACANI - PUNO - PUNO",
                    "distrito" => "PICHACANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210112",
                    "fullubigeo" => "210112 PLATERIA - PUNO - PUNO",
                    "distrito" => "PLATERIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210113",
                    "fullubigeo" => "210113 SAN ANTONIO - PUNO - PUNO",
                    "distrito" => "SAN ANTONIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210114",
                    "fullubigeo" => "210114 TIQUILLACA - PUNO - PUNO",
                    "distrito" => "TIQUILLACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210115",
                    "fullubigeo" => "210115 VILQUE - PUNO - PUNO",
                    "distrito" => "VILQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210201",
                    "fullubigeo" => "210201 AZANGARO - AZANGARO - PUNO",
                    "distrito" => "AZANGARO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210202",
                    "fullubigeo" => "210202 ACHAYA - AZANGARO - PUNO",
                    "distrito" => "ACHAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210203",
                    "fullubigeo" => "210203 ARAPA - AZANGARO - PUNO",
                    "distrito" => "ARAPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210204",
                    "fullubigeo" => "210204 ASILLO - AZANGARO - PUNO",
                    "distrito" => "ASILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210205",
                    "fullubigeo" => "210205 CAMINACA - AZANGARO - PUNO",
                    "distrito" => "CAMINACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210206",
                    "fullubigeo" => "210206 CHUPA - AZANGARO - PUNO",
                    "distrito" => "CHUPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210207",
                    "fullubigeo" => "210207 JOSE DOMINGO CHOQUEHUANCA - AZANGARO - PUNO",
                    "distrito" => "JOSE DOMINGO CHOQUEHUANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210208",
                    "fullubigeo" => "210208 MUÑANI - AZANGARO - PUNO",
                    "distrito" => "MUÑANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210209",
                    "fullubigeo" => "210209 POTONI - AZANGARO - PUNO",
                    "distrito" => "POTONI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210210",
                    "fullubigeo" => "210210 SAMAN - AZANGARO - PUNO",
                    "distrito" => "SAMAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210211",
                    "fullubigeo" => "210211 SAN ANTON - AZANGARO - PUNO",
                    "distrito" => "SAN ANTON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210212",
                    "fullubigeo" => "210212 SAN JOSE - AZANGARO - PUNO",
                    "distrito" => "SAN JOSE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210213",
                    "fullubigeo" => "210213 SAN JUAN DE SALINAS - AZANGARO - PUNO",
                    "distrito" => "SAN JUAN DE SALINAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210214",
                    "fullubigeo" => "210214 SANTIAGO DE PUPUJA - AZANGARO - PUNO",
                    "distrito" => "SANTIAGO DE PUPUJA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210215",
                    "fullubigeo" => "210215 TIRAPATA - AZANGARO - PUNO",
                    "distrito" => "TIRAPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210301",
                    "fullubigeo" => "210301 MACUSANI - CARABAYA - PUNO",
                    "distrito" => "MACUSANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210302",
                    "fullubigeo" => "210302 AJOYANI - CARABAYA - PUNO",
                    "distrito" => "AJOYANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210303",
                    "fullubigeo" => "210303 AYAPATA - CARABAYA - PUNO",
                    "distrito" => "AYAPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210304",
                    "fullubigeo" => "210304 COASA - CARABAYA - PUNO",
                    "distrito" => "COASA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210305",
                    "fullubigeo" => "210305 CORANI - CARABAYA - PUNO",
                    "distrito" => "CORANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210306",
                    "fullubigeo" => "210306 CRUCERO - CARABAYA - PUNO",
                    "distrito" => "CRUCERO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210307",
                    "fullubigeo" => "210307 ITUATA - CARABAYA - PUNO",
                    "distrito" => "ITUATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210308",
                    "fullubigeo" => "210308 OLLACHEA - CARABAYA - PUNO",
                    "distrito" => "OLLACHEA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210309",
                    "fullubigeo" => "210309 SAN GABAN - CARABAYA - PUNO",
                    "distrito" => "SAN GABAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210310",
                    "fullubigeo" => "210310 USICAYOS - CARABAYA - PUNO",
                    "distrito" => "USICAYOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210401",
                    "fullubigeo" => "210401 JULI - CHUCUITO - PUNO",
                    "distrito" => "JULI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210402",
                    "fullubigeo" => "210402 DESAGUADERO - CHUCUITO - PUNO",
                    "distrito" => "DESAGUADERO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210403",
                    "fullubigeo" => "210403 HUACULLANI - CHUCUITO - PUNO",
                    "distrito" => "HUACULLANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210404",
                    "fullubigeo" => "210404 KELLUYO - CHUCUITO - PUNO",
                    "distrito" => "KELLUYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210405",
                    "fullubigeo" => "210405 PISACOMA - CHUCUITO - PUNO",
                    "distrito" => "PISACOMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210406",
                    "fullubigeo" => "210406 POMATA - CHUCUITO - PUNO",
                    "distrito" => "POMATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210407",
                    "fullubigeo" => "210407 ZEPITA - CHUCUITO - PUNO",
                    "distrito" => "ZEPITA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210501",
                    "fullubigeo" => "210501 ILAVE - EL COLLAO - PUNO",
                    "distrito" => "ILAVE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210502",
                    "fullubigeo" => "210502 CAPAZO - EL COLLAO - PUNO",
                    "distrito" => "CAPAZO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210503",
                    "fullubigeo" => "210503 PILCUYO - EL COLLAO - PUNO",
                    "distrito" => "PILCUYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210504",
                    "fullubigeo" => "210504 SANTA ROSA - EL COLLAO - PUNO",
                    "distrito" => "SANTA ROSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210505",
                    "fullubigeo" => "210505 CONDURIRI - EL COLLAO - PUNO",
                    "distrito" => "CONDURIRI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210601",
                    "fullubigeo" => "210601 HUANCANE - HUANCANE - PUNO",
                    "distrito" => "HUANCANE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210602",
                    "fullubigeo" => "210602 COJATA - HUANCANE - PUNO",
                    "distrito" => "COJATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210603",
                    "fullubigeo" => "210603 HUATASANI - HUANCANE - PUNO",
                    "distrito" => "HUATASANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210604",
                    "fullubigeo" => "210604 INCHUPALLA - HUANCANE - PUNO",
                    "distrito" => "INCHUPALLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210605",
                    "fullubigeo" => "210605 PUSI - HUANCANE - PUNO",
                    "distrito" => "PUSI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210606",
                    "fullubigeo" => "210606 ROSASPATA - HUANCANE - PUNO",
                    "distrito" => "ROSASPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210607",
                    "fullubigeo" => "210607 TARACO - HUANCANE - PUNO",
                    "distrito" => "TARACO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210608",
                    "fullubigeo" => "210608 VILQUE CHICO - HUANCANE - PUNO",
                    "distrito" => "VILQUE CHICO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210701",
                    "fullubigeo" => "210701 LAMPA - LAMPA - PUNO",
                    "distrito" => "LAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210702",
                    "fullubigeo" => "210702 CABANILLA - LAMPA - PUNO",
                    "distrito" => "CABANILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210703",
                    "fullubigeo" => "210703 CALAPUJA - LAMPA - PUNO",
                    "distrito" => "CALAPUJA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210704",
                    "fullubigeo" => "210704 NICASIO - LAMPA - PUNO",
                    "distrito" => "NICASIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210705",
                    "fullubigeo" => "210705 OCUVIRI - LAMPA - PUNO",
                    "distrito" => "OCUVIRI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210706",
                    "fullubigeo" => "210706 PALCA - LAMPA - PUNO",
                    "distrito" => "PALCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210707",
                    "fullubigeo" => "210707 PARATIA - LAMPA - PUNO",
                    "distrito" => "PARATIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210708",
                    "fullubigeo" => "210708 PUCARA - LAMPA - PUNO",
                    "distrito" => "PUCARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210709",
                    "fullubigeo" => "210709 SANTA LUCIA - LAMPA - PUNO",
                    "distrito" => "SANTA LUCIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210710",
                    "fullubigeo" => "210710 VILAVILA - LAMPA - PUNO",
                    "distrito" => "VILAVILA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210801",
                    "fullubigeo" => "210801 AYAVIRI - MELGAR - PUNO",
                    "distrito" => "AYAVIRI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210802",
                    "fullubigeo" => "210802 ANTAUTA - MELGAR - PUNO",
                    "distrito" => "ANTAUTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210803",
                    "fullubigeo" => "210803 CUPI - MELGAR - PUNO",
                    "distrito" => "CUPI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210804",
                    "fullubigeo" => "210804 LLALLI - MELGAR - PUNO",
                    "distrito" => "LLALLI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210805",
                    "fullubigeo" => "210805 MACARI - MELGAR - PUNO",
                    "distrito" => "MACARI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210806",
                    "fullubigeo" => "210806 NUÑOA - MELGAR - PUNO",
                    "distrito" => "NUÑOA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210807",
                    "fullubigeo" => "210807 ORURILLO - MELGAR - PUNO",
                    "distrito" => "ORURILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210808",
                    "fullubigeo" => "210808 SANTA ROSA - MELGAR - PUNO",
                    "distrito" => "SANTA ROSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210809",
                    "fullubigeo" => "210809 UMACHIRI - MELGAR - PUNO",
                    "distrito" => "UMACHIRI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210901",
                    "fullubigeo" => "210901 MOHO - MOHO - PUNO",
                    "distrito" => "MOHO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210902",
                    "fullubigeo" => "210902 CONIMA - MOHO - PUNO",
                    "distrito" => "CONIMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210903",
                    "fullubigeo" => "210903 HUAYRAPATA - MOHO - PUNO",
                    "distrito" => "HUAYRAPATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "210904",
                    "fullubigeo" => "210904 TILALI - MOHO - PUNO",
                    "distrito" => "TILALI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211001",
                    "fullubigeo" => "211001 PUTINA - SAN ANTONIO DE PUTINA - PUNO",
                    "distrito" => "PUTINA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211002",
                    "fullubigeo" => "211002 ANANEA - SAN ANTONIO DE PUTINA - PUNO",
                    "distrito" => "ANANEA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211003",
                    "fullubigeo" => "211003 PEDRO VILCA APAZA - SAN ANTONIO DE PUTINA - PUNO",
                    "distrito" => "PEDRO VILCA APAZA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211004",
                    "fullubigeo" => "211004 QUILCAPUNCU - SAN ANTONIO DE PUTINA - PUNO",
                    "distrito" => "QUILCAPUNCU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211005",
                    "fullubigeo" => "211005 SINA - SAN ANTONIO DE PUTINA - PUNO",
                    "distrito" => "SINA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211101",
                    "fullubigeo" => "211101 JULIACA - SAN ROMAN - PUNO",
                    "distrito" => "JULIACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211102",
                    "fullubigeo" => "211102 CABANA - SAN ROMAN - PUNO",
                    "distrito" => "CABANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211103",
                    "fullubigeo" => "211103 CABANILLAS - SAN ROMAN - PUNO",
                    "distrito" => "CABANILLAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211104",
                    "fullubigeo" => "211104 CARACOTO - SAN ROMAN - PUNO",
                    "distrito" => "CARACOTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211201",
                    "fullubigeo" => "211201 SANDIA - SANDIA - PUNO",
                    "distrito" => "SANDIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211202",
                    "fullubigeo" => "211202 CUYOCUYO - SANDIA - PUNO",
                    "distrito" => "CUYOCUYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211203",
                    "fullubigeo" => "211203 LIMBANI - SANDIA - PUNO",
                    "distrito" => "LIMBANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211204",
                    "fullubigeo" => "211204 PATAMBUCO - SANDIA - PUNO",
                    "distrito" => "PATAMBUCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211205",
                    "fullubigeo" => "211205 PHARA - SANDIA - PUNO",
                    "distrito" => "PHARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211206",
                    "fullubigeo" => "211206 QUIACA - SANDIA - PUNO",
                    "distrito" => "QUIACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211207",
                    "fullubigeo" => "211207 SAN JUAN DEL ORO - SANDIA - PUNO",
                    "distrito" => "SAN JUAN DEL ORO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211208",
                    "fullubigeo" => "211208 YANAHUAYA - SANDIA - PUNO",
                    "distrito" => "YANAHUAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211209",
                    "fullubigeo" => "211209 ALTO INAMBARI - SANDIA - PUNO",
                    "distrito" => "ALTO INAMBARI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211210",
                    "fullubigeo" => "211210 SAN PEDRO DE PUTINA PUNCO - SANDIA - PUNO",
                    "distrito" => "SAN PEDRO DE PUTINA PUNCO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211301",
                    "fullubigeo" => "211301 YUNGUYO - YUNGUYO - PUNO",
                    "distrito" => "YUNGUYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211302",
                    "fullubigeo" => "211302 ANAPIA - YUNGUYO - PUNO",
                    "distrito" => "ANAPIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211303",
                    "fullubigeo" => "211303 COPANI - YUNGUYO - PUNO",
                    "distrito" => "COPANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211304",
                    "fullubigeo" => "211304 CUTURAPI - YUNGUYO - PUNO",
                    "distrito" => "CUTURAPI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211305",
                    "fullubigeo" => "211305 OLLARAYA - YUNGUYO - PUNO",
                    "distrito" => "OLLARAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211306",
                    "fullubigeo" => "211306 TINICACHI - YUNGUYO - PUNO",
                    "distrito" => "TINICACHI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "211307",
                    "fullubigeo" => "211307 UNICACHI - YUNGUYO - PUNO",
                    "distrito" => "UNICACHI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220101",
                    "fullubigeo" => "220101 MOYOBAMBA - MOYOBAMBA - SAN MARTÍN",
                    "distrito" => "MOYOBAMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220102",
                    "fullubigeo" => "220102 CALZADA - MOYOBAMBA - SAN MARTÍN",
                    "distrito" => "CALZADA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220103",
                    "fullubigeo" => "220103 HABANA - MOYOBAMBA - SAN MARTÍN",
                    "distrito" => "HABANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220104",
                    "fullubigeo" => "220104 JEPELACIO - MOYOBAMBA - SAN MARTÍN",
                    "distrito" => "JEPELACIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220105",
                    "fullubigeo" => "220105 SORITOR - MOYOBAMBA - SAN MARTÍN",
                    "distrito" => "SORITOR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220106",
                    "fullubigeo" => "220106 YANTALO - MOYOBAMBA - SAN MARTÍN",
                    "distrito" => "YANTALO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220201",
                    "fullubigeo" => "220201 BELLAVISTA - BELLAVISTA - SAN MARTÍN",
                    "distrito" => "BELLAVISTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220202",
                    "fullubigeo" => "220202 ALTO BIAVO - BELLAVISTA - SAN MARTÍN",
                    "distrito" => "ALTO BIAVO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220203",
                    "fullubigeo" => "220203 BAJO BIAVO - BELLAVISTA - SAN MARTÍN",
                    "distrito" => "BAJO BIAVO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220204",
                    "fullubigeo" => "220204 HUALLAGA - BELLAVISTA - SAN MARTÍN",
                    "distrito" => "HUALLAGA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220205",
                    "fullubigeo" => "220205 SAN PABLO - BELLAVISTA - SAN MARTÍN",
                    "distrito" => "SAN PABLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220206",
                    "fullubigeo" => "220206 SAN RAFAEL - BELLAVISTA - SAN MARTÍN",
                    "distrito" => "SAN RAFAEL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220301",
                    "fullubigeo" => "220301 SAN JOSE DE SISA - EL DORADO - SAN MARTÍN",
                    "distrito" => "SAN JOSE DE SISA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220302",
                    "fullubigeo" => "220302 AGUA BLANCA - EL DORADO - SAN MARTÍN",
                    "distrito" => "AGUA BLANCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220303",
                    "fullubigeo" => "220303 SAN MARTIN - EL DORADO - SAN MARTÍN",
                    "distrito" => "SAN MARTIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220304",
                    "fullubigeo" => "220304 SANTA ROSA - EL DORADO - SAN MARTÍN",
                    "distrito" => "SANTA ROSA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220305",
                    "fullubigeo" => "220305 SHATOJA - EL DORADO - SAN MARTÍN",
                    "distrito" => "SHATOJA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220401",
                    "fullubigeo" => "220401 SAPOSOA - HUALLAGA - SAN MARTÍN",
                    "distrito" => "SAPOSOA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220402",
                    "fullubigeo" => "220402 ALTO SAPOSOA - HUALLAGA - SAN MARTÍN",
                    "distrito" => "ALTO SAPOSOA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220403",
                    "fullubigeo" => "220403 EL ESLABON - HUALLAGA - SAN MARTÍN",
                    "distrito" => "EL ESLABON", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220404",
                    "fullubigeo" => "220404 PISCOYACU - HUALLAGA - SAN MARTÍN",
                    "distrito" => "PISCOYACU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220405",
                    "fullubigeo" => "220405 SACANCHE - HUALLAGA - SAN MARTÍN",
                    "distrito" => "SACANCHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220406",
                    "fullubigeo" => "220406 TINGO DE SAPOSOA - HUALLAGA - SAN MARTÍN",
                    "distrito" => "TINGO DE SAPOSOA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220501",
                    "fullubigeo" => "220501 LAMAS - LAMAS - SAN MARTÍN",
                    "distrito" => "LAMAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220502",
                    "fullubigeo" => "220502 ALONSO DE ALVARADO - LAMAS - SAN MARTÍN",
                    "distrito" => "ALONSO DE ALVARADO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220503",
                    "fullubigeo" => "220503 BARRANQUITA - LAMAS - SAN MARTÍN",
                    "distrito" => "BARRANQUITA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220504",
                    "fullubigeo" => "220504 CAYNARACHI - LAMAS - SAN MARTÍN",
                    "distrito" => "CAYNARACHI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220505",
                    "fullubigeo" => "220505 CUÑUMBUQUI - LAMAS - SAN MARTÍN",
                    "distrito" => "CUÑUMBUQUI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220506",
                    "fullubigeo" => "220506 PINTO RECODO - LAMAS - SAN MARTÍN",
                    "distrito" => "PINTO RECODO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220507",
                    "fullubigeo" => "220507 RUMISAPA - LAMAS - SAN MARTÍN",
                    "distrito" => "RUMISAPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220508",
                    "fullubigeo" => "220508 SAN ROQUE DE CUMBAZA - LAMAS - SAN MARTÍN",
                    "distrito" => "SAN ROQUE DE CUMBAZA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220509",
                    "fullubigeo" => "220509 SHANAO - LAMAS - SAN MARTÍN",
                    "distrito" => "SHANAO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220510",
                    "fullubigeo" => "220510 TABALOSOS - LAMAS - SAN MARTÍN",
                    "distrito" => "TABALOSOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220511",
                    "fullubigeo" => "220511 ZAPATERO - LAMAS - SAN MARTÍN",
                    "distrito" => "ZAPATERO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220601",
                    "fullubigeo" => "220601 JUANJUI - MARISCAL CACERES - SAN MARTÍN",
                    "distrito" => "JUANJUI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220602",
                    "fullubigeo" => "220602 CAMPANILLA - MARISCAL CACERES - SAN MARTÍN",
                    "distrito" => "CAMPANILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220603",
                    "fullubigeo" => "220603 HUICUNGO - MARISCAL CACERES - SAN MARTÍN",
                    "distrito" => "HUICUNGO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220604",
                    "fullubigeo" => "220604 PACHIZA - MARISCAL CACERES - SAN MARTÍN",
                    "distrito" => "PACHIZA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220605",
                    "fullubigeo" => "220605 PAJARILLO - MARISCAL CACERES - SAN MARTÍN",
                    "distrito" => "PAJARILLO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220701",
                    "fullubigeo" => "220701 PICOTA - PICOTA - SAN MARTÍN",
                    "distrito" => "PICOTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220702",
                    "fullubigeo" => "220702 BUENOS AIRES - PICOTA - SAN MARTÍN",
                    "distrito" => "BUENOS AIRES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220703",
                    "fullubigeo" => "220703 CASPISAPA - PICOTA - SAN MARTÍN",
                    "distrito" => "CASPISAPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220704",
                    "fullubigeo" => "220704 PILLUANA - PICOTA - SAN MARTÍN",
                    "distrito" => "PILLUANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220705",
                    "fullubigeo" => "220705 PUCACACA - PICOTA - SAN MARTÍN",
                    "distrito" => "PUCACACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220706",
                    "fullubigeo" => "220706 SAN CRISTOBAL - PICOTA - SAN MARTÍN",
                    "distrito" => "SAN CRISTOBAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220707",
                    "fullubigeo" => "220707 SAN HILARION - PICOTA - SAN MARTÍN",
                    "distrito" => "SAN HILARION", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220708",
                    "fullubigeo" => "220708 SHAMBOYACU - PICOTA - SAN MARTÍN",
                    "distrito" => "SHAMBOYACU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220709",
                    "fullubigeo" => "220709 TINGO DE PONASA - PICOTA - SAN MARTÍN",
                    "distrito" => "TINGO DE PONASA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220710",
                    "fullubigeo" => "220710 TRES UNIDOS - PICOTA - SAN MARTÍN",
                    "distrito" => "TRES UNIDOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220801",
                    "fullubigeo" => "220801 RIOJA - RIOJA - SAN MARTÍN",
                    "distrito" => "RIOJA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220802",
                    "fullubigeo" => "220802 AWAJUN - RIOJA - SAN MARTÍN",
                    "distrito" => "AWAJUN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220803",
                    "fullubigeo" => "220803 ELIAS SOPLIN VARGAS - RIOJA - SAN MARTÍN",
                    "distrito" => "ELIAS SOPLIN VARGAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220804",
                    "fullubigeo" => "220804 NUEVA CAJAMARCA - RIOJA - SAN MARTÍN",
                    "distrito" => "NUEVA CAJAMARCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220805",
                    "fullubigeo" => "220805 PARDO MIGUEL - RIOJA - SAN MARTÍN",
                    "distrito" => "PARDO MIGUEL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220806",
                    "fullubigeo" => "220806 POSIC - RIOJA - SAN MARTÍN",
                    "distrito" => "POSIC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220807",
                    "fullubigeo" => "220807 SAN FERNANDO - RIOJA - SAN MARTÍN",
                    "distrito" => "SAN FERNANDO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220808",
                    "fullubigeo" => "220808 YORONGOS - RIOJA - SAN MARTÍN",
                    "distrito" => "YORONGOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220809",
                    "fullubigeo" => "220809 YURACYACU - RIOJA - SAN MARTÍN",
                    "distrito" => "YURACYACU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220901",
                    "fullubigeo" => "220901 TARAPOTO - SAN MARTIN - SAN MARTÍN",
                    "distrito" => "TARAPOTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220902",
                    "fullubigeo" => "220902 ALBERTO LEVEAU - SAN MARTIN - SAN MARTÍN",
                    "distrito" => "ALBERTO LEVEAU", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220903",
                    "fullubigeo" => "220903 CACATACHI - SAN MARTIN - SAN MARTÍN",
                    "distrito" => "CACATACHI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220904",
                    "fullubigeo" => "220904 CHAZUTA - SAN MARTIN - SAN MARTÍN",
                    "distrito" => "CHAZUTA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220905",
                    "fullubigeo" => "220905 CHIPURANA - SAN MARTIN - SAN MARTÍN",
                    "distrito" => "CHIPURANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220906",
                    "fullubigeo" => "220906 EL PORVENIR - SAN MARTIN - SAN MARTÍN",
                    "distrito" => "EL PORVENIR", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220907",
                    "fullubigeo" => "220907 HUIMBAYOC - SAN MARTIN - SAN MARTÍN",
                    "distrito" => "HUIMBAYOC", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220908",
                    "fullubigeo" => "220908 JUAN GUERRA - SAN MARTIN - SAN MARTÍN",
                    "distrito" => "JUAN GUERRA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220909",
                    "fullubigeo" => "220909 LA BANDA DE SHILCAYO - SAN MARTIN - SAN MARTÍN",
                    "distrito" => "LA BANDA DE SHILCAYO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220910",
                    "fullubigeo" => "220910 MORALES - SAN MARTIN - SAN MARTÍN",
                    "distrito" => "MORALES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220911",
                    "fullubigeo" => "220911 PAPAPLAYA - SAN MARTIN - SAN MARTÍN",
                    "distrito" => "PAPAPLAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220912",
                    "fullubigeo" => "220912 SAN ANTONIO - SAN MARTIN - SAN MARTÍN",
                    "distrito" => "SAN ANTONIO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220913",
                    "fullubigeo" => "220913 SAUCE - SAN MARTIN - SAN MARTÍN",
                    "distrito" => "SAUCE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "220914",
                    "fullubigeo" => "220914 SHAPAJA - SAN MARTIN - SAN MARTÍN",
                    "distrito" => "SHAPAJA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "221001",
                    "fullubigeo" => "221001 TOCACHE - TOCACHE - SAN MARTÍN",
                    "distrito" => "TOCACHE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "221002",
                    "fullubigeo" => "221002 NUEVO PROGRESO - TOCACHE - SAN MARTÍN",
                    "distrito" => "NUEVO PROGRESO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "221003",
                    "fullubigeo" => "221003 POLVORA - TOCACHE - SAN MARTÍN",
                    "distrito" => "POLVORA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "221004",
                    "fullubigeo" => "221004 SHUNTE - TOCACHE - SAN MARTÍN",
                    "distrito" => "SHUNTE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "221005",
                    "fullubigeo" => "221005 UCHIZA - TOCACHE - SAN MARTÍN",
                    "distrito" => "UCHIZA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230101",
                    "fullubigeo" => "230101 TACNA - TACNA - TACNA",
                    "distrito" => "TACNA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230102",
                    "fullubigeo" => "230102 ALTO DE LA ALIANZA - TACNA - TACNA",
                    "distrito" => "ALTO DE LA ALIANZA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230103",
                    "fullubigeo" => "230103 CALANA - TACNA - TACNA",
                    "distrito" => "CALANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230104",
                    "fullubigeo" => "230104 CIUDAD NUEVA - TACNA - TACNA",
                    "distrito" => "CIUDAD NUEVA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230105",
                    "fullubigeo" => "230105 INCLAN - TACNA - TACNA",
                    "distrito" => "INCLAN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230106",
                    "fullubigeo" => "230106 PACHIA - TACNA - TACNA",
                    "distrito" => "PACHIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230107",
                    "fullubigeo" => "230107 PALCA - TACNA - TACNA",
                    "distrito" => "PALCA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230108",
                    "fullubigeo" => "230108 POCOLLAY - TACNA - TACNA",
                    "distrito" => "POCOLLAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230109",
                    "fullubigeo" => "230109 SAMA - TACNA - TACNA",
                    "distrito" => "SAMA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230110",
                    "fullubigeo" => "230110 CORONEL GREGORIO ALBARRACIN LANCHIPA - TACNA - TACNA",
                    "distrito" => "CORONEL GREGORIO ALBARRACIN LANCHIPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230201",
                    "fullubigeo" => "230201 CANDARAVE - CANDARAVE - TACNA",
                    "distrito" => "CANDARAVE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230202",
                    "fullubigeo" => "230202 CAIRANI - CANDARAVE - TACNA",
                    "distrito" => "CAIRANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230203",
                    "fullubigeo" => "230203 CAMILACA - CANDARAVE - TACNA",
                    "distrito" => "CAMILACA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230204",
                    "fullubigeo" => "230204 CURIBAYA - CANDARAVE - TACNA",
                    "distrito" => "CURIBAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230205",
                    "fullubigeo" => "230205 HUANUARA - CANDARAVE - TACNA",
                    "distrito" => "HUANUARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230206",
                    "fullubigeo" => "230206 QUILAHUANI - CANDARAVE - TACNA",
                    "distrito" => "QUILAHUANI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230301",
                    "fullubigeo" => "230301 LOCUMBA - JORGE BASADRE - TACNA",
                    "distrito" => "LOCUMBA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230302",
                    "fullubigeo" => "230302 ILABAYA - JORGE BASADRE - TACNA",
                    "distrito" => "ILABAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230303",
                    "fullubigeo" => "230303 ITE - JORGE BASADRE - TACNA",
                    "distrito" => "ITE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230401",
                    "fullubigeo" => "230401 TARATA - TARATA - TACNA",
                    "distrito" => "TARATA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230402",
                    "fullubigeo" => "230402 HEROES ALBARRACIN - TARATA - TACNA",
                    "distrito" => "HEROES ALBARRACIN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230403",
                    "fullubigeo" => "230403 ESTIQUE - TARATA - TACNA",
                    "distrito" => "ESTIQUE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230404",
                    "fullubigeo" => "230404 ESTIQUE-PAMPA - TARATA - TACNA",
                    "distrito" => "ESTIQUE-PAMPA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230405",
                    "fullubigeo" => "230405 SITAJARA - TARATA - TACNA",
                    "distrito" => "SITAJARA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230406",
                    "fullubigeo" => "230406 SUSAPAYA - TARATA - TACNA",
                    "distrito" => "SUSAPAYA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230407",
                    "fullubigeo" => "230407 TARUCACHI - TARATA - TACNA",
                    "distrito" => "TARUCACHI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "230408",
                    "fullubigeo" => "230408 TICACO - TARATA - TACNA",
                    "distrito" => "TICACO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "240101",
                    "fullubigeo" => "240101 TUMBES - TUMBES - TUMBES",
                    "distrito" => "TUMBES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "240102",
                    "fullubigeo" => "240102 CORRALES - TUMBES - TUMBES",
                    "distrito" => "CORRALES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "240103",
                    "fullubigeo" => "240103 LA CRUZ - TUMBES - TUMBES",
                    "distrito" => "LA CRUZ", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "240104",
                    "fullubigeo" => "240104 PAMPAS DE HOSPITAL - TUMBES - TUMBES",
                    "distrito" => "PAMPAS DE HOSPITAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "240105",
                    "fullubigeo" => "240105 SAN JACINTO - TUMBES - TUMBES",
                    "distrito" => "SAN JACINTO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "240106",
                    "fullubigeo" => "240106 SAN JUAN DE LA VIRGEN - TUMBES - TUMBES",
                    "distrito" => "SAN JUAN DE LA VIRGEN", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "240201",
                    "fullubigeo" => "240201 ZORRITOS - CONTRALMIRANTE VILLAR - TUMBES",
                    "distrito" => "ZORRITOS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "240202",
                    "fullubigeo" => "240202 CASITAS - CONTRALMIRANTE VILLAR - TUMBES",
                    "distrito" => "CASITAS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "240203",
                    "fullubigeo" => "240203 CANOAS DE PUNTA SAL - CONTRALMIRANTE VILLAR - TUMBES",
                    "distrito" => "CANOAS DE PUNTA SAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "240301",
                    "fullubigeo" => "240301 ZARUMILLA - ZARUMILLA - TUMBES",
                    "distrito" => "ZARUMILLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "240302",
                    "fullubigeo" => "240302 AGUAS VERDES - ZARUMILLA - TUMBES",
                    "distrito" => "AGUAS VERDES", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "240303",
                    "fullubigeo" => "240303 MATAPALO - ZARUMILLA - TUMBES",
                    "distrito" => "MATAPALO", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "240304",
                    "fullubigeo" => "240304 PAPAYAL - ZARUMILLA - TUMBES",
                    "distrito" => "PAPAYAL", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250101",
                    "fullubigeo" => "250101 CALLERIA - CORONEL PORTILLO - UCAYALI",
                    "distrito" => "CALLERIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250102",
                    "fullubigeo" => "250102 CAMPOVERDE - CORONEL PORTILLO - UCAYALI",
                    "distrito" => "CAMPOVERDE", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250103",
                    "fullubigeo" => "250103 IPARIA - CORONEL PORTILLO - UCAYALI",
                    "distrito" => "IPARIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250104",
                    "fullubigeo" => "250104 MASISEA - CORONEL PORTILLO - UCAYALI",
                    "distrito" => "MASISEA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250105",
                    "fullubigeo" => "250105 YARINACOCHA - CORONEL PORTILLO - UCAYALI",
                    "distrito" => "YARINACOCHA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250106",
                    "fullubigeo" => "250106 NUEVA REQUENA - CORONEL PORTILLO - UCAYALI",
                    "distrito" => "NUEVA REQUENA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250107",
                    "fullubigeo" => "250107 MANANTAY - CORONEL PORTILLO - UCAYALI",
                    "distrito" => "MANANTAY", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250201",
                    "fullubigeo" => "250201 RAYMONDI - ATALAYA - UCAYALI",
                    "distrito" => "RAYMONDI", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250202",
                    "fullubigeo" => "250202 SEPAHUA - ATALAYA - UCAYALI",
                    "distrito" => "SEPAHUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250203",
                    "fullubigeo" => "250203 TAHUANIA - ATALAYA - UCAYALI",
                    "distrito" => "TAHUANIA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250204",
                    "fullubigeo" => "250204 YURUA - ATALAYA - UCAYALI",
                    "distrito" => "YURUA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250301",
                    "fullubigeo" => "250301 PADRE ABAD - PADRE ABAD - UCAYALI",
                    "distrito" => "PADRE ABAD", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250302",
                    "fullubigeo" => "250302 IRAZOLA - PADRE ABAD - UCAYALI",
                    "distrito" => "IRAZOLA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250303",
                    "fullubigeo" => "250303 CURIMANA - PADRE ABAD - UCAYALI",
                    "distrito" => "CURIMANA", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ),
                array(
                    "ubigeo" => "250401",
                    "fullubigeo" => "250401 PURUS - PURUS - UCAYALI",
                    "distrito" => "PURUS", "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                )
            
        ];

        DB::table('ubigeos')->insert($datos);
    }
}
