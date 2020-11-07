<?php

namespace App\Models;

use PDO;


class HojaDeVida extends \Core\Modelo
{

    /**
     * obtiene todos los vacantes
     *
     * @return array
     */
    public static function getTodos()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM hojasdevida v left join clientes c on c.id = v.cliente');
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
        $stmt = $db->query("SELECT * FROM hojasdevida where id = {$id}");
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
        $db->query("INSERT INTO hojasdevida($columnas) values ($valores)");
        return $db->lastInsertId();
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
        $db->query("UPDATE hojasdevida set cliente = {$datos['cliente']} where id={$datos['id']}");
        // Estudios
        $estudios = [];
        $id = $datos["id"];
        unset($datos["id"], $datos["cliente"]);
        foreach($datos as $columna => $valores) {
            foreach ($valores as $clave => $valor) {
                $estudios[$clave][$columna] = $valor;
            }
        }

        foreach ($estudios as $estudio) {
            if(!empty(array_filter(array_values($estudio),"strlen"))) {
                $estudio["id"] = $estudio["estudio_id"];
                unset($estudio["estudio_id"]);
                $estudioModel = new Estudio();
                if (!array_key_exists("eliminar", $estudio)) {
                    if ($estudio["id"]) {
                        if (!empty(array_filter(array_values($estudio), "strlen"))) {
                            $estudio["hojadevida"] = $id;
                            $estudioModel->actualizar($estudio, $estudio["id"]);
                        }
                    } else {
                        $estudio["hojadevida"] = $id;
                        $estudioModel->crear($estudio);
                    }
                } else {
                    $estudioModel->borrar($estudio["id"]);
                }
            }
        }
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
        return $db->query("DELETE FROM hojasdevida where id={$id}");
    }
}
