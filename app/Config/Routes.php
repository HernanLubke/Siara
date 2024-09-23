<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('inicio', 'Home::index');
$routes->get('/perros', 'Home::categoriaPerros');
$routes->get('/gatos', 'Home::categoriaGatos');
$routes->get('/accesorios', 'Home::categoriaAccesorios');
$routes->get('/quienesSomos', 'Home::quienesSomos');
$routes->get('/TerminosYcondiciones', 'Home::TerminosYcondiciones');
$routes->get('/Comercializacion', 'Home::Comercializacion');
$routes->get('/Contacto', 'Home::Contacto');
$routes->get('categoria/(:num)', 'ProductosController::listarCategorias/$1');


/*rutas del usuario*/
$routes->get('/registro', 'Usuario_controller::create');
$routes->post('enviar-form', 'Usuario_controller::formValidation');

/*rutas de login*/
$routes->get('login', 'Login_controller::create'); 
$routes->post('enviar-login', 'Login_controller::auth');
$routes->get('panel', 'Panel_controller::index',['filter' => 'auth']); 
$routes->get('logout', 'Login_controller::logout');

// Crud usuarios
$routes->get('/usuarios', 'Usuario_controller::index');
$routes->get('/registro', 'Usuario_controller::create');
$routes->post('/usuarios/store', 'Usuario_controller::store');
$routes->get('/usuarios/edit/(:num)', 'Usuario_controller::edit/$1');
$routes->post('/usuarios/update/(:num)', 'Usuario_controller::update/$1');
$routes->delete('/usuarios/delete/(:num)', 'Usuario_controller::delete/$1');
$routes->get('/consulta', 'Usuario_controller::consulta');
$routes->post('consulta/guardarConsulta', 'consultaController::guardarConsulta');
$routes->get('/leido/(:num)', 'UsuarioController::leidoConsulta/$1');
$routes->get('categoria/(:num)', 'ProductosController::listarCategorias/$1');


/*admin*/
$routes->get('listarProductos', 'ProductosController::index');
$routes->get('agregarProducto', 'ProductosController::create');
$routes->post('agregarProducto', 'ProductosController::store');
$routes->get('editarProducto/(:num)', 'ProductosController::editar/$1');
$routes->post('actualizar', 'ProductosController::actualizar');
$routes->get('ProductosDadosDeBaja', 'ProductosController::listarbaja');
$routes->get('editar/(:num)', 'ProductosController::editar/$1');
$routes->get('dardebajaProducto/(:num)', 'ProductosController::darDeBaja/$1');
$routes->get('darDeAlta/(:num)', 'ProductosController::darDeAlta/$1');
$routes->get('catalogo', 'ProductosController::catalogo');
$routes->get('catalogoIngresado', 'ProductosController::catalogoIngresado');
$routes->get('usuarios/edit/(:num)', 'Usuario_controller::edit/$1');
$routes->get('categoria/(:num)', 'ProductosController::listarCategorias/$1');


$routes->get('listarConsulta', 'Usuario_controller::listarConsulta');

//Carrito
    
    $routes->get('carrito', 'CarritoController::index');
    $routes->get('carrito/agregar/(:num)', 'CarritoController::agregar/$1');
    $routes->get('carrito/eliminar/(:num)', 'CarritoController::eliminar/$1');
    $routes->get('carrito/checkout', 'CarritoController::checkout');
    $routes->get('carrito/obtenerCantidad', 'CarritoController::obtenerCantidad');
    $routes->get('carrito/vaciar',  'CarritoController::vaciar');
    $routes->get('carrito/aumentar/(:num)', 'CarritoController::aumentar/$1');
    $routes->get('carrito/disminuir/(:num)' , 'CarritoController::disminuir/$1');
    $routes->get('carrito/checkout', 'CarritoController::checkout');
    $routes->get('carrito/exito/(:num)', 'CarritoController::exito/$1');
    $routes->get('compras', 'CarritoController::compraUsuario');



    $routes->get('listarCategorias', 'ProductosController::listarCategorias');
    $routes->get('/agregarCategorias', 'ProductosController::createCategorias');
    $routes->post('/agregarCategorias', 'ProductosController::storeCategorias');
    $routes->get('editarCategorias/(:num)', 'ProductosController::editarCategorias/$1');
    $routes->post('actualizarCategorias', 'ProductosController::actualizarCategorias');
    $routes->get('categoriasDadosDeBaja', 'ProductosController::listarbajaCategorias');
    $routes->get('/dardebajaCategorias/(:num)', 'ProductosController::darDeBajaCategorias/$1');
    $routes->get('/dardealtaCategorias/(:num)', 'ProductosController::darDeAltaCategorias/$1');

    $routes->get('misCompras', 'CarritoController::compraUsuario'); 



    $routes->get('facturas/(:num)', 'ProfileController::facturas/$1');

    $routes->post('listarProductos', 'ProductosController::listarProductos');
    $routes->post('listar', 'ProfileController::listar');