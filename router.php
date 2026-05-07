<?php
include_once 'WEB2TPE/controlador/autores_controller.php';
include_once 'WEB2TPE/controlador/home_controller.php';

$action= 'home';
if (!empty ($GET_['action'])){
    $action= $GET_['action'];
}

$params= explode('/', $action);

switch ($params[0]){
    case 'home':
        $controller= new ControladorHome();
        $controller -> showHome();
        break;
    /*listarLibros*/
    /*detalleLibro*/
    /*buscarLibro*/

    /*obtener autor por id*/
    case 'buscarAutor':
        $controller= new AutoresController();
        $controller -> showAutoresPorId();
        break;
    /*libro por autor*/
    case 'buscarLibroPorAutor':
        $controller= new AutoresController();
        $controller-> showLibroPorAutor();
        break;
    
    /*login*/
    /*verify*/
    /*logout*/
    /*admin*/
    /*agregarAutorForm*/
    /*agregarAutor*/
    /*editarAutorForm*/
    /*editarAutorForm*/
    /*editarAutor*/
    /*eliminarAutor*/
    /*agregarLibroForm*/
    /*agregarLibroForm*/
    /*agregarLibro*/
    /*editarLibroForm*/
    /*editarLibro*/
    /*eliminarLibro*/

    default:
        echo('404 Page not found');
        break;
}