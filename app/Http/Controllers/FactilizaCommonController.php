<?php

namespace App\Http\Controllers;

use App\Services\FactilizaCommonServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FactilizaCommonController extends Controller
{
    //

    protected $factilizaCommonServices;

    public function __construct(FactilizaCommonServices $factilizaCommonServices)
    {
        $this->factilizaCommonServices = $factilizaCommonServices;
    }

    public function PersonalDataFactiliza(Request $request)
    {
        $nro = $request->query('nro');
        $type = $request->query('type');

        $response = $this->factilizaCommonServices->getData($type, $nro);

        return response()->json($response);
    }

    public function CrearCANT(Request $request)
    {


        $data = $request->data;



        $defanexos = $this->defAnexos();
        $arrayFormated = [];

        foreach ($data as $item) {

            $response = $this->factilizaCommonServices->getData(strlen($item) === 8 ? 'dni' : 'ruc', $item);



            $array = $response;


            $it= $this->setAnexos($array, strlen($item) === 8 ? 'dni' : 'ruc');

            
            $arrayFormated[] = $it;
            # code...
        }


       

        

        
    }



    private function properText($str)
    {
        $search = explode(",", "á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã*,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ*,ÃÃ³,ÃÃº,ÃÃ±,Ã“,Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,ü");
        $replace = explode(",", "a,e,i,o,u,ñ,A,E,I,O,U,Ñ,a,e,i,o,u,ñ,A,E,I,O,U,Ñ,O,A,E,I,U,\",\",¿,&uuml;");
        $str = str_replace($search, $replace, $str);
        return $str;
    }
}
