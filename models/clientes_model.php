<?php
    class clientes_model{
        private $db;
        private $conn;
        private $todos;
        private $clientes;
        private $encontrados;
        private $datoscliente;

        public function __construct(){
            $this->db = new Conectar();
            $this->todos = array();
            $this->clientes=array();
            $this->encontrados=array();
            $this->datoscliente=array();
        }

        public function get_clientes(){
            $this->conn = $this->db->conexion();

            $consulta = $this->db->get_clientes($this->conn);

            while($filas=$consulta->fetch_assoc()){
                $this->clientes[]=$filas;
            }
            
            $this->db->close_con($this->conn);

            return $this->clientes;
        }

        public function mostrar_busqueda($cadena){
            $this->conn = $this->db->conexion();

            $consulta = $this->db->mostrar_busqueda($this->conn, $cadena);

            while($filas=$consulta->fetch_assoc()){
                $this->encontrados[]=$filas;
            }

            $this->db->close_con($this->conn);

            return $this->encontrados;
        }

        public function insertar_cliente($nombre, $tfno){
            $this->conn = $this->db->conexion();

            $consulta = $this->db->insertar_cliente($this->conn, $nombre, $tfno);

            $this->db->close_con($this->conn);
        }

        public function modificar_cliente($id, $nuevo_nombre, $nuevo_tfno){
            $this->conn = $this->db->conexion();

            $consulta = $this->db->modificar_cliente($this->conn, $id, $nuevo_nombre, $nuevo_tfno);

            $this->db->close_con($this->conn);
        }

        public function borrar_cliente($id){
            $this->conn = $this->db->conexion();

            $consulta = $this->db->borrar_cliente($this->conn, $id);

            $this->db->close_con($this->conn);
        }

        public function get_datoscliente($id_cliente){
            $this->conn = $this->db->conexion();

            $consulta = $this->db->get_datoscliente($this->conn, $id_cliente);

            while($filas=$consulta->fetch_assoc()){
                $this->datoscliente[]=$filas;
            }

            $this->db->close_con($this->conn);

            // print_r ($this->datoscliente);
            echo ($this->datoscliente[0]['nombre'].";".$this->datoscliente[0]['telefono']);
            return $this->datoscliente;
        }

        public function exportar_clientes(){
            $this->conn = $this->db->conexion();
            $excelData;

            $consulta = $this->db->get_todos($this->conn);

            while($filas=$consulta->fetch_assoc()){
                $this->todos[]=$filas;
            }

            $excelData = $this->todos;
            // print ("<pre>");
            // print_r ($excelData);
            // print ("</pre>");

            include_once('Classes/PHPExcel/IOFactory.php');

            //set the desired name of the excel file
            $fileName = 'create-an-excel-file-in-php';

            // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

            // Set document properties
            $objPHPExcel->getProperties()->setCreator("Me")->setLastModifiedBy("Me")->setTitle("My Excel Sheet")->setSubject("My Excel Sheet")->setDescription("Excel Sheet")->setKeywords("Excel Sheet")->setCategory("Me");

            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);

            // Add column headers
            $objPHPExcel->getActiveSheet()
                        ->setCellValue('A1', 'ID')
                        ->setCellValue('B1', 'Nombre')
                        ->setCellValue('C1', 'Telefono')
                        ->setCellValue('D1', 'ID Contacto')
                        ->setCellValue('E1', 'ID Referente')
                        ->setCellValue('F1', 'Nombre Contacto')
                        ->setCellValue('G1', 'Telefono Contacto')
                        ;

            //Put each record in a new cell
            for($i=0; $i<count($excelData); $i++){
                $ii = $i+2;
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$ii, $excelData[$i]["id"]);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$ii, $excelData[$i]["nombre"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$ii, $excelData[$i]["telefono"]);
                $objPHPExcel->getActiveSheet()->setCellValue('D'.$ii, $excelData[$i]["id_contacto"]);
                $objPHPExcel->getActiveSheet()->setCellValue('E'.$ii, $excelData[$i]["id_referente"]);
                $objPHPExcel->getActiveSheet()->setCellValue('F'.$ii, $excelData[$i]["nombre_contacto"]);
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$ii, $excelData[$i]["telefono_contacto"]);
            }

            // Set worksheet title
            $objPHPExcel->getActiveSheet()->setTitle($fileName);

            // Redirect output to a client’s web browser (Excel2007)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');

            $this->db->close_con($this->conn);
        }
    }
?>