<?php

namespace App\Controladores;

use App\Models\HojaDeVida;
use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Empresa;

use App\Models\Vacante;
use \Core\Vista;

class Admin extends \Core\Controlador
{
    public $estaLogueado;

    public function __construct($parametros_ruta)
    {
        parent::__construct($parametros_ruta);
        $this->estaLogueado = $_SESSION["logueado"];
    }

    public function indexAccion()
    {
        if($this->estaLogueado) {
            Vista::renderizarPlantilla('Admin/index.html');
            return;
        }

        header('Location: '."/login");

    }

    public function usuariosAccion()
    {
        if($this->estaLogueado) {
            $usuarioModel = new Usuario();
            $usuarios = $usuarioModel->getTodos();
            Vista::renderizarPlantilla('Admin/index.html',["plantilla"=>"usuarios/listar.html", "usuarios"=>$usuarios]);
            return;
        }

        header('Location: '."/login");

    }


    public function clientesAccion()
    {
        if($this->estaLogueado) {
            $clienteModel = new Cliente();
            $clientes = $clienteModel->getTodos();
            Vista::renderizarPlantilla('Admin/index.html',["plantilla"=>"clientes/listar.html", "clientes"=>$clientes]);
            return;
        }

        header('Location: '."/login");

    }


    public function empresasAccion()
    {
        if($this->estaLogueado) {
            $empresaModel = new Empresa();
            $empresas = $empresaModel->getTodos();
            Vista::renderizarPlantilla('Admin/index.html',["plantilla"=>"empresas/listar.html", "empresas"=>$empresas]);
            return;
        }

        header('Location: '."/login");

    }

    public function vacantesAccion()
    {
        if($this->estaLogueado) {
            $vacantesModel = new Vacante();
            $vacantes = $vacantesModel->getTodos();
            Vista::renderizarPlantilla('Admin/index.html',["plantilla"=>"vacantes/listar.html", "vacantes"=>$vacantes]);
            return;
        }

        header('Location: '."/login");

    }

    public function hojasdevidaaccion()
    {
        if($this->estaLogueado) {
            $hojasdevidaModel = new HojaDeVida();
            $hojasdevida = $hojasdevidaModel->getTodos();
            Vista::renderizarPlantilla('Admin/index.html',["plantilla"=>"hojasdevida/listar.html", "hojasdevida"=>$hojasdevida]);
            return;
        }

        header('Location: '."/login");

    }


}
