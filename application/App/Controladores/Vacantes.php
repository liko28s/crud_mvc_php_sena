<?php

namespace App\Controladores;

use App\Models\Empresa;
use App\Models\Vacante;
use \Core\Vista;

class Vacantes extends Admin
{

    public function editarAccion()
    {
        if($this->estaLogueado) {
            // Modelo
            $empresaModelo = new Empresa();
            $vacanteModelo = new Vacante();
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('Vacantes/formulario.html',[
                        "empresas"=>$empresaModelo->getTodos(),
                            "vacante"=>$vacanteModelo->getPorId($this->parametros_ruta["id"])
                        ]
                    );
                    break;
                case 'POST':
                    $vacanteModelo->actualizar($_POST);
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
            $vacanteModelo = new Vacante();
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('Vacantes/formulario.html', ["empresas" => $empresaModelo->getTodos()]);
                    break;
                case 'POST':
                    $vacanteModelo->crear($_POST);
                    header('Location: '."/admin/vacantes");
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
            $vacanteModelo = new Vacante();
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('confirmacion.html', ["controlador" =>"vacantes"]);
                    break;
                case 'POST':
                    $vacanteModelo->borrar($this->parametros_ruta["id"]);
                    header('Location: '."/admin/vacantes");
                    break;
            }
            return;
        }
        header('Location: '."/login");

    }
}
