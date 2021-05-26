<?php
class ProducteurDAO
{
    //////////////////////////////Récupère les informations du producteur en paramètre et hydrate////////////////////////////////////////////////

    public static function lire($code) 
    { 
        $requetePrepa = DBConnex::getInstance()->prepare("select * from producteur where code_adh = :code_adh");
        $requetePrepa->bindParam( ":code_adh", $code);       
        $requetePrepa->execute();  

        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC); 
        
        if(!empty($liste))
        {
            foreach($liste as $Producteur){
            $uneProducteur = new Producteur();
            $uneProducteur->hydrate($Producteur);
            }
        }
        return $uneProducteur;
    }

    /////////////////////////////////Recupere les informations de tous les producteurs et les hydrate////////////////////////////////////////

    public static function lesProducteurs()
    {
        $result=[];

        $requetePrepa = DBConnex::getInstance()->prepare("select * from producteur");
        $requetePrepa->execute();
        $liste=$requetePrepa->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){

            foreach($liste as $Producteur){
                $unProducteur = new Producteur();
                $unProducteur->hydrate($Producteur);
                $result[] = $unProducteur;
            }
        }
        return $result;
    }

    /////////////////////////////Recupere le nom et le prenom du producteur dont le code est passe en parametre////////////////////////////////

    public static function getNomProducteur($code)
    {
        $requetePrepa = DBConnex::getInstance()->prepare("SELECT nom_adh FROM `producteur` where code_adh = :code_adh");
        $requetePrepa->bindParam( ":code_adh", $code);       
        $requetePrepa->execute();  

        $requetePrepa2 = DBConnex::getInstance()->prepare("SELECT prenom_adh FROM `producteur` where code_adh =:code_adh ");
        $requetePrepa2->bindParam( ":code_adh", $code);       
        $requetePrepa2->execute(); 

        $liste = $requetePrepa->fetch()[0]; 
        $liste = $liste."-".$requetePrepa2->fetch()[0];
        return $liste;
    }

}
