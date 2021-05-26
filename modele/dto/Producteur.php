<?php

class Producteur
{
    use Hydrate;
    private $code_adh;
    private $adresse;
    private $commune;
    private $codepostal;
    private $descriptif;
    private $nom_adh;
    private $prenom_adh;

    public function getCode_adh()
    {
        return $this->code_adh;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function getCommune()
    {
        return $this->commune;
    }

    public function getCodepostal()
    {
        return $this->codepostal;
    }

    public function getDescriptif()
    {
        return $this->descriptif;
    }

    public function getNom_adh()
    {
        return $this->nom_adh;
    }

    public function getPrenom_adh()
    {
        return $this->prenom_adh;
    }

    public function setCode_adh($code_adh)
    {
        $this->code_adh = $code_adh;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    public function setCommune($commune)
    {
        $this->commune = $commune;
    }

    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;
    }

    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;
    }

    public function setNom_adh($nom_adh)
    {
        $this->nom_adh = $nom_adh;
    }

    public function setPrenom_adh($prenom_adh)
    {
        $this->prenom_adh = $prenom_adh;
    } 
}

