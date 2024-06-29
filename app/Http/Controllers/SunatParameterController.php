<?php

namespace App\Http\Controllers;

use App\Http\Resources\SunatParameterCollection;
use App\Http\Resources\SunatParameterResource;
use App\Models\Empresa;
use App\Models\SunatParameters;
use Illuminate\Http\Request;

class SunatParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
        return new SunatParameterCollection(SunatParameters::all());
    }

    public function parametros()
    {

        $sunat = SunatParameters::getSunatParams('PRO');
        //
        return new SunatParameterResource($sunat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $sunat = new SunatParameters();

        $sunat->client_id = $request->client_id;
        $sunat->client_secret = $request->client_secret;
        $sunat->username = $request->username;
        $sunat->password = $request->password;
        $sunat->grant_type = $request->grant_type;
        $sunat->endpointurl = $request->endpointurl;
        $sunat->clavecertificado = $request->clavecertificado;
        $sunat->scope = $request->scope;
        $sunat->env = $request->env;
        $sunat->urlsend = $request->urlsend;
        $sunat->urlconsult = $request->urlconsult;

        $id_empresa = Empresa::all()->first()->id;
        $sunat->id_empresa = $id_empresa;

        if ($request->file('file')->isValid()) {

            $convert = new CertificateController();

            $fields = [
                'file' => $request->file,
                'clavecertificado' => $request->clavecertificado
            ];
            $newRequest = new Request($fields);

            $response = $convert->converCert($newRequest);
            if (!$response['exito']) {
                return [
                    'sunat' => $request,
                    'error'=> $response['error']
                ];
            }else{
                $sunat->certificado=$response['base64'];
            }
        }else{
            return [
                'sunat' => $request,
                'error'=>'Archivo no valido o no existente'
            ];
        }

        $sunat->save();

        $id = $sunat->id;

        return [
            'message' => "Parametros con id $id Insertado con exito",
            'persona' => $request->all()
        ];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SunatParameters $sunat)
    {
        //

        $data = $request->all();

        $convert = new CertificateController();


        if ($request->file('file')->isValid()) {

            $fields = [
                'file' => $request->file,
                'clavecertificado' => $request->clavecertificado
            ];
            $newRequest = new Request($fields);

            $response = $convert->converCert($newRequest);
            if (!$response['exito']) {
                return [
                    'sunat' => $data,
                    'error'=> $response['error']
                ];
            }else{
                $data['certificado']=$response['base64'];
            }
        }

        $sunat->update($data);
        $sunat->refresh();
        return [
            'sunat' => $sunat
        ];
        










        // foreach ($data as $key => $value) {
        //     if (is_null($value)) {
        //         $data[$key] = '';
        //     }
        // }

        // $data["id_tipodocumento"] = TipoDocumento::where('tipoDoc',$request->tipoDoc)->value('id');
        // $cliente->update($data);
        // $cliente->refresh();


        // return [
        //     'sunat' => $response
        // ];
    }

    public function actualizar(Request $request)
    {
        return [
            'sunat' => $request->file('file')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
