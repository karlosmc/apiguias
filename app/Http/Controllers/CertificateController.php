<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificateController extends Controller
{
    //

    public function convertPfxToPem(Request $request)
    {

        $pfxFile = $request->file('file');
        $password = $request->input('clavecertificado');

        // Leer el contenido del archivo pfx
        // $path = $pfxFile->store('certificates');

        // // Leer el contenido del archivo PFX
        // $pfxContent = file_get_contents(storage_path('app/' . $path));
        $pfxContent = file_get_contents($pfxFile->getPathname());

        // Almacenar la clave privada y el certificado
        $certs = [];
        if (!openssl_pkcs12_read($pfxContent, $certs, $password)) {
            // return response()->json(['error' => 'Invalid PFX file or incorrect password'], 400);

            return [
                'exito'=>false,
                'base64'=>'',
                'error' => "PFX incorrecto o clave incorrecta",
            ];
        }

        // Combinar clave privada y certificado en un archivo .pem
        $pem = $certs['cert'] . $certs['pkey'];

        // $pemPath = 'certificates/' . pathinfo($pfxFile->getClientOriginalName(), PATHINFO_FILENAME) . '.pem';
        // file_put_contents(storage_path('app/' . $pemPath), $pem);

        $pemBase64 = base64_encode($pem);
        
        return [
            'exito'=>true,
            'base64'=>$pemBase64,
            'error' => "",
        ];
    }

    public function converCert(Request $request)
    {

        $pfxFile = $request->file;
        $password = $request->input('clavecertificado');

        // Leer el contenido del archivo pfx
        // $path = $pfxFile->store('certificates');

        // // Leer el contenido del archivo PFX
        // $pfxContent = file_get_contents(storage_path('app/' . $path));
        $pfxContent = file_get_contents($pfxFile->getPathname());

        // Almacenar la clave privada y el certificado
        $certs = [];
        if (!openssl_pkcs12_read($pfxContent, $certs, $password)) {
            // return response()->json(['error' => 'Invalid PFX file or incorrect password'], 400);

            return [
                'exito'=>false,
                'base64'=>'',
                'error' => "PFX incorrecto o clave incorrecta",
            ];
        }

        // Combinar clave privada y certificado en un archivo .pem
        $pem = $certs['cert'] . $certs['pkey'];

        // $pemPath = 'certificates/' . pathinfo($pfxFile->getClientOriginalName(), PATHINFO_FILENAME) . '.pem';
        // file_put_contents(storage_path('app/' . $pemPath), $pem);

        $pemBase64 = base64_encode($pem);
        
        return [
            'exito'=>true,
            'base64'=>$pemBase64,
            'error' => "",
        ];
    }
    
}
