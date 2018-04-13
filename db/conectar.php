<?php
require("db_config.php");

class Conectar{
    private $host;
    private $user;
    private $pwd;
    private $db;

    public function __construct(){
        $this->host = HOST;
        $this->user = USERNAME;
        $this->pwd = PASSWORD;
        $this->db = DATABASE;
    }

    public function conexion(){
        $conexion=new mysqli($this->host, $this->user, $this->pwd, $this->db);
        $conexion->query("SET NAMES 'utf8'");

        return $conexion;
    }

    public function close_con($conn){
        $conn->close();
    }

    public function get_clientes($conn){
    	return (mysqli_query($conn, "select * from Clientes;"));
    }

    public function get_contactos($conn, $id){
    	return (mysqli_query($conn, "select * from Contactos where id_referente = ".$id.";"));
    }

    public function get_todos($conn){
        return (mysqli_query($conn, '
            SELECT Clientes.id, Clientes.nombre, Clientes.telefono, 
                   Contactos.id_contacto, Contactos.id_referente, 
                   Contactos.nombre as "nombre_contacto", Contactos.telefono as "telefono_contacto"
            FROM Clientes 
            INNER JOIN Contactos 
            ON Clientes.id = Contactos.id_referente 
            ORDER BY Clientes.id ASC
            ;'));
    }

    public function mostrar_busqueda($conn, $cadena){
    	return (mysqli_query($conn, "select * from Clientes where nombre like '%".$cadena."%' or telefono like '%".$cadena."%';"));
    }

    public function insertar_cliente($conn, $nombre, $tfno){
    	return (mysqli_query($conn, "insert into Clientes values(null, '".$nombre."', '".$tfno."');"));
    }

    public function modificar_cliente($conn, $id, $nuevo_nombre, $nuevo_tfno){
    	return (mysqli_query($conn, "update Clientes set nombre = '".$nuevo_nombre."', telefono = '". $nuevo_tfno. "' where Clientes.id = ". $id. ";"));
    }

    public function modificar_contacto($conn, $id, $nuevo_nombre, $nuevo_tfno){
        return (mysqli_query($conn, "update Contactos set nombre = '".$nuevo_nombre."', telefono = '". $nuevo_tfno. "' where Contactos.id_contacto = ". $id. ";"));
    }

    public function borrar_cliente($conn, $id){
    	return (mysqli_query($conn, "delete from Clientes where id = ". $id. ";"));
    }

    public function borrar_contacto($conn, $id_contacto){
        return (mysqli_query($conn, "delete from Contactos where id_contacto = ". $id_contacto. ";"));
    }

    public function insertar_contacto($conn, $id_referente, $nombre_contacto, $tfno_contacto){
        return (mysqli_query($conn, "insert into Contactos values(null, ".$id_referente.", '".$nombre_contacto."', '".$tfno_contacto."');"));
    }

    public function get_datoscliente($conn, $id_cliente){
        return (mysqli_query($conn, "select * from Clientes where id = ".$id_cliente.";"));
    }
}

?>