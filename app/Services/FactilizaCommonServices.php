<?php

namespace App\Services;

use Error;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class FactilizaCommonServices
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getData(string $type, string $nro)
    {
        $url = "https://api.factiliza.com/pe/v1/$type/info/$nro";

        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI5NCIsIm5hbWUiOiJDYXJsb3MgTWFxdWVyYSIsImVtYWlsIjoic2lzdGVtYXNAZWxjZW50ZW5hcmlvLmNvbS5wZSIsImh0dHA6Ly9zY2hlbWFzLm1pY3Jvc29mdC5jb20vd3MvMjAwOC8wNi9pZGVudGl0eS9jbGFpbXMvcm9sZSI6ImNvbnN1bHRvciJ9.Mpwk0uE3BirZSwfdk_00bIXOXrFLt5sJZjqMvD6ixJc';

        try {
            $response = $this->client->request('GET', $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept'        => 'application/json',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            // $data= $this->cleanData($data['data']);

            

            // Aquí puedes estructurar la respuesta según tus necesidades
            return [
                'status' => $data['status'],
                'message'=> $data['message'],
                'persona' =>[
                    "numero"=> $data['data']['numero'],
                    "nombreRazonSocial"=>$type==='ruc'?trim($data['data']['nombre_o_razon_social']):trim($data['data']['nombre_completo']),
                    "nombres"=>$type==='dni'?trim($data['data']['nombres']):'',
                    "apellidos"=>$type==='dni'?trim($data['data']['apellido_paterno']). " ".trim($data['data']['apellido_materno']):'',
                    "direccionCompleta"=>trim($data['data']['direccion_completa']),
                    "ubigeo"=>$data['data']['ubigeo_sunat'],
                ]

            ];
        } catch (ClientException $e) {
            // Manejo de errores 4xx específicos
            $response = $e->getResponse();
            // $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody(), true);

            return [
                'status' => 'error',
                'message' => $body['message'] ?? 'Hubo un error en la consulta',
            ];
        } catch (RequestException $e) {
            // Manejo de errores generales
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $body = $response->getBody();
            }
            return [
                'status' => 'error',
                'message' => 'Failed to fetch data',
            ];
        } catch (\Exception $e) {
            // Manejo de cualquier otro tipo de excepción
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }
  
}
