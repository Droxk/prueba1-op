<?php
    class contactos_model{
        private $db;
        private $conn;
        private $contactos;

        public function __construct(){
            $this->db = new Conectar();
            $this->conntactos=array();
        }

        public function get_contactos($id){
            $this->conn = $this->db->conexion();

            $consulta = $this->db->get_contactos($this->conn, $id);
            
            while($filas=$consulta->fetch_assoc()){
                $this->conntactos[]=$filas;
            }

            $this->db->close_con($this->conn);

            return $this->conntactos;
        }

        public function borrar_contacto($id_contacto){
            $this->conn = $this->db->conexion();

            $consulta=$this->db->borrar_contacto($this->conn, $id_contacto);

            $this->db->close_con($this->conn);
        }
    }
?>