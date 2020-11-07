<?php

namespace App\Models;

use PDO;


class Vacante extends \Core\Modelo
{

    /**
     * obtiene todos los vacantes
     *
     * @return array
     */
    public static function getTodos()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM vacantes v left join empresas e on e.id = v.empresa');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * obtiene un vacante por id
     *
     * @param $id int El ID del Usuario
     * @return array
     */
    public static function getPorId($id)
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM vacantes where id = {$id}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
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
        return $db->query("INSERT INTO vacantes($columnas) values ($valores)");
    }

    /**
     * actualiza un vacante en la tabla
     *
     * @param $datos array Los datos a guardar
     * @return array|false|\PDOStatement
     */
    public static function actualizar($datos)
    {
        $db = static::getDB();
        $valores = static::getValoresUpdate($datos);
        return $db->query("UPDATE vacantes set {$valores} where id={$datos['id']}");
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
        return $db->query("DELETE FROM vacantes where id={$id}");
    }
}
