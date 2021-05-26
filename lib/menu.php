<?php

class Menu{
	private $style;
	private $composants = [];

	public function __construct($unStyle ){
		$this->style = $unStyle;
	}

	public function ajouterComposant($unComposant){
		$this->composants[] = $unComposant;
	}

	public function creerItemLien($unLien,$uneValeur){
		$composant = array();
		$composant[0] = $unLien ;
		$composant[1] = $uneValeur ;
		return $composant;
	}

	public function creerMenu($composantActif,$nomMenu){
		$menu = "<ul class = '" .  $this->style . "'>";
		foreach($this->composants as $composant){
			if($composant[0] == $composantActif){
				$menu .= "<li class='actif'>";
				$menu .=  "<span>" . $composant[1] ."</span>";
			}
			else{
				$menu .= "<li>";
				$menu .= "<a href='index.php?" . $nomMenu ;
				$menu .= "=" . $composant[0] . "' >";
				$menu .= "<span>" . $composant[1] ."</span>";
				$menu .= "</a>";
			}
			$menu .= "</li>";
		}
		$menu .= "</ul>";
		return $menu ;
	}

	public function creerMenufacture($composantActif){
		$menu = "<ul class = '" .  $this->style . "'>";
		foreach($this->composants as $composant){
			if($composant[0] == $composantActif){
				$menu .= "<li class='actif'>";
				$menu .=  $composant[1] ;
			}
			else{
				$menu .= "<li>";
				$menu .= "<a href='index.php?action=afficher" ;
				$menu .= "&Vehicule=" . $composant[0] . "' >";
				$menu .= $composant[1] ;
				$menu .= "</a>";
			}
			$menu .= "</li>";
		}
		$menu .= "</ul>";
		return $menu ;
	}
}