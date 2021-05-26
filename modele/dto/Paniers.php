<?php
class Paniers
{
	private $Paniers= array();

	public function __construct($array)
	{
		if (is_array($array)) 
		{
			$this->Paniers = $array;
		}
	}

	public function getPaniers()
	{
		return $this->Paniers;
	}

	public static function chercheElement($unIdPanier)
	{
		$i = 0;
		while ($unIdPanier != $this->Paniers[$i]->getNum_com() && $i < count($this->Paniers)-1)
		{
			$i++;
		}
		if ($unIdPanier == $this->Paniers[$i]->getNum_com())
		{
			return $this->Paniers[$i];
		}
	}
}