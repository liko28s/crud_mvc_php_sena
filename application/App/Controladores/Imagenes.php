<?php

namespace App\Controladores;

use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Empresa;
use \Core\Vista;

class Imagenes extends Admin
{
    public function servirAccion(){
        $ruta = __DIR__."/../views/img/{$this->parametros_ruta["imagen"]}.{$this->parametros_ruta["formato"]}";
        if (file_exists($ruta)) {
            $image_info = getimagesize($ruta);
            header('Content-Type: ' . $image_info['mime']);
            header('Content-Length: ' . filesize($ruta));
            readfile($ruta);
        }
        else {
            header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");

        }
    }
}
