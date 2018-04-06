$(document).ready(function(){
	$("#btn_addcontacto").click(function(){
		$("#btn_addcontacto").prop("disabled", true);
		console.log("Click en dar de alta un contacto");

		$("#div_addcontacto").text('<input type="text" placeholder="prueba input">');
	});
});