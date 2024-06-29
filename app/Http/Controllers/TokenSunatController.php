<?php

namespace App\Http\Controllers;

use App\Http\Resources\TokenSunatResource;
use App\Models\Empresa;
use App\Models\SunatParameters;
use App\Models\TokenSunat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TokenSunatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $token = TokenSunat::latest('created_at')->first();
        return $token;

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
        
        $parameters = SunatParameters::getSunatParams('PRO');

        if (!$parameters) {
            return response()->json(['error' => 'Sunat parameters no exiten'], 404);
        }

        $requestData = [
            'client_id' => $parameters->client_id,
            'username' => $parameters->username,
            'password' => $parameters->password,
            'grant_type' => $parameters->grant_type,
            'client_secret' => $parameters->client_secret,
            'scope' => $parameters->scope,
        ];

        $newUrl = self::getEndPointUrl('client_id',$parameters->client_id,$parameters->endpointurl);

        $response = Http::asForm()->post($newUrl, $requestData);
        if ($response->successful()) {
            $json = $response->json();
            

            $token = new TokenSunat();
            $token->access_token=$json['access_token'];
            $token->token_type=$json['token_type'];
            $token->expires_in=$json['expires_in'];
            $token->id_empresa = Empresa::first()->id;
            $token->expiryTime = Carbon::now()->timestamp + $json['expires_in'];

            $token->save();
            $token->refresh();
            return $token;
        }
        return [
            'error' => 'Failed to fetch token',
            'details' => $response->body()
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
    public function update(Request $request, $id)
    {
        //
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

    public static function getEndPointUrl($replace , $client_id, $endpoint)
    {
            return str_replace($replace,$client_id , $endpoint);
    }
}
