<?php
include_once 'controller/autores_controller.php';
include_once 'controller/libros_controller.php';
include_once 'controller/seguridad_controller.php';
include_once 'controller/home_controller.php';
include_once 'controller/admin_controller.php';
include_once 'middleware/auth.helper.php';

$action= 'home';
if (!empty ($_GET['action'])){
    $action= $_GET['action'];
}

$params= explode('/', $action);

switch ($params[0]){
    case 'home':
        $controller = new ControladorHome();
        $controller -> showHome();
        break;
    /*listarLibros*/
    case 'showLibros':
        $controller = new LibrosController();
        $controller->showLibros();
        break;
    /*libroPorId*/
    case 'buscarLibroPorId':
        $controller = new LibrosController();
        $controller->showLibrosPorId($params[1]);
        break;
    /*buscarLibro*/
    case 'buscarLibro':
        $controller = new LibrosController();
        $controller->buscarLibro();
        break;
    /*obtener autor por id*/
    case 'buscarAutor':
        $controller = new AutoresController();
        $controller -> showAutoresPorId();
        break;
    /*libro por autor*/
    case 'buscarLibroPorAutor':
        $controller = new AutoresController();
        $controller-> showLibroPorAutor($params[1]);
        break;
    
    /*login*/
    case 'login':
        $controller = new SeguridadController();
        $controller->showLoginForm();
        break;
    /*verify*/
    case 'verify':
        $controller = new SeguridadController();
        $controller->verify();
        break;
    /*logout*/
    case 'logout':
        $authHelper = new AuthHelper();
        $authHelper-> logout();
        break;
    
    /*admin*/
    case 'admin':
        AuthHelper::checkAdmin();
        $controller = new ControladorAdministrador();
        $controller->showPanelAdmin();
        break;
    /*agregarAutorForm*/
    case 'agregarAutorForm':
        AuthHelper::checkAdmin();
        $controller =new AutoresController();
        $controller->agregarAutor();
        break;
    /*agregarAutor*/
    case 'agregarAutor':
        AuthHelper::checkAdmin();
        $controller = new AutoresController();
        $controller->agregarAutor();
        break;
    /*editarAutorForm*/
    case 'editarAutorForm':
        AuthHelper::checkAdmin();
        $controller = new AutoresController();
        $controller->showFormEditarAutor($params[1]);
        break;
    /*editarAutor*/
    case 'editarAutor':
        AuthHelper::checkAdmin();
        $controller = new AutoresController();
        $controller->editarAutor();
        break;
    /*eliminarAutor*/
    case 'eliminarAutor':
        AuthHelper::checkAdmin();
        $controller = new AutoresController();
        $controller->eliminarAutor($params[1]);
        break;
    /*agregarLibroForm*/
    case 'agregarLibroForm':
        AuthHelper::checkAdmin();
        $controller = new LibrosController();
        $controller->showFormAgregarLibro();
        break;
    /*agregarLibro*/
    case 'agregarLibro':
        AuthHelper::checkAdmin();
        $controller = new LibrosController();
        $controller->agregarLibro();
        break;
    /*editarLibroForm*/
    case 'editarLibroForm':
        AuthHelper::checkAdmin();
        $controller = new LibrosController();
        $controller->showFormEditarLibro($params[1]);
        break;
    /*editarLibro*/
    case 'editarLibro':
        AuthHelper::checkAdmin();
        $controller = new LibrosController();
        $controller->editarLibro();
        break;
    /*eliminarLibro*/
    case 'eliminarLibro':
        AuthHelper::checkAdmin();
        $controller = new LibrosController();
        $controller->eliminarLibro($params[1]);
        break;
    default:
        echo('404 Page not found');
        break;
}