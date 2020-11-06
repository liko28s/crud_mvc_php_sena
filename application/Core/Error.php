<?php

namespace Core;

/**
 * Gestion de Excepciones y Errores
 *
 */
class Error
{

    /**
     * Convierte todos los errores en excepciones
     *
     * @param int $nivel  Nivel
     * @param string $mensaje  Mensaje
     * @param string $archivo  Archivo donde se originó el error
     * @param int $linea  Numero de linnea
     *
     * @return void
     */
    public static function gestorErrores($nivel, $mensaje, $archivo, $linea)
    {
        if (error_reporting() !== 0) {
            throw new \ErrorException($mensaje, 0, $nivel, $archivo, $linea);
        }
    }

    /**
     * Gestiona las excepciones
     *
     * @param Exception $excepcion  La excepciónn
     *
     * @return void
     */
    public static function gestorExcepciones($excepcion)
    {
        // 404 o 500 (no encontrado o error)
        $codigo = $excepcion->getCode();
        if ($codigo != 404) {
            $codigo = 500;
        }
        http_response_code($codigo);

        echo "<h1>Error Fatal</h1>";
        echo "<p>Excepción: '" . get_class($excepcion) . "'</p>";
        echo "<p>Mensaje: '" . $excepcion->getMessage() . "'</p>";
        echo "<p>Detalles del error:<pre>" . $excepcion->getTraceAsString() . "</pre></p>";
        echo "<p>Lanzada en '" . $excepcion->getFile() . "' en linea " . $excepcion->getLine() . "</p>";
    }
}
