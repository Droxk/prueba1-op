<?php

class Conectar{
    public static function conexion(){
    	require("db_config.php");

        $conexion=new mysqli($host, $user, $pwd, $db);
        $conexion->query("SET NAMES 'utf8'");

        return $conexion;
    }

    public static function get_clientes($conn){
    	return (mysqli_query($conn, "select * from Clientes;"));
    }

    public static function get_contactos($conn, $id){
    	return (mysqli_query($conn, "select * from Contactos where id_referente = ".$id.";"));
    }

    public static function mostrar_busqueda($conn, $cadena){
    	return (mysqli_query($conn, "select * from Clientes where nombre like '%".$cadena."%' or telefono like '%".$cadena."%';"));
    }

    public static function insertar_cliente($conn, $nombre, $tfno){
    	return (mysqli_query($conn, "insert into Clientes values(null, '".$nombre."', '".$tfno."');"));
    }

    public static function modificar_cliente($conn, $id, $nuevo_nombre, $nuevo_tfno){
    	return (mysqli_query($conn, "update Clientes set nombre = '".$nuevo_nombre."', telefono = '". $nuevo_tfno. "' where Clientes.id = ". $id. ";"));
    }

    public static function borrar_cliente($conn, $id){
    	return (mysqli_query($conn, "delete from Clientes where id = ". $id. ";"));
    }
}

?>