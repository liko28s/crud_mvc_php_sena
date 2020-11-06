<?php

namespace App\Controladores;

use \Core\Vista;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controlador
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAccion()
    {
        if($_SESSION["logueado"] == true) {
            Vista::renderizarPlantilla('Admin/index.html');
            return;
        }

        header('Location: '."/login");
    }
}
