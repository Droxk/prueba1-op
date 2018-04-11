$(document).ready(function(){
	// Este script contendra el control del borrado de los clientes ya que ahora mismo se borran sin aviso

	$('.borrar_cliente').click(function(e){
       	
       	if(!confirm("¿Borrar el contacto?")){
       		e.preventDefault();
		}
	});

	$('.modificar_cliente').click(function(e){
		// Pruebas
		console.log($(this).parent().parent().siblings("td:first").text());
		console.log($(this).parent().parent().siblings("td:nth(1)").text());
		console.log($(this).parent().parent().siblings("td:nth(2)").text());
	});

	if($("#input_modnombre").length){
		console.log($("#oculto").val());

		// $.ajax({
			/* 	Debe enviar la id a un php que haga la consulta a la bbdd y que devuelva los datos
			 	nombre y telefono para introducirlos en los campos del formulario.
			 	Una forma podria ser:
			 		1. 	Enviar al Index.php
			 		2. 	De ahi va al modelo que tiene a funcion que a su vez llama a otra funcion
						de conectar.php, abriendo una conexion, realizando la consulta y cerrandola
					3. 	El php de la consulta devolveria los datos a introducir en los campos
			*/
	    //     type: "POST",
	    //     url: ".php",
	    //     data: { id_cliente: $("#oculto").val()},
	    //     success: function(resp){
	    //     	console.log(resp);
	    //     }
    	// });

		$("#input_modnombre").val("adadadads");
		$("#input_modtfno").val("31232");
		//$("#input_modnombre").val($(this).parent().parent().siblings("td:first").text());
	}

});