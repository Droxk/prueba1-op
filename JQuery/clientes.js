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

		var info;
		var nombre;
		var tfno;
		$.ajax({
	        type: "POST",
	        url: "index.php",
	        data: { id_cliente: $("#oculto").val(), seleccion: "rec_datoscliente"}, //en el controlador voy a un php que recuepera los datos del cliente y los devuelve.
	        success: function(resp){
	        	console.log(resp);
	        	
	        	info = resp.split(";");
	        	nombre = info[0];
	        	tfno = info[1];

	        	$("#input_modnombre").val(nombre);
				$("#input_modtfno").val(tfno);
	        	
	        }
    	});
	}

});