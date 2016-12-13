<?php
//DIRECTO DE LA CLASE------------------------------------------------//
// require_once 'clases/materiales.php';
// $arrMateriales2 = MaterialesTXT::TraerTodosLosMateriales();
// var_dump($arrMateriales2);
//USANDO WEB_SERVICE-------------------------------------------------//

require_once('lib/nusoap.php');

$host = 'http://localhost:8080/php/web_service.php';

		$client = new nusoap_client($host . '?wsdl');

		$err = $client->getError();
		if ($err) {
			echo '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
			die();
		}

//INVOCO AL METODO DE MI WS		
		$arrMascotas = $client->call('ObtenerTodasLasMascotas', array());

		if ($client->fault) {
			echo '<h2>ERROR AL INVOCAR METODO:</h2><pre>';
			print_r($arrMascotas);
			echo '</pre>';
		} else {
			$err = $client->getError();
			if ($err) {
				echo '<h2>ERROR EN EL CLIENTE:</h2><pre>' . $err . '</pre>';
			} 
			else {
				// echo '<h2>Resultado</h2>';
				// echo '<pre>' . var_dump($arrMascotas) . '</pre>';
				// echo '<br/>';
			}
		}
?>

<script type="text/javascript">

	<?php 	echo ('
		var arr = '.json_encode($arrMascotas).';


		function boton(obj,accion){
            if (accion == 1) {
                FrmModificar(obj);
            }else
                Eliminar(obj);
        }');
	?>
</script>
<div class="container animated slideUp">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading"> 

					<h4>Grilla de Mascotas <a data-toggle="tooltip" onclick="CargarForm()" class="btn btn-success btn-xs" title="Nuevo Usuario"><span class="glyphicon glyphicon-plus"></span></a></h4>                  
				</div>

                <div class="table-container scroll-window">
                    <table class="table table-hover table-striped">
                    	<thead>
                    		<tr>
	                        	<th>Id</th>
	                            <th>Nombre</th>
	                            <th>Raza</th>
	                            <th>Tipo</th>
	                            <th class="text-center">Acción</th>
	                        </tr>
                    	</thead>
						<tbody>
	                        <?php
	                        for ($i=0; $i < count($arrMascotas); $i++) { 
	                        	$fila ='<tr>';
	                            $fila.='<td class="text-left scope="row"">'.$arrMascotas[$i]['id'].'</td>';
	                            $fila.='<td class="text-left">'.$arrMascotas[$i]['nombre'].'</td>';
	                            $fila.='<td class="text-left">'.$arrMascotas[$i]['raza'].'</td>';
	                            $fila.='<td class="text-left">'.$arrMascotas[$i]['tipo'].'</td>';
	                            $fila.='<td class="text-center">';
	                            $fila.='<a data-toggle="tooltip" onclick="boton(arr['.$i.'],1)" class="btn btn-info btn-xs" title="EDITAR"><span class="glyphicon glyphicon-pencil"></span></a> ';
	                            $fila.= '<a data-toggle="tooltip" onclick="boton(arr['.$i.'],2)" class="btn btn-danger btn-xs" title="BORRAR"><span class="glyphicon glyphicon-trash"></span></a>';
	                            $fila.='</td></tr>';
	                            echo $fila;
	                        }
	                        
	                        ?>
						</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>