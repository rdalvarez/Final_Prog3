<?php 

/**
* 
*/
class Login
{

	public $_usuario;
	public $_contraseña;
	public $_tipo;
	
	function __construct($usuario=NULL, $contraseña=NULL, $tipo=NULL)
	{
		if ($usuario!=NULL) {
			$this->_usuario = $usuario;
			$this->_contraseña = $contraseña;
			$this->_tipo = $tipo;
		}
	}

	public static function TraerTodosLosUsuarios()
	{
		$ListaDeUsuarios = array();

		$archivo = fopen("usuarios.txt", "r");

		while (!feof($archivo)) {
			$linea = fgets($archivo);

			$stringUsuario = explode(", ", $linea);

			for ($i=0; $i < count($stringUsuario); $i++) { 
				$auxUsuario[$i] = str_replace("'", "",trim($stringUsuario[$i]));
			}

			if ($auxUsuario[0] != "") {
				array_push($ListaDeUsuarios, new Login($auxUsuario[0],$auxUsuario[1],$auxUsuario[2]));
			}
		}
		fclose($archivo);
		return $ListaDeUsuarios;
	}
}
 ?>