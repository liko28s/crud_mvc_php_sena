<?php

namespace App\Models;

use PDO;


class Estudio extends \Core\Modelo
{

    /**
     * obtiene todos los estudios de una hv
     *
     * @return array
     */
    public static function getTodosPorHojaDeVida($hojadevida_id)
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM estudios e where hojadevida = {$hojadevida_id}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * inserta un vacante en la tabla
     *
     * @param $datos array Los datos a guardar
     * @return array|false|\PDOStatement
     */
    public static function crear($datos)
    {
        $db = static::getDB();
        $columnas = static::getColumnasInsert($datos);
        $valores = static::getValoresInsert($datos);
        $db->query("INSERT INTO estudios({$columnas}) values ({$valores})");
        return $db->lastInsertId();
    }

    /**
     * actualiza un vacante en la tabla
     *
     * @param $datos array Los datos a guardar
     * @return array|false|\PDOStatement
     */
    public static function actualizar($datos, $id)
    {
        $db = static::getDB();
        $valores = static::getValoresUpdate($datos);
        return $db->query("UPDATE estudios set {$valores} where id={$id}");
    }

    /**
     * borrar un vacante en la tabla
     *
     * @param $id int Los datos a borrar
     * @return array|false|\PDOStatement
     */
    public static function borrar($id)
    {
        $db = static::getDB();
        return $db->query("DELETE FROM estudios where id={$id}");
    }
}
