<?php
class Factures
{
	private $Factures= array();

	public function __construct($array)
	{
		if (is_array($array)) 
		{
			$this->Factures = $array;
		}
	}

	public function getFactures()
	{
		return $this->Factures;
	}

	public static function chercheFacture($unIdFacture)
	{
		$i = 0;
		while ($unIdFacture != $this->Factures[$i]->getNum_com() && $i < count($this->Factures)-1)
		{
			$i++;
		}
		if ($unIdFacture == $this->Factures[$i]->getNum_com())
		{
			return $this->Factures[$i];
		}
	}
}