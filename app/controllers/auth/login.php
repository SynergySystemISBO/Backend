<?php
include($_SERVER['DOCUMENT_ROOT'] . "/app/models/Usuario.php");
class LoginController
{

    function __construct()
    {
    }

    function login($email, $password)
    {
        session_start();
        if ($_SESSION["is_logged"] == true) {
            echo 'Ya estas logueado ' . $_SESSION["user"] . "y tu rol es " . $_SESSION["rol"];
        } else {
            $usuario = new UsuarioModel();
            $sqlUsuario = $usuario->getUser($email);
            if (isset($sqlUsuario)) {
                if ($sqlUsuario['Email'] == $email && $sqlUsuario['Password'] == $password) {

                    $rol = $sqlUsuario["Rol"];

                    $_SESSION["is_logged"] = true;

                    $_SESSION["user"] = $email;

                    $_SESSION["rol"] = $rol;

                    echo "Sesion iniciada";
                } else {
                    echo 'El correo y contraseña no coinciden';
                }
            } else {
                echo 'El correo no existe en la bd';
            }
        }
    }


    function logout()
    {
        session_start();

        unset($_SESSION["user"]);

        unset($_SESSION["is_logged"]);

        session_destroy();

        echo "Sesion cerrada";
    }
}
