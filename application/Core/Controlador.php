<?php

namespace Core;

/**
 * Controlador Base
 *
 */
abstract class Controlador
{

    /**
     * Parametros de la ruta coincidente
     * @var array
     */
    protected $parametros_ruta = [];

    /**
     * Constructor
     *
     * @param array $parametros_ruta  Parametros de la ruta coincidente
     *
     * @return void
     */
    public function __construct($parametros_ruta)
    {
        $this->parametros_ruta = $parametros_ruta;
    }

    /**
     * Ejecuta una accion presente en el controlador
     * por favor nombre todas las acciones como NombreAccion
     *
     * @param string $nombre  ombre del metodo
     * @param array $parametros argumentos que recibe el metodo
     *
     * @return void
     */
    public function __call($nombre, $parametros)
    {
        $metodo = $nombre . 'Accion';

        if (method_exists($this, $metodo)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $metodo], $parametros);
                $this->after();
            }
        } else {
            throw new \Exception("Metodo $metodo no encontrado en el controlador " . get_class($this));
        }
    }

    /**
     * Filtros a ejecutar antes de llamar una accion
     *
     * @return void
     */
    protected function before()
    {
    }

    /**
     * Filtros a ejecutar despues de llamar una accion
     *
     * @return void
     */
    protected function after()
    {
    }
}
