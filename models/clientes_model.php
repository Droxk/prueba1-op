<?php
    class clientes_model{
        private $db;
        private $clientes;
        private $contactos;
        private $encontrados;

        public function __construct(){
            $this->db=Conectar::conexion();
            $this->clientes=array();
            $this->contactos=array();
            $this->encontrados=array();
        }

        public function get_clientes(){
            $consulta=$this->db->query("select * from Clientes;");

            while($filas=$consulta->fetch_assoc()){
                $this->clientes[]=$filas;
            }
            
            return $this->clientes;
        }

        public function get_contactos($id){
            $consulta=$this->db->query("select * from Contactos where id_referente = ".$id.";");

            while($filas=$consulta->fetch_assoc()){
                $this->contactos[]=$filas;
            }

            return $this->contactos;
        }

        public function mostrar_busqueda($cadena){
            $consulta=$this->db->query("select * from Clientes where nombre like '%".$cadena."%' or telefono like '%".$cadena."%';");

            while($filas=$consulta->fetch_assoc()){
                $this->encontrados[]=$filas;
            }

            return $this->encontrados;
        }

        public function insertar_cliente($nombre, $tfno){
            $consulta=$this->db->query("insert into Clientes values(null, '".$nombre."', '".$tfno."');");
        }

        public function modificar_cliente($id, $nuevo_nombre, $nuevo_tfno){
            $consulta=$this->db->query("update Clientes set nombre = '".$nuevo_nombre."', telefono = '". $nuevo_tfno. "' where Clientes.id = ". $id. ";");
        }

        public function borrar_cliente($id){
            $consulta=$this->db->query("delete from Clientes where id = ". $id. ";");
        }
    }
?>