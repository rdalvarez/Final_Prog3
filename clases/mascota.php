<?php
/**
*		ACCESO POR TXT
*/				
class Mascota
{
	public $id;
	public $nombre;
	public $raza;
	public $tipo;

	//CONSTRUCTOR
	function __construct($nombre=NULL,$raza=NULL,$tipo=NULL)
	{
		if ($nombre!=NULL && $raza !=NULL && $tipo!=NULL) {
			$this->id = Mascota::ObtenerUltimoId() + 1;
			$this->nombre = $nombre;
			$this->raza = $raza;
			$this->tipo = $tipo;
		}
	}

	//METODO DE CLASE
	public function ToString(){
		return $this->id." - ".$this->nombre." - ".$this->raza." - ".$this->tipo."\n\r";
	}
	public static function ToString2($id,$nombre,$raza,$tipo){
		return $id." - ".$nombre." - ".$raza." - ".$tipo."\n\r";
	}
	//METODOS STATICOS
	public static function ObtenerUltimoId(){
		$a = fopen("BD/Mascotas.txt", "r");
		$ultimoID = 0;
		while (!feof($a)) {
			$arr = explode(" - ",fgets($a));
			if (count($arr) > 1) {
				$ultimoID = $arr[0];
			}
		}
		return $ultimoID;
	}
	public static function ObtenerMascotaPorId($id){
		$objAuto = new AutoTXT();
		$a = fopen("BD/Mascotas.txt", "r");
		while (!feof($a)) {
			$arr = explode(" - ", fgets($a));

			if (count($arr) > 1) {
				if (trim($arr[0]) == $id) {
					$objAuto->nombre = $arr[1];
					$objAuto->raza = $arr[2];
					$objAuto->tipo = trim($arr[3]);
					break;
				}
			}
		}
		fclose($a);
		return $objAuto;
	}
	public function InsertarMascota(){
		$a = fopen("BD/Mascotas.txt", "a");
		$r = fwrite($a, $this->ToString());	//DEVUELVE la cantidad de caracteres que escribio
		fclose($a);
		return $r;
	}
	public static function TraerTodasLasMascotas(){
		$arrMascotas = array();
		$a = fopen("BD/Mascotas.txt", "r");
		while (!feof($a)) {
			$arr = explode(" - ", fgets($a));
			if (count($arr) > 1) {
				$material = array();
				$material['id'] = trim($arr[0]);
				$material['nombre'] = $arr[1];
				$material['raza'] = $arr[2];
				$material['tipo'] = trim($arr[3]);

				//WB NO LE GUSTA
				// $material = new Mascota();
				// $material->id = $arr[0];
				// $material->nombre = $arr[1];
				// $material->raza = $arr[2];
				// $material->tipo = $arr[3];

				array_push($arrMascotas, $material);
			}
		}
		fclose($a);
		return $arrMascotas;
	}
	public static function ModificarMascota($arr){

		$resultado = TRUE;

		$arrMascotasLeidos = Mascota::TraerTodasLasMascotas();

		$ListaDeMascotas = array();
		
		for($i=0; $i<count($arrMascotasLeidos); $i++){
			if($arrMascotasLeidos[$i]['id'] == $arr['id']){//encontre el modificado lo modifico todo menos el indice
				$ListaDeMascotas[$i]['id'] = $arr['id'];
				$ListaDeMascotas[$i]['nombre'] = $arr['nombre'];
				$ListaDeMascotas[$i]['raza'] = $arr['raza'];
				$ListaDeMascotas[$i]['tipo'] = $arr['tipo'];
				continue;
			}
			$ListaDeMascotas[$i] = $arrMascotasLeidos[$i];
		}
		
		//ABRO EL ARCHIVO
		$ar = fopen("BD/Mascotas.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeMascotas AS $item){
			$cant = fwrite($ar, Mascota::ToString2($item['id'],$item['nombre'],$item['raza'],$item['tipo']));
			
			if($cant < 1)
			{
				$resultado = FALSE;
				break;
			}
		}
		
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;

	}

}
?>
