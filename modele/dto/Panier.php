<?php

class Panier
{
    use Hydrate;
    private $num_commande;
    private $code_adh;
    private $montant;
    private $id_Pro;
    private $qtte;
    private $Producteur;

    public function getProducteur()
    {
        return $this->Producteur;
    }

    public function setProducteur($Producteur)
    {
        $this->Producteur = $Producteur;
    }

    public function getNum_commande()
    {
        return $this->num_commande;
    }
    
    public function getCode_adh()
    {
        return $this->code_adh;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function getId_Pro()
    {
        return $this->id_Pro;
    }

    public function getQtte()
    {
        return $this->qtte;
    }

    public function setNum_commande($num_commande)
    {
        $this->num_commande = $num_commande;
    }

    public function setCode_adh($code_adh)
    {
        $this->code_adh = $code_adh;
    }

    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    public function setId_Pro($id_Pro)
    {
        $this->id_Pro = $id_Pro;
    }

    public function setQtte($qtte)
    {
        $this->qtte = $qtte;
    } 
}

