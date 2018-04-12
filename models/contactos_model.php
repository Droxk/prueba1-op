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

        public function reg_contacto($id_referente, $nombre_contacto, $tfno_contacto){
            $this->conn = $this->db->conexion();

            $consulta=$this->db->insertar_contacto($this->conn, $id_referente, $nombre_contacto, $tfno_contacto);

            $this->db->close_con($this->conn);
        }

        public function modificar_contacto($id_contacto, $nuevo_nombre, $nuevo_tfno){
            $this->conn = $this->db->conexion();

            $consulta=$this->db->modificar_contacto($this->conn, $id_contacto, $nuevo_nombre, $nuevo_tfno);

            $this->db->close_con($this->conn);
        }
    }
?>