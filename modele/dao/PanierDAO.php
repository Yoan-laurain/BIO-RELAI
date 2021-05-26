<?php
class PanierDAO
{       
    //////////////////////////////////////Recupere toutes les Paniers de la commande de la BDD et les hydrate/////////////////////////////////////////////////

    public static function lesElements($code)
    {
        $result = [];
        $sql = "SELECT * FROM `panier` where num_commande =".$code;
        $res = DBConnex::getInstance()->query($sql);
        $liste = $res->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            foreach($liste as $Panier){
                $unePanier =new Panier();
                $unePanier->hydrate($Panier);
                $result[] = $unePanier;
            }
        }
        return $result;
    }

    //////////////////////////////////////////Ajoute du contenue de la commande/////////////////////////////////////////////////////////////////////
    
    public static function ajouter($num_commande,$code_adh,$montant,$idProduit,$qtte,$Producteur)
    {
        $requetePrepa = DBConnex::getInstance()->prepare("INSERT INTO panier(num_commande,code_adh,montant,id_Pro,Qtte,Producteur) VALUES(:num_commande,:code_adh,:montant,:idProduit,:qtte,:Producteur)");
        $requetePrepa->bindParam( ":num_commande", $num_commande);
        $requetePrepa->bindParam( ":code_adh", $code_adh);
        $requetePrepa->bindParam( ":montant", $montant);
        $requetePrepa->bindParam( ":idProduit", $idProduit);
        $requetePrepa->bindParam( ":qtte", $qtte);
        $requetePrepa->bindParam( ":Producteur", $Producteur);

        $requetePrepa->execute();                
    }  
    
    ////////////////////////////SUPPRIME UN ELEMENT DE LA COMMANDE///////////////////////////////////////////////////////////////////

    public static function Supprimer($num_commande,$code_adh,$idProduit,$Producteur)
    {
        $requetePrepa = DBConnex::getInstance()->prepare("DELETE  from panier where num_commande = :num_commande and code_adh = :code_adh and id_Pro = :idProduit and Producteur = :Producteur ");
        $requetePrepa->bindParam( ":num_commande", $num_commande);
        $requetePrepa->bindParam( ":code_adh", $code_adh);
        $requetePrepa->bindParam( ":idProduit", $idProduit);
        $requetePrepa->bindParam( ":Producteur", $Producteur);

        $requetePrepa->execute();                
    }  

    public static function lireProducteurPanier($num_commande,$code_adh,$idProduit)
    {
        $sql = "SELECT Producteur FROM `panier` where num_commande =".$num_commande ." and code_adh = ".$code_adh." and id_Pro =".$idProduit;
        $res = DBConnex::getInstance()->query($sql);
        $liste = $res->fetch()[0];
        return $liste;
    }

    
    public static function lireTout($code)
    {      
        $requetePrepa = DBConnex::getInstance()->prepare("select * from panier where num_commande = :code");
 
        $requetePrepa->bindParam( ":code", $code);
        $requetePrepa->execute();
        return  $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
    }

    public static  function MAJ($codePro,$qtte,$code_adh,$producteur) 
    {
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE panier SET qtte= :qtte where code_adh = :code_adh and Producteur= :producteur and id_Pro= :id_pro");

        $requetePrepa->bindParam( ":qtte",$qtte);
        $requetePrepa->bindParam( ":code_adh",$code_adh);
        $requetePrepa->bindParam( ":producteur",$producteur);
        $requetePrepa->bindParam( ":id_pro",$codePro);

        $requetePrepa->execute();
    }

}