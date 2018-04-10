$(document).ready(function(){
	// Este script contendra el control del borrado de los clientes ya que ahora mismo se borran sin aviso

	$('.borrar_cliente').click(function(e){
       	
       	if(!confirm("¿Borrar el contacto?")){
       		e.preventDefault();
		}
	});

});