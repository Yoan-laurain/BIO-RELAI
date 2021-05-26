<?php
class Producteurs{
	private $Producteurs= array();

	public function __construct($array){
		if (is_array($array)) {
			$this->Producteurs = $array;
		}
	}

	public function getProducteurs(){
		return $this->Producteurs;
	}

	public function chercheFacture($unIdFacture){
		$i = 0;
		while ($unIdFacture != $this->Producteurs[$i]->getCode_adh() && $i < count($this->Producteurs)-1){
			$i++;
		}
		if ($unIdFacture == $this->Producteurs[$i]->getCode_adh()){
			return $this->Producteurs[$i];
		}
	}
}