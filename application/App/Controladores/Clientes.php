<?php

namespace App\Controladores;

use App\Models\Cliente;
use \Core\Vista;

class Clientes extends Admin
{

    public function editarAccion()
    {
        if($this->estaLogueado) {
            // Modelo
            $clienteModelo = new Cliente();
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('Clientes/formulario.html',["cliente"=>$clienteModelo->getPorId($this->parametros_ruta["id"])]
                    );
                    break;
                case 'POST':
                    $clienteModelo->actualizar($_POST);
                    header('Location: '."/admin/clientes");
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
            $clienteModelo = new Cliente();
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('Clientes/formulario.html');
                    break;
                case 'POST':
                    $clienteModelo->crear($_POST);
                    header('Location: '."/admin/clientes");
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
            $clienteModelo = new Cliente();
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('confirmacion.html', ["controlador" =>"clientes"]);
                    break;
                case 'POST':
                    $clienteModelo->borrar($this->parametros_ruta["id"]);
                    header('Location: '."/admin/clientes");
                    break;
            }
            return;
        }
        header('Location: '."/login");

    }
}
