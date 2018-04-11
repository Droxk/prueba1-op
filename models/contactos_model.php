<?php
    class contactos_model{
        private $db;
        private $conn;
        private $contactos;

        public function __construct(){
            $this->db = new Conectar();
            $this->conn = $this->db->conexion();
            $this->conntactos=array();
        }

        public function get_contactos($id){
            // $consulta=$this->conn->query("select * from Contactos where id_referente = ".$id.";");
            $consulta = $this->db->get_contactos($this->conn, $id);
            
            while($filas=$consulta->fetch_assoc()){
                $this->conntactos[]=$filas;
            }

            return $this->conntactos;
        }

        public function borrar_contacto($id_contacto){
            $consulta=$this->db->borrar_contacto($this->conn, $id_contacto);
        }
    }
?>