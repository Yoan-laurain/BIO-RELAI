<?php
class Utilisateur{
    
private  $idUser;
private  $nom;
private  $prenom;
private  $mail;
private  $mdp;

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getMail()
    {
        return $this->login;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setMail($login)
    {
        $this->login = $login;
    }

    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    public function __construct( $login,  $mdp)
    {
        $this->login=$login;
        $this->mdp=$mdp;
    }   
}