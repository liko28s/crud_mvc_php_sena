<?php

namespace App\Controladores;

use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Empresa;

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






    public function funcionariosAccion()
    {
        if($this->estaLogueado) {
            $funcionarioModel = new Funcionario();
            $funcionarios = $funcionarioModel->getTodos();
            Vista::renderizarPlantilla('Admin/index.html',["plantilla"=>"funcionarios/listar.html", "funcionarios"=>$funcionarios]);
            return;
        }

        header('Location: '."/login");

    }

    public function hojasdevidaAccion()
    {
        if($this->estaLogueado) {
            $hojaDeVidaModel = new HojaDeVida();
            $hojasDeVida = $hojaDeVidaModel->getTodos();
            Vista::renderizarPlantilla('Admin/index.html',["plantilla"=>"hojasdevida/listar.html", "hojasdevida"=>$hojasDeVida]);
            return;
        }

        header('Location: '."/login");

    }



    public function contratacionAccion()
    {
        if($this->estaLogueado) {
            $contratacionModelo = new Contratacion();
            $contrataciones = $contratacionModelo->getTodos();
            Vista::renderizarPlantilla('Admin/index.html',["plantilla"=>"contrataciones/listar.html", "contrataciones"=>$contrataciones]);
            return;
        }

        header('Location: '."/login");

    }

}
