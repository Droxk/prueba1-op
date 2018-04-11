<?php
    class clientes_model{
        private $db;
        private $con;
        private $clientes;
        private $encontrados;

        public function __construct(){
            $this->db = new Conectar();
            $this->con = $this->db->conexion();
            $this->clientes=array();
            $this->encontrados=array();
        }

        public function get_clientes(){
            // $consulta=$this->con->query("select * from Clientes;");
            $consulta = $this->db->get_clientes($this->con);

            while($filas=$consulta->fetch_assoc()){
                $this->clientes[]=$filas;
            }
            
            return $this->clientes;
        }

        public function mostrar_busqueda($cadena){
            // $consulta=$this->con->query("select * from Clientes where nombre like '%".$cadena."%' or telefono like '%".$cadena."%';");
            $consulta = $this->db->mostrar_busqueda($this->con, $cadena);

            while($filas=$consulta->fetch_assoc()){
                $this->encontrados[]=$filas;
            }

            return $this->encontrados;
        }

        public function insertar_cliente($nombre, $tfno){
            // $consulta=$this->con->query("insert into Clientes values(null, '".$nombre."', '".$tfno."');");
            $consulta = $this->db->insertar_cliente($this->con, $nombre, $tfno);
        }

        public function modificar_cliente($id, $nuevo_nombre, $nuevo_tfno){
            // $consulta=$this->con->query("update Clientes set nombre = '".$nuevo_nombre."', telefono = '". $nuevo_tfno. "' where Clientes.id = ". $id. ";");
            $consulta = $this->db->modificar_cliente($this->con, $id, $nuevo_nombre, $nuevo_tfno);
        }

        public function borrar_cliente($id){
            // $consulta=$this->con->query("delete from Clientes where id = ". $id. ";");
            $consulta = Conectar::borrar_cliente($this->con, $id);
        }
    }
?>