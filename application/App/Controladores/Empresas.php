<?php

namespace App\Controladores;

use App\Models\Empresa;
use \Core\Vista;

class Empresas extends Admin
{

    public function editarAccion()
    {
        if($this->estaLogueado) {
            // Modelo
            $empresaModelo = new Empresa();
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('Empresas/formulario.html',["empresa"=>$empresaModelo->getPorId($this->parametros_ruta["id"])]
                    );
                    break;
                case 'POST':
                    $empresaModelo->actualizar($_POST);
                    header('Location: '."/admin/empresas");
                    break;
            }
            return;
        }
        header('Location: '."/login");

    }

    public function crearAccion()
    {
        if($this->estaLogueado) {
            // Modelo
            $empresaModelo = new Empresa();
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('Empresas/formulario.html');
                    break;
                case 'POST':
                    $empresaModelo->crear($_POST);
                    header('Location: '."/admin/empresas");
                    break;
            }
            return;
        }
        header('Location: '."/login");

    }

    public function borrarAccion()
    {
        if($this->estaLogueado) {
            // Modelo
            $empresaModelo = new Empresa();
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('confirmacion.html', ["controlador" =>"empresas"]);
                    break;
                case 'POST':
                    $empresaModelo->borrar($this->parametros_ruta["id"]);
                    header('Location: '."/admin/empresas");
                    break;
            }
            return;
        }
        header('Location: '."/login");

    }
}
