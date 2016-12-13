function TraerGrilla(){

	$.ajax({
		type:'POST',
		url: "nexo.php",

		data: {queHago: "grilla"},
	})
	.then(function bien(respuesta){
		//console.log(respuesta);
		$('#respuesta').html(respuesta);
	}
	,function mal(respuesta){
		alert("MAL\n"+respuesta);
	})
}