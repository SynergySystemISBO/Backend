<?php

class Conexion
{
    private $conexion = null;

    public static function conectar()
    {
        try{
        $conexion = new mysqli("localhost", "root", "", "BDproyecto");
        return $conexion;
        }
        catch(Exception $e){
            echo $e;
            die();
        }
    }

    function query($query)
    {

        $result = $this->conexion->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
