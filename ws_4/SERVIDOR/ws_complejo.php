<?php 
	require_once('./lib/nusoap.php'); 
	
	$server = new nusoap_server(); 

	$server->configureWSDL('WebService Complejo', 'urn:testWSDL'); 

//AGREGO TIPO COMPLEJO, INFORMANDO SU ESTRUCTURA	
	$server->wsdl->addComplexType(
									'Persona',
									'complexType',
									'struct',
									'all',
									'',
									array('Nombre' => array('name' => 'Nombre', 'type' => 'xsd:string'),
										  'Edad' => array('name' => 'Edad', 'type' => 'xsd:int'),
										  'Sexo' => array('name' => 'Sexo', 'type' => 'xsd:string')
										 )
								);
//PARAMETROS DE SALIDA DE TIPOS COMPLEJOS								
	$server->wsdl->addComplexType(
									'Retorno',
									'complexType',
									'struct',
									'all',
									'',
									array('Mensaje' => array('name' => 'Mensaje', 'type' => 'xsd:string')
										 )
								);
///**********************************************************************************************************///								
//REGISTRO METODO CON PARAMETRO DE ENTRADA COMPLEJO Y PARAMETRO DE SALIDA 'SIMPLE'
	$server->register('SaludarPersona',                	
						array('Persona' => 'tns:Persona'),  
						array('return' => 'xsd:string'),   
						'urn:testWSDL',                		
						'urn:testWSDL#SaludarPersona',             
						'rpc',                        		
						'encoded',                    		
						'Saluda a una persona'    			
					);


	function SaludarPersona($p) {

		$saludo = 'Hola, ' . $p['Nombre'] .
		' tu edad es de ' . $p['Edad'] .
		' a&ntilde;os y eres ' . $p['Sexo'] . '.';
		
		return $saludo;
	}
///**********************************************************************************************************///								

///**********************************************************************************************************///								
//REGISTRO METODO CON PARAMETRO DE ENTRADA COMPLEJO Y PARAMETRO DE SALIDA COMPLEJO
	$server->register('SaludarPersonaCompleja',                	
						array('Persona' => 'tns:Persona'),  
						array('return' => 'tns:Retorno'),   
						'urn:testWSDL',                		
						'urn:testWSDL#SaludarPersona',             
						'rpc',                        		
						'encoded',                    		
						'Saluda a una persona con retorno complejo'    			
					);


	function SaludarPersonaCompleja($p) {

		$saludo = 'Hola, ' . $p['Nombre'] .
		' tu edad es de ' . $p['Edad'] .
		' a&ntilde;os y eres ' . $p['Sexo'] . '.';
		
		return array('Mensaje' => $saludo);
	}
///**********************************************************************************************************///								

	$HTTP_RAW_POST_DATA = file_get_contents("php://input");	
	$server->service($HTTP_RAW_POST_DATA);
