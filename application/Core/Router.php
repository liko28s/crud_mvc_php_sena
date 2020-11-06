<?php

namespace Core;

/**
 * Router
 *
 */
class Router
{

    /**
     * Esto equivale a la tabla de enrutado
     * @var array
     */
    protected $rutas = [];

    /**
     * Parametros de la ruta coincidente
     * @var array
     */
    protected $parametros = [];

    /**
     * Agrega una ruta al listado de rutas
     *
     * @param string $ruta  La url de la ruta (/login por ejemplo)
     * @param array  $parametros Parametros
     *
     * @return void
     */
    public function agregar($ruta, $parametros = [])
    {
        // convierte la ruta a una expresion regular
        $ruta = preg_replace('/\//', '\\/', $ruta);

        // convierte las variables
        $ruta = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $ruta);

        // convierte las variables que incluyen expresiones regulares
        $ruta = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $ruta);

        // delimitadores y minusculas
        $ruta = '/^' . $ruta . '$/i';

        $this->rutas[$ruta] = $parametros;
    }

    /**
     * devuelve todas las rutas
     *
     * @return array
     */
    public function getRutas()
    {
        return $this->rutas;
    }

    /**
     * encuentra la ruta que coincide con la url visitada
     *
     * @param string $url La url
     *
     * @return boolean  verdadero si encuentra, falso si nno
     */
    public function match($url)
    {
        foreach ($this->rutas as $ruta => $parametros) {
            if (preg_match($ruta, $url, $coincidencias)) {
                foreach ($coincidencias as $clave => $coincidencia) {
                    if (is_string($clave)) {
                        $parametros[$clave] = $coincidencia;
                    }
                }
                $this->parametros = $parametros;
                return true;
            }
        }

        return false;
    }

    /**
     * Obtiene los parametross coincidentes
     *
     * @return array
     */
    public function getParametros()
    {
        return $this->parametros;
    }

    /**
     * Sirve la ruta, creando el controlador y llamando al metodo
     *
     * @param string $url The route URL
     *
     * @return void
     */
    public function ejecutar($url)
    {
        $url = $this->removeQueryStringVariables($url);

        if ($this->match($url)) {
            $controlador = $this->parametros['controlador'];
            $controlador = $this->convertToStudlyCaps($controlador);
            $controlador = $this->getNamespace() . $controlador;

            if (class_exists($controlador)) {
                $instancia_controlador = new $controlador($this->parametros);

                $action = $this->parametros['accion'];
                $action = $this->convertToCamelCase($action);

                if (preg_match('/accion$/i', $action) == 0) {
                    $instancia_controlador->$action();

                } else {
                    throw new \Exception("El Metodo $action en el controlador $controlador No puede ejecutarse directamente");
                }
            } else {
                throw new \Exception("$controlador No Encontrado");
            }
        } else {
            throw new \Exception('Ninguna ruta coincide.', 404);
        }
    }

    /**
     * Convierte texto a StudlyCaps
     *
     * @param string $texto El texto a convertir
     *
     * @return string
     */
    protected function convertToStudlyCaps($texto)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $texto)));
    }

    /**
     * convierte el texto recibido a camelCase
     *
     * @param string $texto el texto a convertir
     *
     * @return string
     */
    protected function convertToCamelCase($texto)
    {
        return lcfirst($this->convertToStudlyCaps($texto));
    }


    protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

    /**
     * Encuentra el namespace del controlador solicitado
     *
     * @return string retorna la url
     */
    protected function getNamespace()
    {
        $namespace = 'App\Controladores\\';

        if (array_key_exists('namespace', $this->parametros)) {
            $namespace .= $this->parametros['namespace'] . '\\';
        }

        return $namespace;
    }
}
