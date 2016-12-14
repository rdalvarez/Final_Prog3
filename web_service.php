<?php 
	require_once('lib/nusoap.php'); 
	require_once('clases/mascota.php');

	$server = new nusoap_server(); 

	$server->configureWSDL('WebService Mascotas', 'urn:wsMascota'); 

///**********************************************************************************************************///


//AGREGO TIPO COMPLEJO, INFORMANDO SU ESTRUCTURA	
	$server->wsdl->addComplexType(
									'Mascota',
									'complexType',
									'struct',
									'all',
									'',
									array('Nombre' => array('name' => 'Nombre', 'type' => 'xsd:string'),
										  'Raza' => array('name' => 'Raza', 'type' => 'xsd:string'),
										  'Tipo' => array('name' => 'Tipo', 'type' => 'xsd:string')
										 )
								);



///**********************************************************************************************************///								
//REGISTRO METODO CON PARAMETRO DE ENTRADA COMPLEJO Y PARAMETRO DE SALIDA 'SIMPLE'
	$server->register('AltaMascota',                	
						array('Mascota' => 'tns:Mascota'),  
						array('return' => 'xsd:string'),   
						'urn:wsMascota',                		
						'urn:wsMascota#IngresarMascota',             
						'rpc',                        		
						'encoded',                    		
						'Intertar una Mascota'    			
					);


	function AltaMascota($p) {
		$Mascota = new Mascota($p['Nombre'], $p['Raza'],$p['Tipo']);

		return $Mascota->InsertarMascota();
	}
///**********************************************************************************************************///

//REGISTRO METODO CON PARAMETRO DE ENTRADA COMPLEJO Y PARAMETRO DE SALIDA 'SIMPLE'
	$server->register('ModificarMascota',                	
						array('Mascota' => 'tns:Mascota'),  
						array('return' => 'xsd:string'),   
						'urn:wsMascota',                		
						'urn:wsMascota#ModificaMascota',             
						'rpc',                        		
						'encoded',                    		
						'Modificar una Mascota'    			
					);


	function ModificarMascota($p) {

		$aux = explode(" - ", $p['Nombre']);
		$arrMaterial = array($aux[0],$aux[1], $p['Precio'],$p['Tipo']);

		return Mascota::ModificarMascota($arrMaterial);
	}
///**********************************************************************************************************///

//REGISTRO METODO SIN PARAMETRO DE ENTRADA Y PARAMETRO DE SALIDA 'ARRAY de ARRAYS'
	$server->register('ObtenerTodasLasMascotas',                	
						array(),  
						array('return' => 'xsd:Array'),   
						'urn:wsMascota',                		
						'urn:wsMascota#ObtenerTodasLasMascotas',             
						'rpc',                        		
						'encoded',                    		
						'Obtiene todos los Materiales del archivo TXT'    			
					);


	function ObtenerTodasLasMascotas() {
		
		$r =  Mascota::TraerTodasLasMascotas();
		return $r;
		//return "llegue";
	}

///**********************************************************************************************************///								

	$HTTP_RAW_POST_DATA = file_get_contents("php://input");	
	$server->service($HTTP_RAW_POST_DATA);
?>