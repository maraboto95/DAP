$(document).ready(function(){

    $(":input").keyup(habilitarLimpio);
    $('#send').click(mandar);
    $('#limpio').click(limpiar);
    $(":input").keyup(habilitarMandar);
    /*$(':input')
    }
*/
 });
function limpiar(){
	$(":input").val("");
	$(":input").focusout();
}

function mandar(){
	var nombre = $("#nombre").val().trim();
	var email = $("#email").val().trim();
	var telefono = $("#tel").val().trim();
	var mensaje = $("#textarea1").val().trim();
	alert(nombre+" "+email+" "+telefono+" "+mensaje);
}

function habilitarLimpio(){
	$("#limpio").removeClass('disabled');
}

function habilitarMandar(){
	var nombre = $("#nombre").val().trim();
	var email = $("#email").val().trim();
	var telefono = $("#tel").val().trim();
	var mensaje = $("#textarea1").val().trim();

	if(nombre!=""&&email!=""&&telefono!=""&&mensaje!=""){
		$("#send").removeClass('disabled');
	}
}