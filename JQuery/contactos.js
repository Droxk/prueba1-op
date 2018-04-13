$(document).ready(function(){

	$(document).on('click', function(e) {
	    console.log('clicked outside');
	    console.log(e.target);
	});

	

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
		        data: { id_contacto: del_id, seleccion: "borrar_contacto" }
        	});

        	$("#row_"+del_id).remove();
        }

        return false;
	});

	$('.modificar_contacto').click(function(e){
		e.preventDefault();
		var nombreTd = $(this).parent().parent().parent().find("td:nth(2)");
		var tfnoTd = $(this).parent().parent().parent().find("td:nth(3)");
		var nombreBack = nombreTd.text();
		var tfnoBack = tfnoTd.text();

		$(":input").on('click', function(e) {
		    console.log('clicked inside');
		    console.log(e.target);
		    event.stopPropagation();
		});
		
		if($(this).text() == " Modificar"){
			nombreTd.text("");
			tfnoTd.text("");

			nombreTd.append('<input id="nombre_back" type="text" class="form-control" value="'+ nombreBack +'">');
			tfnoTd.append('<input id="tfno_back" type="number" class="form-control" value="'+ tfnoBack +'">');
			
			nombreTd.focus();

			$(this).html('<span id="span_guardar" class="glyphicon glyphicon-floppy-disk"></span> Guardar');
			$(this).toggleClass("btn-warning");
			$(this).toggleClass("btn-success");

		} else {
			// click en guardar
			if($("#nombre_back").val() && $("#tfno_back").val()){
				var mod_id = $(this).siblings("input[name=id_contacto]").val();

				$.ajax({
			        type: "POST",
			        url: "Index.php",
			        data: { id_contacto: mod_id, nn_contacto: $("#nombre_back").val(), nt_contacto: $("#tfno_back").val(), seleccion: "modificar_contacto" },
			        success: function(resp){
			        	console.log(resp);
			        	nombreTd.text($("#nombre_back").val());
						tfnoTd.text($("#tfno_back").val());	
			        }

		    	});

		    	$(this).html('<span id="span_guardar" class="glyphicon glyphicon-pencil"></span> Modificar');
				$(this).toggleClass("btn-warning");
				$(this).toggleClass("btn-success");
			} else {
				$("#nombre_back").css("border-color", "red");
				$("#tfno_back").css("border-color", "red");
			}
		}

	});

	function modificarContacto(){
		$.ajax({
	        type: "POST",
	        url: "Index.php",
	        data: { id_contacto: $('#id_contacto').val(), nn_contacto: $('#input_nombrecontacto').val(), nt_contacto: $('#input_tfnocontacto').val(), seleccion: "modificar_contacto" },
	        success: function(){

	        }
    	});
	}

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