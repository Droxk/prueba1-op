$(document).ready(function(){
	$("#btn_addcontacto").click(function(){
		var idPost = "<?php echo $_POST[id] ?>";
		$("#btn_addcontacto").prop("disabled", true);

		$("#div_contactoform").append('<form id="form_altacontacto" action="index.php" method="POST"></form>');
		$("#form_altacontacto").append('<div class="form-group"><label class="control-label col-sm-2">Nombre</label><div class="col-sm-10"><input class="form-control" type="text" name="nombre_alta" id="input_nombrecontacto"></div></div>');
		$("#form_altacontacto").append('<div class="form-group"><label class="control-label col-sm-2" for="pwd">Teléfono</label><div class="col-sm-10"><input class="form-control" type="number" name="tfno_alta" id="input_tfnocontacto"></div></div>');
		$("#form_altacontacto").append('<input type="hidden" name="seleccion" value="alta_contacto">');
		$("#form_altacontacto").append('<input type="hidden" name="id" value="<?php echo $_POST[id]; ?>">');
		$("#form_altacontacto").append('<div class="form-group"><div class="col-sm-offset-2 col-sm-10"><button type="submit" class="btn btn-success" id="boton_regcontacto" disabled>Registrar</button></div></div>');
	});
});