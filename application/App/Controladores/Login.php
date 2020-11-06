<?php

namespace App\Controladores;

use App\Models\Usuario;
use \Core\Vista;

class Login extends \Core\Controlador
{

    public function indexAccion()
    {
        Vista::renderizarPlantilla('Login/index.html');
    }

    /*
     * Intenta iniciar sesion
     */
    public function loginAccion()
    {
        $usuario = Usuario::getPorNombreDeUsuario($_POST["nombre_usuario"]);

        if(!empty($usuario) && $usuario[0]["clave"] == $_POST["clave"]) {
            header('Location: '."/admin");
            $_SESSION["logueado"] = true;
            Vista::renderizarPlantilla('Admin/index.html', ["usuario" => $usuario]);
        } else {
            Vista::renderizarPlantilla("Login/index.html", ["error" => "Clave o Usuario invalidos"]);
        }

    }

    /*
     * Cierra Sesionn
     */
    public function logoutAccion()
    {
        header('Location: '."/");
        $_SESSION["logueado"] = false;
    }
}
