<?php

include_once './app/controllers/Usuario.php';
include_once './app/controllers/auth/login.php';

////FILTROS
////filtro de autentificacion de logueo
$router->filter('auth', function () {
    session_start();
    if (!isset($_SESSION['user'])) {
        echo "Es necesario estar logueado";
        return false;
    }


});
////Filtro para rol administrativo
$router->filter('rolAdministrativo', function () {
    session_start();
    if ($_SESSION['rol'] != 'Administrativo') {
        echo 'El rol ' . $_SESSION['rol'] . ' no puede acceder';
        return false;
    }
});

/////LOGIN
$router->get('/login/{email}?/{password}?', function ($email = null, $password = null) {
    if (is_null($email) || is_null($password)) {
        echo "Uno de los dos valores es nulo";
        exit();
    }
    $loginController = new LoginController();
    return $loginController->login($email, $password);
});



/////RUTAS QUE REQUIEREN LOGIN
$router->group(['before' => 'auth'], function ($router) {

    $router->get('/logout', function () {
        $loginController = new LoginController();
        return $loginController->logout();
    });

    ////RUTAS PARA EL USUARIO ADMINISTRATIVO
    $router->group(['before' => 'rolAdministrativo'], function ($router) {
        $router->get('/crear/{nombre}/{apellido}/{email}/{password}/{rol}', function ($nombre, $apellido, $email, $password, $rol) {
            $usuarioController = new UsuarioController();
            return $usuarioController->createUser($nombre, $apellido, $email, $password, $rol);
        });

        $router->get('/update/{id}/{nombre}/{apellido}/{email}/{password}/{rol}', function ($id, $nombre, $apellido, $email, $password, $rol) {
            $usuarioController = new UsuarioController();
            return $usuarioController->updateUser($id, $nombre, $apellido, $email, $password, $rol);
        });
    });
});
