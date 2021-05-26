<?php
class Client
{
    use hydrate;
    private $code_Adh;
    private $nom_Adh;
    private $prenom_Adh;
    private $mdp;
    private $mail;

    public function __construct($mail = NULL,$mdp = NULL)
    {
        $this->mail=$mail;
        $this->mdp=$mdp;
    }

    public function getCode_Adh()
    {
        return $this->code_Adh;
    }

    public function getNom_Adh()
    {
        return $this->nom_Adh;
    }

    public function getPrenom_Adh()
    {
        return $this->prenom_Adh;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setCode_Adh($code_Adh)
    {
        $this->code_Adh = $code_Adh;
    }

    public function setNom_Adh($nom_Adh)
    {
        $this->nom_Adh = $nom_Adh;
    }

    public function setPrenom_Adh($prenom_Adh)
    {
        $this->prenom_Adh = $prenom_Adh;
    }

    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }
    
    public function setMail($mail)
    {
        $this->mail = $mail;
    }
}
?>
    