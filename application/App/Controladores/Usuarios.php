<?php

namespace App\Controladores;

use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Empresa;
use \Core\Vista;

class Usuarios extends Admin
{

    public function editarAccion()
    {
        if($this->estaLogueado) {
            // Modelo
            $usuarioModelo = new Usuario();
            $clienteModelo = new Cliente();
            $empresaModelo = new Empresa();
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('Usuarios/formulario.html',[
                        "usuario"=>$usuarioModelo->getPorId($this->parametros_ruta["id"]),
                        "clientes" => $clienteModelo->getTodos(),
                        "empresas"=>$empresaModelo->getTodos()
                        ]
                    );
                    break;
                case 'POST':
                    $usuarioModelo->actualizar($_POST);
                    header('Location: '."/admin/usuarios");
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
            $usuarioModelo = new Usuario();
            $clienteModelo = new Cliente();
            $empresaModelo = new Empresa();
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('Usuarios/formulario.html',["clientes" => $clienteModelo->getTodos(), "empresas"=> $empresaModelo->getTodos()]);
                    break;
                case 'POST':
                    $usuarioModelo->crear($_POST);
                    header('Location: '."/admin/usuarios");
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
            $usuarioModelo = new Usuario();
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('confirmacion.html', ["controlador"=>"usuarios"]);
                    break;
                case 'POST':
                    $usuarioModelo->borrar($this->parametros_ruta["id"]);
                    header('Location: '."/admin/usuarios");
                    break;
            }
            return;
        }
        header('Location: '."/login");

    }
}
