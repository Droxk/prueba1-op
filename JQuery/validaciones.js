$(document).ready(function(){
	// VALIDACION DE FORMULARIOS
	// -------- Busqueda
	$("#input_busqueda").keyup(function(){
	    if ($("#input_busqueda").val() != "") {
			$("#boton_buscar").prop("disabled", false);
		} else {
			$("#boton_buscar").prop("disabled", true);
		}
	});
	
	// -------- Alta de nuevos clientes
	$("#input_nombrealta").keyup(function(){
	    if ($("#input_nombrealta").val() != "" && $("#input_tfnoalta").val() != "") {
			$("#boton_registrar").prop("disabled", false);
		} else {
			$("#boton_registrar").prop("disabled", true);
		}
	});

	$("#input_tfnoalta").keyup(function(){
	    if ($("#input_nombrealta").val() != "" && $("#input_tfnoalta").val() != "") {
			$("#boton_registrar").prop("disabled", false);
		} else {
			$("#boton_registrar").prop("disabled", true);
		}
	});

	// -------- Modificar un cliente
	$("#input_modnombre").keyup(function(){
	    if ($("#input_modnombre").val() != "" && $("#input_modtfno").val() != "") {
			$("#boton_mod").prop("disabled", false);
		} else {
			$("#boton_mod").prop("disabled", true);
		}
	});

	$("#input_modtfno").keyup(function(){
	    if ($("#input_modnombre").val() != "" && $("#input_modtfno").val() != "") {
			$("#boton_mod").prop("disabled", false);
		} else {
			$("#boton_mod").prop("disabled", true);
		}
	});
})