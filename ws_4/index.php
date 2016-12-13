<html>
<head>
	<title>WEB SERVICE TEST</title>
	  
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--final de Estilos-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="estilo.css">

</head>
<body>
	<div class="container">
	  	<div class="page-header">
        </div>
		<div class="page-header" align="center">
			<h1>WEB SERVICE #4</h1>      
		</div>
	<?php

		require_once('./SERVIDOR/lib/nusoap.php');

		$host = 'http://localhost/php/ws_4/SERVIDOR/ws_complejo.php';
		$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
		$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
		$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
		$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';
		
		$client = new nusoap_client($host . '?wsdl', true, $proxyhost, $proxyport, 
										$proxyusername, $proxypassword);

		$err = $client->getError();
		if ($err) {
			echo '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
			die();
		}

		$persona = array('Nombre' => 'Juan', 'Edad' => 22, 'Sexo' => 'Masculino');
//INVOCO AL PRIMER METODO DE MI WS		
		$result = $client->call('SaludarPersona', array('Persona' => $persona));

		if ($client->fault) {
			echo '<h2>ERROR AL INVOCAR METODO:</h2><pre>';
			print_r($result);
			echo '</pre>';
		} else {
			$err = $client->getError();
			if ($err) {
				echo '<h2>ERROR EN EL CLIENTE:</h2><pre>' . $err . '</pre>';
			} 
			else {
				echo '<h2>Resultado tipo retorno String</h2>';
				echo '<pre>' . $result . '</pre>';
			}
		}
		
		$otraPersona = array('Nombre' => 'Roberto', 'Edad' => 62, 'Sexo' => 'Femenina');
//INVOCO AL SEGUNDO METODO DE MI WS		
		$result = $client->call('SaludarPersonaCompleja', array('Persona' => $otraPersona));

		if ($client->fault) {
			echo '<h2>ERROR AL INVOCAR METODO:</h2><pre>';
			print_r($result);
			echo '</pre>';
		} else {
			$err = $client->getError();
			if ($err) {
				echo '<h2>ERROR EN EL CLIENTE:</h2><pre>' . $err . '</pre>';
			} 
			else {
				echo '<h2>Resultado tipo retorno Array</h2>';
				echo '<pre>' . $result["Mensaje"] . '</pre>';
			}
		}
		

//SE PUEDEN VISUALIZAR LOS DISTINTOS PEDIDOS Y RESPUESTAS		
		echo '<h2>Result</h2><pre>';
		print_r($result);
		echo '</pre>';
		echo '<h2>Request</h2>';
		echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
		echo '<h2>Response</h2>';
		echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//MOSTRAMOS LOS MENSAJES DEL DEBUG
		echo '<h2>Debug</h2>';
		echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
	
	?>
	</div>
</body>
</html>