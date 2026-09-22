<?php

namespace App\Http\Controllers;

use App\Models\Despatch;
use Illuminate\Http\Request;
use App\Models\EstadoElectronico;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Http\Resources\DespatchCollection;
use App\Http\Resources\EstadoElectronicoResource;
use App\Http\Resources\EstadoElectronicoCollection;
use ZipArchive;

class EstadoElectronicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $estadoElectronico = EstadoElectronico::all();

        $query = EstadoElectronico::query();

        $estadoElectronico = $query
            ->with('despatch.usuario')
            ->orderBy('id', 'desc')
            ->orderBy('fecha', 'desc')
            ->orderBy('serie', 'desc')
            ->orderBy('numero', 'desc')
            ->get();

        return new EstadoElectronicoCollection($estadoElectronico);
    }

    public function buscar(Request $request)
    {
        $query = EstadoElectronico::with('despatch.usuario');

        $user = Auth::user();

        $id = $user->id;

        if ($user->perfil !== 'admin') {
            $query->whereHas('despatch', function ($query) use ($id) {
                $query->where('id_user', $id);
            });
        }

        if ($request->has('serie')) {
            $query->where('serie', $request->input('serie'));
        }

        if ($request->has('numero')) {
            $query->where('numero', $request->input('numero'));
        }

        if ($request->has('fecha')) {
            $query->where('fecha', $request->input('fecha'));
        }

        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $query->whereBetween('fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')]);
        }
        
        if ($request->has('estado')) {
            $query->where('estado', $request->input('estado'));
        }

        // if ($request->has('rznSocial')) {
        //     $query->where('rznSocial', 'like', '%' . $request->input('rznSocial') . '%');
        // }

        // if ($request->has('fav')) {
        //     $query->where('fav', $request->input('fav'));
        // }

        $query
            ->orderBy('id', 'desc')
            ->orderBy('fecha', 'desc')
            ->orderBy('serie', 'desc')
            ->orderBy('numero', 'desc')
            ->get();

        // if ($user->perfil === 'admin')
        // {
        //     $this->reporte($fecha,$serie,$numero);
        // }
        $perPage = $request->input('per_page', 10); // Por defecto 10 por página

        $estadoElectronico = $query->paginate($perPage);


        return [
            'success' => true,
            'pagination' => [
                'current_page' => $estadoElectronico->currentPage(),
                'per_page' => $estadoElectronico->perPage(),
                'total' => $estadoElectronico->total(),
                'last_page' => $estadoElectronico->lastPage(),
                'from' => $estadoElectronico->firstItem(),
                'to' => $estadoElectronico->lastItem(),
            ],
            'data' => EstadoElectronicoResource::collection($estadoElectronico),
        ];

        // return new EstadoElectronicoCollection($estadoElectronico);
    }

    public function descargar(Request $request)
    {
        $query = EstadoElectronico::with('despatch.usuario');

        $user = Auth::user();
        $id = $user->id;

        $url = ENV('DB_ELECTRONICO_HOST', '');

        if ($user->perfil !== 'admin') {
            $query->whereHas('despatch', function ($query) use ($id) {
                $query->where('id_user', $id);
            });
        }

        if ($request->has('serie')) {
            $query->where('serie', $request->input('serie'));
        }

        if ($request->has('numero')) {
            $query->where('numero', $request->input('numero'));
        }

        if ($request->has('fecha')) {
            $query->where('fecha', $request->input('fecha'));
        }

        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $query->whereBetween('fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')]);
        }
        
        if ($request->has('estado')) {
            $query->where('estado', $request->input('estado'));
        }

        $estadosElectronicos = $query->get();

        // return response()->json([
        //     'success' => true,
        //     'data' => "hola",
        // ]);
        
        // Validar que existan registros
        if ($estadosElectronicos->isEmpty()) {
            return response()->json([
                'error' => 'No se encontraron registros con los filtros especificados',
                'message' => 'No hay documentos para descargar'
            ], 404);
        }

        $type = $request->input('type', 'pdf'); // Por defecto PDF

        // Validar tipo
        $tiposValidos = ['pdf', 'xml', 'cdr', 'hash'];
        if (!in_array($type, $tiposValidos)) {
            return response()->json([
                'error' => 'Tipo de archivo no válido',
                'message' => 'Los tipos válidos son: ' . implode(', ', $tiposValidos)
            ], 400);
        }

        // Si es tipo hash, generar Excel
        if ($type === 'hash') {
            return $this->generarExcelHash($estadosElectronicos);
        }

        // Para otros tipos (pdf, xml, cdr), generar ZIP
        return $this->generarZipArchivos($estadosElectronicos, $type,$url);
    }

    private function generarExcelHash($estadosElectronicos)
    {
        try {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Encabezados
            $encabezados = ['Fecha','Serie', 'Número', 'Hash QR'];
            $sheet->fromArray($encabezados, null, 'A1');

            $fila = 2;
            foreach ($estadosElectronicos as $estado) {
                $sheet->setCellValue("A$fila", $estado->fecha);
                $sheet->setCellValue("B$fila", $estado->serie);
                $sheet->setCellValue("C$fila", $estado->numero);
                $sheet->setCellValue("D$fila", $estado->hashQr ?? 'N/A');
                $fila++;
            }

            // Guardar archivo Excel
            $writer = new Xlsx($spreadsheet);
            $filename = 'hash_qr_' . date('Y-m-d_H-i-s') . '.xlsx';
            $tempFile = tempnam(sys_get_temp_dir(), $filename);
            $writer->save($tempFile);

            return response()->download($tempFile, $filename, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Access-Control-Expose-Headers' => 'Content-Disposition'
            ])->deleteFileAfterSend(true);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al generar archivo Excel',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function generarZipArchivos($estadosElectronicos, $type,$url)
    {
        try {
            // Mapear tipos a columnas de la base de datos
            $columnMapping = [
                'xml' => 'rutaXml',
                'pdf' => 'rutaPdf',
                'cdr' => 'rutaCdr'
            ];

            if (!isset($columnMapping[$type])) {
                return response()->json(['error' => 'Tipo de archivo no válido'], 400);
            }

            $columnaRuta = $columnMapping[$type];
            // echo $columnaRuta;

            // Crear archivo temporal para ZIP
            $zipFilename = 'documentos_' . $type . '_' . date('Y-m-d_H-i-s') . '.zip';
            $zipPath = tempnam(sys_get_temp_dir(), $zipFilename);
            
            $zip = new ZipArchive();
            if ($zip->open($zipPath, ZipArchive::CREATE) !== TRUE) {
                return response()->json(['error' => 'No se pudo crear el archivo ZIP'], 500);
            }

            $archivosNoEncontrados = [];
            $archivosEncontrados = 0;

            foreach ($estadosElectronicos as $estado) {
                $rutaArchivo = trim($url . $estado->$columnaRuta);
                $nombreDocumento = $estado->serie . '-' . $estado->numero;
                

                // Verificar si es una URL HTTP o una ruta local
                if (filter_var($rutaArchivo, FILTER_VALIDATE_URL)) {
                    // Es una URL, intentar descargar el contenido
                    $contenidoArchivo = $this->descargarArchivoDesdeURL($rutaArchivo);
                    
                    if ($contenidoArchivo !== false) {
                        // Si se descargó correctamente, agregarlo al ZIP
                        $extension = pathinfo($rutaArchivo, PATHINFO_EXTENSION);
                        $nombreArchivo = $nombreDocumento . '.' . $extension;
                        $zip->addFromString($nombreArchivo, $contenidoArchivo);
                        $archivosEncontrados++;
                    } else {
                        // Si no se pudo descargar, agregar a la lista de no encontrados
                        $archivosNoEncontrados[] = $nombreDocumento;
                    }
                } else {
                    // Es una ruta local, usar file_exists
                    if ($rutaArchivo && file_exists($rutaArchivo)) {
                        $extension = pathinfo($rutaArchivo, PATHINFO_EXTENSION);
                        $nombreArchivo = $nombreDocumento . '.' . $extension;
                        $zip->addFile($rutaArchivo, $nombreArchivo);
                        $archivosEncontrados++;
                    } else {
                        $archivosNoEncontrados[] = $nombreDocumento;
                    }
                }
            }

            // Si hay archivos no encontrados, crear un archivo TXT
            if (!empty($archivosNoEncontrados)) {
                $contenidoTxt = "Archivos no encontrados:\n\n";
                foreach ($archivosNoEncontrados as $archivo) {
                    $contenidoTxt .= $archivo . " - no existe\n";
                }
                
                $txtFilename = 'archivos_no_encontrados.txt';
                $txtPath = tempnam(sys_get_temp_dir(), $txtFilename);
                file_put_contents($txtPath, $contenidoTxt);
                
                $zip->addFile($txtPath, $txtFilename);
            }

            $zip->close();

            // Limpiar archivo TXT temporal si se creó
            if (!empty($archivosNoEncontrados) && isset($txtPath) && file_exists($txtPath)) {
                unlink($txtPath);
            }

            // Si no se encontró ningún archivo, retornar error
            if ($archivosEncontrados === 0) {
                unlink($zipPath); // Limpiar ZIP vacío
                return response()->json([
                    'error' => 'No se encontraron archivos para descargar',
                    'message' => 'Todos los archivos solicitados no existen en el servidor'
                ], 404);
            }

            return response()->download($zipPath, $zipFilename, [
                'Content-Type' => 'application/zip',
                'Content-Disposition' => 'attachment; filename="' . $zipFilename . '"',
                'Access-Control-Expose-Headers' => 'Content-Disposition'
            ])->deleteFileAfterSend(true);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al generar archivo ZIP',
                'message' => $e->getMessage()
            ], 500);
        }
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

        $query = EstadoElectronico::query();

        if ($id) {
            $query->whereHas('despatch', function ($query) use ($id) {
                $query->where('id_user', $id);
            });
        }

        $estadoElectronico = $query
            ->with('despatch.usuario')
            ->orderBy('id', 'desc')
            ->orderBy('fecha', 'desc')
            ->orderBy('serie', 'desc')
            ->orderBy('numero', 'desc')
            ->get();

        return new EstadoElectronicoCollection($estadoElectronico);
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
        $estadoElectronico = EstadoElectronico::find($id);



        $data = $request->all();

        // print_r($estadoElectronico::all());

        // $data["id_tipodocumento"] = TipoDocumento::where('tipoDoc',$request->tipoDoc)->value('id');
        $estadoElectronico->update($data);
        $estadoElectronico->refresh();
        return [
            'electronico' => $estadoElectronico
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

    public function reporte(string $fecha, string $serie, string $numero)
    {
        $query = Despatch::query();

        if ($serie !== '') {
            $query->where('serie', $serie);
        }

        if ($fecha !== '') {
            $query->where(DB::raw('DATE(fechaEmision)'), $fecha);
        }

        if ($numero !== '') {
            $query->where('correlativo', $numero);
        }

        $guiasQuery = $query->with(['clientes', 'terceros', 'compradores', 'envio', 'details', 'electronico', 'envio.ubicaciones', 'usuario', 'envio.motivoTraslado'])
            ->orderBy('fechaEmision')
            ->orderBy('serie')
            ->orderBy('correlativo')
            ->get();

        $guias = new DespatchCollection($guiasQuery);



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $encabezados = [
            'ID',
            'Serie',
            'Correlativo',
            'Fecha Emisión',
            'Cliente - Razón Social',
            'Cliente - Número de Documento',
            'Tercero - Razón Social',
            'Tercero - Número de Documento',
            'Observación',
            'Peso Total',
            'Unidad de Peso',
            'Fecha Traslado',
            'Tipo de Traslado',
            'Partida - Dirección',
            'Llegada - Dirección',
            'Producto - Código',
            'Producto - Descripción',
            'Producto - Cantidad',
            'Producto - U. Medida',
            'Usuario',
            'Estado SUNAT',
        ];

        $sheet->fromArray($encabezados, null, 'A1');

        $fila = 2; // Comienza desde la fila 2
        foreach ($guias as $documento) {
            foreach ($documento['details'] as $producto) {
                $sheet->setCellValue("A$fila", $documento['id']);
                $sheet->setCellValue("B$fila", $documento['serie']);
                $sheet->setCellValue("C$fila", $documento['correlativo']);
                $sheet->setCellValue("D$fila", $documento['fechaEmision']);
                $sheet->setCellValue("E$fila", $documento['clientes']['rznSocial'] ?? 'N/A');
                $sheet->setCellValue("F$fila", $documento['clientes']['numDoc'] ?? 'N/A');
                $sheet->setCellValue("G$fila", $documento['terceros']['rznSocial'] ?? 'N/A');
                $sheet->setCellValue("H$fila", $documento['terceros']['numDoc'] ?? 'N/A');
                $sheet->setCellValue("I$fila", $documento['observacion']);
                $sheet->setCellValue("J$fila", $documento['envio']['pesoTotal']);
                $sheet->setCellValue("K$fila", $documento['envio']['undPesoTotal']);
                $sheet->setCellValue("L$fila", $documento['envio']['fecTraslado']);
                $sheet->setCellValue("M$fila", $documento['envio']['motivoTraslado']['desTraslado']);
                $sheet->setCellValue("N$fila", $documento['envio']['ubicaciones'][0]['direccion'] ?? 'N/A');
                $sheet->setCellValue("O$fila", $documento['envio']['ubicaciones'][1]['direccion'] ?? 'N/A');
                $sheet->setCellValue("P$fila", $producto['codigo']);
                $sheet->setCellValue("Q$fila", $producto['descripcion']);
                $sheet->setCellValue("R$fila", $producto['cantidad']);
                $sheet->setCellValue("S$fila", $producto['unidad']);
                $sheet->setCellValue("T$fila", $documento['usuario']['name'] ?? 'N/A');
                $sheet->setCellValue("U$fila", $documento['electronico']['descripcion'] ?? 'N/A');

                $fila++;
            }
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Documentos.xlsx';
        // $filename = 'documentos_prueba.xlsx';
        $path = storage_path('app/temp/' . $filename);

        // Asegúrate de que el directorio exista
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $writer->save($path);

        // return response()->json(['file_path' => $path]);
    }

    /**
     * Descarga un archivo desde una URL remota con limpieza de URL y manejo de errores
     */
    private function descargarArchivoDesdeURL($url)
    {
        try {
            // Limpiar la URL de espacios y caracteres extraños
            $urlLimpia = trim($url);
            $urlLimpia = str_replace(' ', '', $urlLimpia);
            $urlLimpia = preg_replace('/\s+/', '', $urlLimpia);
            
            Log::info("Intentando descargar archivo desde URL: " . $urlLimpia);
            
            // Primer método: usar cURL
            $contenido = $this->descargarConCurl($urlLimpia);
            
            if ($contenido !== false) {
                Log::info("Archivo descargado exitosamente con cURL desde: " . $urlLimpia);
                return $contenido;
            }
            
            // Segundo método: usar file_get_contents como respaldo
            Log::info("cURL falló, intentando con file_get_contents");
            
            $context = stream_context_create([
                'http' => [
                    'timeout' => 30,
                    'method' => 'GET',
                    'header' => [
                        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                    ]
                ]
            ]);
            
            $contenido = @file_get_contents($urlLimpia, false, $context);
            
            if ($contenido !== false) {
                Log::info("Archivo descargado exitosamente con file_get_contents desde: " . $urlLimpia);
                return $contenido;
            }
            
            Log::error("No se pudo descargar el archivo desde: " . $urlLimpia);
            return false;
            
        } catch (\Exception $e) {
            Log::error("Error al descargar archivo desde URL: " . $url . " - Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Descarga un archivo usando cURL con configuración optimizada
     */
    private function descargarConCurl($url)
    {
        try {
            $ch = curl_init();
            
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_CONNECTTIMEOUT => 10,
                CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
            ]);
            
            $contenido = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            
            curl_close($ch);
            
            if ($contenido === false) {
                Log::error("cURL error: " . $error . " para URL: " . $url);
                return false;
            }
            
            if ($httpCode !== 200) {
                Log::error("HTTP error code: " . $httpCode . " para URL: " . $url);
                return false;
            }
            
            return $contenido;
            
        } catch (\Exception $e) {
            Log::error("Error en cURL: " . $e->getMessage() . " para URL: " . $url);
            return false;
        }
    }
}
