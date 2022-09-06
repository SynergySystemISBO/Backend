<?php
include('../../conexion.php');
class UsuarioModel
{

    private $db;
    private $libros;

    public function __construct()
    {

        $this->db = Conexion::conectar();
        $this->usuarios = array();
    }

    public function getUser($email)
    {
        $sql = "SELECT * FROM Usuario WHERE email='$email'";

        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        return $row;
    }

    public function createUser($nombre, $apellido, $email, $password, $rol){
        try{
        $sql = "INSERT INTO `Usuario` (`NomUsuario`, `ApUsuario`, `Email`, `Password`, `Rol`) VALUES ('$nombre', '$apellido', '$email', '$password','$rol');";
        return $this->db->query($sql);
        }
        catch(Exception $e){
            return false;
        }
    }

    public function updateUser($id, $nombre, $apellido, $email, $password, $rol){
        try{
        $sql = "UPDATE `Usuario` SET `NomUsuario` = '$nombre', `ApUsuario` = '$apellido', `Email` = '$email', `Password` = '$password', `Rol` = '$rol' WHERE `Usuario`.`IdUsuario` = $id; ";
        return $this->db->query($sql);
        }
        catch(Exception $e){
            return false;
        }
    }

    public function deleteUser($id){
        try{
        $sql = "DELETE FROM Usuario WHERE `Usuario`.`IdUsuario` = $id";
        return $this->db->query($sql);
        }
        catch(Exception $e){
            return false;
        }
    }
}