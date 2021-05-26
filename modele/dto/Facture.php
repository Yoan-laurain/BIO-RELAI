<?php
class Facture
{
    use hydrate;
    private $num_com;
    private $num_semaine;
    private $code_adh;
    private $date_;
    private $etat;

    public function getNum_com()
    {
        return $this->num_com;
    }

    public function getNum_semaine()
    {
        return $this->num_semaine;
    }

    public function getCode_adh()
    {
        return $this->code_adh;
    }

    public function getDate_()
    {
        return $this->date_;
    }

    public function getEtat()
    {
        return $this->etat;
    }

    public function setNum_com($num_com)
    {
        $this->num_com = $num_com;
    }

    public function setNum_semaine($num_semaine)
    {
        $this->num_semaine = $num_semaine;
    }

    public function setCode_adh($code_adh)
    {
        $this->code_adh = $code_adh;
    }

    public function setDate_($date_)
    {
        $this->date_ = $date_;
    }

    public function setEtat($etat)
    {
        $this->etat = $etat;
    }   
}