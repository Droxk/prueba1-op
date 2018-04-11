<?php
    class contactos_model{
        private $db;
        private $con;
        private $contactos;

        public function __construct(){
            $this->db = new Conectar();
            $this->con = $this->db->conexion();
            $this->contactos=array();
        }

        public function get_contactos($id){
            // $consulta=$this->con->query("select * from Contactos where id_referente = ".$id.";");
            $consulta = $this->db->get_contactos($this->con, $id);
            
            while($filas=$consulta->fetch_assoc()){
                $this->contactos[]=$filas;
            }

            return $this->contactos;
        }

        public function borrar_contacto($id_contacto){
            $consulta=$this->con->query("delete from Contactos where id_contacto = ". $id_contacto. ";");
        }
    }
?>