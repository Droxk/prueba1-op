<?php
	$id=$_POST['id_contacto']; //changed

	$consulta=$this->db->query("delete from Contactos where id = ". $id_contacto. ";");

?>