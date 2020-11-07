<?php

namespace App\Controladores;

use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Estudio;
use App\Models\HojaDeVida;
use App\Models\Vacante;
use \Core\Vista;

class Hojasdevida extends Admin
{

    public function editarAccion()
    {
        if($this->estaLogueado) {
            // Modelo
            $hojadevidaModel = new HojaDeVida();
            $clienteModelo = new Cliente();
            $estudiosModelo = new Estudio();
            $clientes = $clienteModelo->getTodos();
            $estudios = $estudiosModelo->getTodosPorHojaDeVida($this->parametros_ruta["id"]);
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('Hojasdevida/formulario.html',[
                            "hojadevida"=>$hojadevidaModel->getPorId($this->parametros_ruta["id"]),
                            "clientes" => $clientes,
                            "estudios" => $estudios,
                            "niveles" => ["basico", "secundario", "complementario"]
                        ]
                    );
                    break;
                case 'POST':
                    $hojadevidaModel->actualizar($_POST);
                    header('Location: '."/admin/hojasdevida");
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
            $hojaModelo = new HojaDeVida();
            $clienteModelo = new Cliente();
            $clientes = $clienteModelo->getTodos();
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('Hojasdevida/formulario.html', ["clientes" => $clientes]);
                    break;
                case 'POST':
                    $id = $hojaModelo->crear($_POST);
                    header('Location: '."/admin/hojasdevida/{$id}/editar");
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
            $hojasModelo = new HojaDeVida();
            switch($_SERVER['REQUEST_METHOD'])
            {
                case 'GET':
                    Vista::renderizarPlantilla('confirmacion.html', ["controlador" =>"hojasdevida"]);
                    break;
                case 'POST':
                    $hojasModelo->borrar($this->parametros_ruta["id"]);
                    header('Location: '."/admin/hojasdevida");
                    break;
            }
            return;
        }
        header('Location: '."/login");

    }
}
