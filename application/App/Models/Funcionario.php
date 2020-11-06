<?php

namespace App\Models;

use PDO;


class Funcionario extends \Core\Modelo
{

    /**
     * obtiene todos los usuarios
     *
     * @return array
     */
    public static function getTodos()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM usuarios');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * obtiene un usuario por nombre de usuario
     *
     * @return array
     */
    public static function getPorNombreDeUsuario($nombreUsuario)
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM usuarios where nombre = '{$nombreUsuario}'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * obtiene un usuario por id
     *
     * @param $id int El ID del Usuario
     * @return array
     */
    public static function getPorId($id)
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM usuarios where id = {$id}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    /**
     * inserta un usuario en la tabla
     *
     * @param $datos array Los datos a guardar
     * @return array|false|\PDOStatement
     */
    public static function crear($datos)
    {
        $db = static::getDB();
        return $db->query("INSERT INTO usuarios(nombre, clave) values ('{$datos['nombre']}','{$datos['clave']}')");
    }

    /**
     * actualiza un usuario en la tabla
     *
     * @param $datos array Los datos a guardar
     * @return array|false|\PDOStatement
     */
    public static function actualizar($datos)
    {
        $db = static::getDB();
        return $db->query("UPDATE usuarios set nombre='{$datos['nombre']}', clave='{$datos['clave']}' where id={$datos['id']}");
    }

    /**
     * borrar un usuario en la tabla
     *
     * @param $id array Los datos a guardar
     * @return array|false|\PDOStatement
     */
    public static function borrar($id)
    {
        $db = static::getDB();
        return $db->query("DELETE FROM usuarios where id={$id}");
    }
}
