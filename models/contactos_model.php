<?php
    class contactos_model{
        private $db;
        private $contactos;

        public function __construct(){
            $conn = new Conectar();
            $conn->conexion();
            $this->db=$conn;
            $this->contactos=array();
        }

        public function get_contactos($id){
            // $consulta=$this->db->query("select * from Contactos where id_referente = ".$id.";");
            $consulta = Conectar::get_contactos($this->db, $id);
            
            while($filas=$consulta->fetch_assoc()){
                $this->contactos[]=$filas;
            }

            return $this->contactos;
        }

        public function borrar_contacto($id_contacto){
            $consulta=$this->db->query("delete from Contactos where id_contacto = ". $id_contacto. ";");
        }
    }
?>