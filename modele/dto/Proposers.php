<?php
class Proposers{
	private $Proposers= array();

	public function __construct($array){
		if (is_array($array)) {
			$this->Proposers = $array;
		}
	}

	public function getProposer(){
		return $this->Proposers;
	}

	public function chercheProduit($uneSemaine){
		$i = 0;
		while ($uneSemaine != $this->Proposers[$i]->getNum_semaine() && $i < count($this->Proposers)-1){
			$i++;
		}
		if ($uneSemaine == $this->Proposers[$i]->getNum_semaine()){
			return $this->Proposers[$i];
		}
	}

	public function AjouterProduit(Proposer $proposer)
	{
		$this->Proposers[]=$proposer;
	}
}