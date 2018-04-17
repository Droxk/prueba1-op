<?php
    error_reporting(0);

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
            //echo $consulta;

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
            // echo ($this->datoscliente[0]['nombre'].";".$this->datoscliente[0]['telefono']);
            return $this->datoscliente;
        }

        public function importar_clientes($inputFileName){
            $this->conn = $this->db->conexion();

            include_once('Classes/PHPExcel/IOFactory.php');

            /*check point*/

            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);

            $dataImport = array(1,$objPHPExcel->getActiveSheet()->toArray(null,true,true,true));

            // OPERACIONES
            $dataDb = $this->db->get_todos($this->conn);

            while($filas=$dataDb->fetch_assoc()){
                $this->todos[]=$filas;
            }

            $dataDb = $this->todos;

            // print_r($this->todos);
            //$keysimport = array_values($dataImport[1][12]);
            //$keysdb = array_values($dataDb[10]);
            // echo $keysimport[1];
            // echo "<br>";
            // echo $keysdb[1];
            // echo "<br>";
            // print_r($keysimport);
            // echo "<br>";
            // print_r($keysdb);

            // print ("<pre>");
            // print_r ($dataDb);
            // print ("</pre>");

            // Dos rondas, una que recorre el array de la bbdd para hacer los borrados
            //      - En esta ronda se busca con in_array("valor", $array) la id del cliente, si esta no hace nada, si no, se borra
            // Otra que recorre el array importado para hacer los insert y los updates
            //      - Si Encuentra el valor del id en el array de la bbdd, hace update, si no, insert

            for ($i=0; $i < count($dataDb); $i++) {
                $encontrado  = false;
                // echo "BUSCANDO ". $dataDb[$i]['id']. " EN \$dataImport <br>";

                // Por cada elemento del array de la bbdd (vuelta), recorro el array importado buscando el valor.
                for ($j=2; $j <= count($dataImport[1]); $j++) { 
                    if(in_array($dataDb[$i]['id'], $dataImport[1][$j])){
                        $encontrado  = true;
                        break;
                    }else{
                        $encontrado  = false;
                    }
                }

                if (!$encontrado) {
                    // Como no ha encontrado el valor, se hace un delete en la bbdd
                    // echo $dataDb[$i]['id']. " no encontrado<br>";
                    $this->db->borrar_cliente($this->conn, $dataDb[$i]['id']);
                }else{
                    // nada
                }

                // echo "<br>";
            }
            // Bucle superior funcionando. Borra los registros que no esten en el Excel importado


            // Lo mismo pero en este caso recorro el array importado:
            //          - Si encuentra el mismo id hace un update
            //          - Si el id no esta hace un insert de ese registro
            if($dataImport[0]==1){ // Si el Excel se ha cargado correctamente...
                for ($i=2; $i <= count($dataImport[1]); $i++) {
                    $encontrado  = false;
                    // echo "BUSCANDO ". $dataImport[1][$i]['A']. " EN \$dataDb <br>";
                    // Por cada valor del array importado
                    for ($j=0; $j <= count($dataDb) ; $j++) {
                        if(in_array($dataImport[1][$i]['A'], $dataDb[$j])){
                            $encontrado  = true;
                            break;
                        }else{
                            $encontrado  = false;
                        }
                    }

                    if (!$encontrado) {
                        // Como no ha encontrado el valor, se hace un insert en la bbdd
                        // echo $dataImport[1][$i]['A']. " no encontrado<br>";
                        $this->db->insertar_cliente($this->conn, $dataImport[1][$i]['B'], $dataImport[1][$i]['C']);
                    }else{
                        // Como si lo ha encontrado, se hace un update
                        $this->db->modificar_cliente($this->conn, $dataImport[1][$i]['A'], $dataImport[1][$i]['B'], $dataImport[1][$i]['C']);
                    }

                    // echo "<br>";
                }
            }


            // if($dataImport[0]==1){
            //     for ($j=2; $j <= count($dataImport[1]); $j++) {
            //         for ($k='A'; $k <= 'C' ; $k++) {
            //             echo $dataImport[1][$j][$k]. ", ";

            //             if ($dataImport[1][$j]['A'] != $clienteActual) {
            //                 $clienteActual = $dataImport[1][$j]['A'];
            //             }
            //         }
            //         echo "<br>";
            //     }
            // }


            // -----------------------------MOSTRANDO EL ARRAY-----------------------------
            //print the result
            // echo '<pre>';
                // print_r($dataImport[1]);
            // echo '</pre>';

            $this->db->close_con($this->conn);
        }

        public function exportar_clientes(){
            $this->conn = $this->db->conexion();

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
            $fileName = 'clientes_exportados';

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
                        // ->setCellValue('D1', 'ID Contacto')
                        // ->setCellValue('E1', 'ID Referente')
                        // ->setCellValue('F1', 'Nombre Contacto')
                        // ->setCellValue('G1', 'Telefono Contacto')
                        ;

            //Put each record in a new cell
            for($i=0; $i<count($excelData); $i++){
                $ii = $i+2;
                $objPHPExcel->getActiveSheet()->setCellValue('A'.$ii, $excelData[$i]["id"]);
                $objPHPExcel->getActiveSheet()->setCellValue('B'.$ii, $excelData[$i]["nombre"]);
                $objPHPExcel->getActiveSheet()->setCellValue('C'.$ii, $excelData[$i]["telefono"]);
                // $objPHPExcel->getActiveSheet()->setCellValue('D'.$ii, $excelData[$i]["id_contacto"]);
                // $objPHPExcel->getActiveSheet()->setCellValue('E'.$ii, $excelData[$i]["id_referente"]);
                // $objPHPExcel->getActiveSheet()->setCellValue('F'.$ii, $excelData[$i]["nombre_contacto"]);
                // $objPHPExcel->getActiveSheet()->setCellValue('G'.$ii, $excelData[$i]["telefono_contacto"]);
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