<?php

namespace Core;

/**
 * Vista
 *
 * PHP version 7.0
 */
class Vista
{

    /**
     * Renderiza una vista
     *
     * @param string $vista  El archivo de vista
     * @param array $parametros  Data opcional a pasar a la vista
     *
     * @return void
     */
    public static function renderizar($vista, $parametros = [])
    {
        extract($parametros, EXTR_SKIP);

        $file = dirname(__DIR__) . "/App/Views/$vista";

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    /**
     * Renderiza la plantilla usando twig como motor
     *
     * @param string $plantilla  La plantilla
     * @param array $parametros  Data opcional a pasar a la vista
     *
     * @return void
     */
    public static function renderizarPlantilla($plantilla, $parametros = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig\Loader\Filesystemloader(dirname(__DIR__) . '/App/Views');
            $twig = new \Twig\Environment($loader);
        }

        echo $twig->render($plantilla, $parametros);
    }
}
