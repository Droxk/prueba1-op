$(document).ready(function(){
	$("#btn_addcontacto").click(function(){
		var idPost = $('#id_cliente').val();
		$("#btn_addcontacto").prop("disabled", true);

		$("#div_contactoform").append('<form id="form_altacontacto" action="index.php" method="POST"></form>');
		$("#form_altacontacto").append('<div class="form-group"><label class="control-label col-sm-2">Nombre</label><div class="col-sm-10"><input class="form-control" type="text" id="input_nombrecontacto"></div></div>');
		$("#form_altacontacto").append('<div class="form-group"><label class="control-label col-sm-2" for="pwd">Teléfono</label><div class="col-sm-10"><input class="form-control" type="number" id="input_tfnocontacto"></div></div>');
		// $("#form_altacontacto").append('<input type="hidden" name="seleccion" value="registrar_contacto">');
		// $("#form_altacontacto").append('<input type="hidden" name="id" value="'+idPost+'">');
		$("#form_altacontacto").append('<div class="form-group"><div class="col-sm-offset-2 col-sm-10"><button type="submit" class="btn btn-success" id="boton_regcontacto" disabled>Registrar</button></div></div>');
	});
	
	$('.borrar_contacto').click(function(e){
		console.log("borrar contacto");
		e.preventDefault();

		var del_id = $(this).siblings("input[name=id_contacto]").val();
        if(confirm("¿Borrar el contacto?")){
	        $.ajax({
		        type: "POST",
		        url: "Index.php",
		        data: { id_contacto: del_id, seleccion: "borrar_contacto" },
		        success: function(resp){
		        	console.log(resp);
		        }
        	});

        	$("#row_"+del_id).remove();
        }

        return false;
	});

	$('#modificar_contacto').click(function(e){
		e.preventDefault();
		
		console.log("click modificar");
	});

	$("#div_contactoform").on('click', '#boton_regcontacto', function(e){
		$.ajax({
	        type: "POST",
	        url: "Index.php",
	        data: { id_referente: $('#id_referente').val(), nombre_contacto: $('#input_nombrecontacto').val(), tfno_contacto: $('#input_tfnocontacto').val(), seleccion: "registrar_contacto" },
	        success: function(){
	        	$.ajax({
			        type: "POST",
			        url: "Index.php",
			        data: { seleccion: "contactos" }
		    	});
	        }
    	});

		// location.reload(true); // por defecto a false, por lo que el reload es desde cache. Si fuese true seria desde servidor

		console.log($('#input_nombrecontacto').val());
		console.log($('#input_tfnocontacto').val());
	});
});