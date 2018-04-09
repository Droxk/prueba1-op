<?php
	class Controller{
    	public function __construct(){

    		//Llamada al modelo
			$cli=new clientes_model();
			$datos=$cli->get_clientes();

			// Si seleccion tiene valor quiere decir que el usuario ha hecho click en una de las Acciones
			// Si por el contrario no tiene valor eso quire decir que o bien no ha seleccionado nada o que ha vuelto al inicio desde alguna de las vistas
			if(isset($_POST['seleccion'])){
				switch ($_POST['seleccion']) {
					case "contactos":
						$contactos=$cli->get_contactos($_POST['id']);
						require_once("views/contactos_view.phtml");
						break;

					case "borrar":
						$cli->borrar_cliente($_POST['id']);
						header('Location: index.php');
						// Dado que la vista de borrado solo muestra un mensaje de "borrado correctamente", es mas intuitivo que al pulsar en borrar desaparezca
						// el Cliente y de esta forma que sea mas visual. Por tanto la vista de borrar no es necesaria una vez aplicada la redirección. 
						// require_once("views/borrado_view.phtml");
						break;

					case "modificar":
						require_once("views/modificar_view.phtml");
						break;

					case "borrar_contacto":
						$cli->borrar_contacto($_POST['id_contacto']);
						header('Location: index.php');
						break;

					case "modificar_contacto":
						require_once("views/modcontacto_view.phtml");
						break;

					case "buscar":
						$encontrados=$cli->mostrar_busqueda($_POST['busqueda']);
						require_once("views/busqueda_view.phtml");
						break;
					
					case "alta":
						require_once("views/alta_view.phtml");
						break;
					
					case "alta_contacto":
						require_once("views/contactos_view.phtml");
						break;

				}
			}else{
				// Si estan definidas quiere decir que el usuario viene de la vista de modificar y debería
				// realizar la modificación.
				if(isset($_POST['nuevo_nombre']) && isset($_POST['nuevo_tfno'])){
					$cli->modificar_cliente($_POST['id'], $_POST['nuevo_nombre'], $_POST['nuevo_tfno']);
					header('Location: index.php');
				}

				if(isset($_POST['nombre_alta']) && isset($_POST['tfno_alta'])){
					$cli->insertar_cliente($_POST['nombre_alta'], $_POST['tfno_alta']);
					header('Location: index.php');
				}

				//Llamada a la vista principal
				require_once("views/clientes_view.phtml");
			}
		}
	}
?>