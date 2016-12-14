function Grilla(){
	var pagina = "nexo.php";
	var queHago = "GRILLA";
	$.ajax({
        url:"nexo.php",
        type:"post",
        data: {queHago: queHago} 
    })
    .then(function(retorno){
        $("#cuerpo").html(retorno);       
    },
		function mal(jqXHR, textStatus, errorThrown) {
        	console.log("ERROR:\n"+jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
		}
    );
}
function Login(){
	var pagina = "nexo.php";
	var queHago = "LOGIN";
	$.ajax({
        url:"nexo.php",
        type:"post",
        data: {queHago: queHago} 
    })
    .then(function(retorno){
        $("#cuerpo").html(retorno);       
    });
}
function Ingreso(){
	var pagina = "nexo.php";
	var queHago = "INGRESO";
	var login = {usuario: $('#usuario').val(), contraseña: $('#contraseña').val()};
	$('#submit').attr("disabled", true);

	$.ajax({
		type: "POST",
		url: pagina,
		data: {
			login: login, 
			queHago: queHago
		},
		dataType: "json",
		async: true
	})
	.then( 
		function bien(respuesta){

			if (!respuesta.exito) {
				var html = '<div class="alert alert-danger animated fadeInDown" role="alert"> <strong>Error!</strong> '+respuesta.mensaje+'.</div>';
				$("#alerta").html(html);
				setTimeout(
					function(){
						$("#submit").attr("disabled", false);
						$("#usuario").val("");
						$("#contraseña").val("");
						$("#alerta").html("");
					}, 3000);
				return;
			}

			var html = '<div class="alert alert-success animate fadeInDown animated fadeInDown" role="alert"> <strong>Correcto!</strong> '+respuesta.mensaje+'.</div>';
			$("#alerta").html(html);
			setTimeout(function(){ 
				$("#alerta").html(""); 
				$('#submit').attr("disabled", false);
				location.reload();
			}, 3000);
		}
		,
		function mal(jqXHR, textStatus, errorThrown) {
        	console.log("ERROR:\n"+jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
		}
	);
}
function LoginOut(){
	var pagina = "nexo.php";
	var queHago = "DESLOGUEAR";

	$.ajax({
        url:"nexo.php",
        type:"post",
        data: {queHago: queHago} ,
        async: true
    })
    .then(function(retorno){
        location.reload();       
    }); 
}
function SacarCookie(){
	var pagina = "nexo.php";
	var queHago = "SACARCOOKIE";

	$.ajax({
        url:"nexo.php",
        type:"post",
        data: {queHago: queHago} 
    })
    .then(function(retorno){    	
    	location.reload();  
    }); 
}
function CargarForm(){
	var pagina = "nexo.php";
	var queHago = "FORM_ALTA";

	$.ajax({
		type: "POST",
		url: pagina,
		data: {
			queHago: queHago
		},
		async: true
	})
	.then( 
		function bien(respuesta){
			$("#divAbm").html(respuesta);
		}
		,
		function mal(jqXHR, textStatus, errorThrown) {
        	console.log("ERROR:\n"+jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
		}
	);
	
}
function NuevaMascota(){
	var nombre = $('#nombre').val();
	var raza = $('#raza').val();
	var tipo = $('#tipo').val();

	var pagina = "nexo.php";
	var mascota = {nombre: nombre, raza: raza, tipo: tipo};
	var queHago = "ALTA";

	$.ajax({
		type: "POST",
		url: pagina,
		data: {
			mascota: mascota, 
			queHago: queHago
		},
		dataType: "json",
		async: true
	})
	.then( 
		function bien(respuesta){

			if (!respuesta.exito) {
				alert("ERROR: " + respuesta.mensaje);
				console.log("ERROR: " + respuesta.mensaje);
				return;
			}
			alert("BIEN: "+respuesta.mensaje);
			$("#divAbm").html("");
			Grilla();
		}
		,
		function mal(jqXHR, textStatus, errorThrown) {
        	console.log("ERROR:\n"+jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
		}
	);
}
function FrmModificar(obj){ //solo modifico el alta con jquery :)
	//console.log(obj);
	CargarForm();
	setTimeout(function(){  // incluyo delay - form tarda mas 
		$('#nombre').val(obj.nombre);
		$('#raza').val(obj.raza);
		$('#tipo').val(obj.tipo);

		$("#agregar").text("Modificar");
		$("#agregar").removeAttr("onclick");
		$("#agregar").attr("onclick","Modificar("+obj.id+")");
		$("#titulo").text("Modificación");;
	}, 50);

}
function Modificar(id){
	var nombre = $('#nombre').val();
	var raza = $('#raza').val();
	var tipo = $('#tipo').val();

	var pagina = "nexo.php";
	var mascota = {id: id, nombre: nombre, raza: raza, tipo: tipo};
	var queHago = "MODIFICAR";

	$.ajax({
		type: "POST",
		url: pagina,
		data: {
			mascota: mascota, 
			queHago: queHago
		},
		dataType: "json",
		async: true
	})
	.then( 
		function bien(respuesta){

			if (!respuesta.exito) {
				alert("ERROR: " + respuesta.mensaje);
				console.log("ERROR: " + respuesta.mensaje);
				return;
			}
			alert("BIEN: "+respuesta.mensaje);
			$("#divAbm").html("");
			Grilla();
		}
		,
		function mal(jqXHR, textStatus, errorThrown) {
        	console.log("ERROR:\n"+jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
		}
	);
}
function Eliminar(obj){
	var id = obj.id;

	var pagina = "nexo.php";
	var mascota = {id: id};
	var queHago = "ELIMINAR";

	$.ajax({
		type: "POST",
		url: pagina,
		data: {
			mascota: mascota, 
			queHago: queHago
		},
		dataType: "json",
		async: true
	})
	.then( 
		function bien(respuesta){

			if (!respuesta.exito) {
				alert("ERROR: " + respuesta.mensaje);
				console.log("ERROR: " + respuesta.mensaje);
				return;
			}
			alert("BIEN: "+respuesta.mensaje);
			$("#divAbm").html("");
			Grilla();
		}
		,
		function mal(jqXHR, textStatus, errorThrown) {
        	console.log("ERROR:\n"+jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
		}
	);
}