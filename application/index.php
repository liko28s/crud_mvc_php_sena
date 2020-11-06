<?php
/**
 * Autoload Composer
 */
require 'vendor/autoload.php';

/**
 * Carga variables de entorno
 */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * Habilita la sesion
 */
session_start();
$_SESSION["logueado"] = $_SESSION["logueado"] ? true : false;

/**
 * Manejo de errores
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::gestorErrores');
set_exception_handler('Core\Error::gestorExcepciones');


/**
 * Enrutador, aqui se crea el listado de enlaces y sus acciones
 */
$router = new Core\Router();

// Rutas Especificas
$router->agregar('', ['controlador' => 'Home', 'accion' => 'index']);
$router->agregar('login', ['controlador' => 'Login', 'accion' => 'index']);
$router->agregar('admin', ['controlador' => 'Admin', 'accion' => 'index']);

// Rutas de Modelos Crear
$router->agregar('admin/{controlador}/{accion}');

// Rutas de Modelos Actualizar o eliminar
$router->agregar('admin/{controlador}/{id:\d+}/{accion}');

// Rutas para imagenes
$router->agregar('imagenes/{formato:\w+}/{imagen:\w+}', ['controlador' => 'Imagenes', 'accion' => 'servir']);

// Ruta general
$router->agregar('{controlador}/{accion}');
    
$router->ejecutar($_SERVER['QUERY_STRING']);
