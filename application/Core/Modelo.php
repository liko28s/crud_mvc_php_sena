<?php

namespace Core;

use PDO;

/**
 * Base model
 *
 */
abstract class Modelo
{

    /**
     * obtiene la conexion a la base de datos
     *
     * @return mixed
     */
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' . $_ENV["MYSQL_HOST"] . ';dbname=' . $_ENV["MYSQL_DATABASE"] . ';charset=utf8';
            $db = new PDO($dsn, $_ENV["MYSQL_USER"], $_ENV["MYSQL_PASSWORD"]);

            // Lanza error si pasa algo
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }


    /**
     * DEscomprime las columnas y valores para actualizar
     *
     * @return string
     */
    protected static function getValoresUpdate($datos) {
        $valores = "";
        foreach (array_diff_key($datos, ["id"=>""]) as $columna => $valor) {
            $valores .= "$columna='$valor', ";
        }
        return trim($valores, ", ");
    }

    /**
     * DEscomprime las columnas para insertar
     *
     * @return string
     */
    protected static function getColumnasInsert($datos) {
        $valores = "";
        foreach (array_diff_key($datos, ["id"=>""]) as $columna => $valor) {
            $valores .= "$columna, ";
        }
        return trim($valores, ", ");
    }

    /**
     * DEscomprime las columnas para insertar
     *
     * @return string
     */
    protected static function getValoresInsert($datos) {
        $valores = "";
        foreach (array_diff_key($datos, ["id"=>""]) as $columna => $valor) {
            $valores .= "'$valor', ";
        }
        return trim($valores, ", ");
    }
}
