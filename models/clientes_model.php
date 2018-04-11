<?php
    class clientes_model{
        private $db;
        private $conn;
        private $clientes;
        private $encontrados;

        public function __construct(){
            $this->db = new Conectar();
            $this->conn = $this->db->conexion();
            $this->clientes=array();
            $this->encontrados=array();
        }

        public function get_clientes(){
            // $consulta=$this->conn->query("select * from Clientes;");
            $consulta = $this->db->get_clientes($this->conn);

            while($filas=$consulta->fetch_assoc()){
                $this->clientes[]=$filas;
            }
            
            return $this->clientes;
        }

        public function mostrar_busqueda($cadena){
            // $consulta=$this->conn->query("select * from Clientes where nombre like '%".$cadena."%' or telefono like '%".$cadena."%';");
            $consulta = $this->db->mostrar_busqueda($this->conn, $cadena);

            while($filas=$consulta->fetch_assoc()){
                $this->encontrados[]=$filas;
            }

            return $this->encontrados;
        }

        public function insertar_cliente($nombre, $tfno){
            // $consulta=$this->conn->query("insert into Clientes values(null, '".$nombre."', '".$tfno."');");
            $consulta = $this->db->insertar_cliente($this->conn, $nombre, $tfno);
        }

        public function modificar_cliente($id, $nuevo_nombre, $nuevo_tfno){
            // $consulta=$this->conn->query("update Clientes set nombre = '".$nuevo_nombre."', telefono = '". $nuevo_tfno. "' where Clientes.id = ". $id. ";");
            $consulta = $this->db->modificar_cliente($this->conn, $id, $nuevo_nombre, $nuevo_tfno);
        }

        public function borrar_cliente($id){
            // $consulta=$this->conn->query("delete from Clientes where id = ". $id. ";");
            $consulta = $this->db->borrar_cliente($this->conn, $id);
        }
    }
?>