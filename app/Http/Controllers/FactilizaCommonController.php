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
        
        $response = $this->factilizaCommonServices->getData($type,$nro);

        return response()->json($response);
    }
}
