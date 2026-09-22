<?php

namespace App\Exceptions;

use RuntimeException;

/**
 * Fallo al consultar el API externo de SCOP. El código es el HTTP status que
 * se le devuelve al front.
 */
class ScopApiException extends RuntimeException
{
}
