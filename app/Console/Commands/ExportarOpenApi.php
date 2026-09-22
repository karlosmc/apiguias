<?php

namespace App\Console\Commands;

use Dedoc\Scramble\Generator;
use Illuminate\Console\Command;

/**
 * Vuelca a un archivo el mismo documento que Scramble sirve en /docs/api.json.
 *
 * La versión de Scramble compatible con Laravel 9 (0.8.x) todavía no trae
 * `scramble:export`, así que se genera aquí.
 */
class ExportarOpenApi extends Command
{
    protected $signature = 'docs:openapi
                            {--ruta=openapi.json : Archivo de salida, relativo a la raíz del proyecto}';

    protected $description = 'Exporta la especificación OpenAPI a un archivo JSON';

    public function handle(Generator $generator)
    {
        $documento = $generator();

        $json = json_encode(
            $documento,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        );

        $ruta = base_path($this->option('ruta'));
        file_put_contents($ruta, $json);

        $this->info(sprintf(
            '%s: %d rutas, %d schemas, %s KB',
            $this->option('ruta'),
            count($documento['paths'] ?? []),
            count($documento['components']['schemas'] ?? []),
            number_format(strlen($json) / 1024, 1)
        ));

        return self::SUCCESS;
    }
}
