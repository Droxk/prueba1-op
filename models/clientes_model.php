<?php
    class clientes_model{
        private $db;
        private $clientes;
        private $encontrados;

        public function __construct(){
            $conn = new Conectar();
            $conn->conexion();
            $this->db=$conn;
            $this->clientes=array();
            $this->encontrados=array();
        }

        public function get_clientes(){
            // $consulta=$this->db->query("select * from Clientes;");
            $consulta = $this->db->get_clientes($this->db);

            while($filas=$consulta->fetch_assoc()){
                $this->clientes[]=$filas;
            }
            
            return $this->clientes;
        }

        public function mostrar_busqueda($cadena){
            // $consulta=$this->db->query("select * from Clientes where nombre like '%".$cadena."%' or telefono like '%".$cadena."%';");
            $consulta = Conectar::mostrar_busqueda($this->db, $cadena);

            while($filas=$consulta->fetch_assoc()){
                $this->encontrados[]=$filas;
            }

            return $this->encontrados;
        }

        public function insertar_cliente($nombre, $tfno){
            // $consulta=$this->db->query("insert into Clientes values(null, '".$nombre."', '".$tfno."');");
            $consulta = Conectar::insertar_cliente($this->db, $nombre, $tfno);
        }

        public function modificar_cliente($id, $nuevo_nombre, $nuevo_tfno){
            // $consulta=$this->db->query("update Clientes set nombre = '".$nuevo_nombre."', telefono = '". $nuevo_tfno. "' where Clientes.id = ". $id. ";");
            $consulta = Conectar::modificar_cliente($this->db, $id, $nuevo_nombre, $nuevo_tfno);
        }

        public function borrar_cliente($id){
            // $consulta=$this->db->query("delete from Clientes where id = ". $id. ";");
            $consulta = Conectar::borrar_cliente($this->db, $id);
        }
    }
?>