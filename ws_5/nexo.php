<?php


switch ($_POST['queHago']) {
	case 'grilla':
		require_once('./SERVIDOR/lib/nusoap.php');
		require_once('AccesoDatos.php');
		require_once('Cd.php');

		//$host = 'http://localhost/Ejemplos/2016/clase11/ws_5/SERVIDOR/ws.php';
		$host = 'http://localhost:8080/php/clase11/ws_5/SERVIDOR/ws.php';

		$client = new nusoap_client($host . '?wsdl');

		$err = $client->getError();
		if ($err) {
			echo '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
			die();
		}

//INVOCO AL METODO DE MI WS		
		$cds = $client->call('ObtenerTodosLosCds', array());

		if ($client->fault) {
			echo '<h2>ERROR AL INVOCAR METODO:</h2><pre>';
			print_r($cds);
			echo '</pre>';
		} else {
			$err = $client->getError();
			if ($err) {
				echo '<h2>ERROR EN EL CLIENTE:</h2><pre>' . $err . '</pre>';
			} 
			else {
				echo '<h2>Resultado</h2>';
				echo '<pre>' . var_dump($cds) . '</pre>';
				echo '<br/>';
				echo "<table border='1' width='70%'>
						<tr>
							<th>ID</th><th>CANTANTE</th><th>A&Ntilde;O</th><th>TITULO</th>
						</tr>";
				foreach($cds as $cd)
				{
					echo "<tr>
							<td>".$cd['id']."</td><td>".$cd['interpret']."</td><td>".$cd['jahr']."</td><td>".$cd['titel']."</td>
						  </tr>";
				}
				echo '</table>';
				echo '<br/>';
			}
		}

		break;
	
	default:
		return ":(";
		break;
}


  ?>