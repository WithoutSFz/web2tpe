<?php
include_once 'controller/autores_controller.php';
include_once 'controller/home_controller.php';
include_once 'controller/libros_contoller.php';
include_once 'middleware/auth.helper.php';

$action= 'home';
if (!empty ($_GET['action'])){
    $action= $_GET['action'];
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