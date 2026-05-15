<?php
include_once 'controller/autores_controller.php';
include_once 'controller/home_controller.php';
include_once 'controller/libros_controller.php';
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
    case 'showAutores':
        $controller= new AutoresController();
        $controller->showAutores();
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
    case 'logout':
        $authHelper= new AuthHelper();
        $authHelper-> logout();
        break;
    
    /*admin*/
    case 'admin':
        AuthHelper::checkAdmin();
        $controller= new ControladorAdministrador();
        $controller->showPanelAdmin();
        break;
    /*agregarAutorForm*/
    case 'agregarAutorForm':
        AuthHelper::checkAdmin();
        $controller=new AutoresController();
        $controller->agregarAutor();
        break;
    /*agregarAutor*/
    case 'agregarAutor':
        AuthHelper::checkAdmin();
        $controller=new AutoresController();
        $controller->agregarAutor();
        break;
    /*editarAutorForm*/
    case 'editarAutorForm':
        AuthHelper::checkAdmin();
        $controller=new AutoresController();
        $controller->editarAutor();
        break;
    /*editarAutor*/
    case 'editarAutor':
        AuthHelper::checkAdmin();
        $controller= new AutoresController();
        $controller->editarAutor();
        break;
    /*eliminarAutor*/
    case 'eliminarAutor':
        AuthHelper::checkAdmin();
        $controller= new AutoresController();
        $controller->eliminarAutor();
        break;
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