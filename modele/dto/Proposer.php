<?php

class Proposer
{
    use Hydrate;
    private $num_semaine;
    private $id_PRO;
    private $qtte;
    private $prix;
    private $unite;
    private $code_adh;

    public function getNum_semaine()
    {
        return $this->num_semaine;
    }

    public function getId_PRO()
    {
        return $this->id_PRO;
    }

    public function getQtte()
    {
        return $this->qtte;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function getUnite()
    {
        return $this->unite;
    }

    public function getCode_adh()
    {
        return $this->code_adh;
    }

    public function setNum_semaine($num_semaine)
    {
        $this->num_semaine = $num_semaine;
    }

    public function setId_PRO($id_PRO)
    {
        $this->id_PRO = $id_PRO;
    }

    public function setQtte($qtte)
    {
        $this->qtte = $qtte;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    public function setUnite($unite)
    {
        $this->unite = $unite;
    }

    public function setCode_adh($code_adh)
    {
        $this->code_adh = $code_adh;
    }
}

