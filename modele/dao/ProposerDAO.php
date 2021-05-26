<?php
class ProposerDAO
{
    /////////////////////////////////////Recupere tout les produit propose de la semaine en cours/////////////////////////////////////////////

    public static function lesProduitsProposer($semaine){
        $result = [];
        $sql = "SELECT * FROM `proposer` where num_semaine =".$semaine;
        $res = DBConnex::getInstance()->query($sql);
        $liste = $res->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            foreach($liste as $Proposer){
                $uneProposition =new Proposer();
                $uneProposition->hydrate($Proposer);
                $result[] = $uneProposition;
            }
        }
        return $result;
    }

    ////////////////////////////////////////Recupere tous de la semaine d'un produit passe en parametre//////////////////////

    public static function leProduit($semaine,$num)
    {
        $sql = "SELECT * FROM `proposer` where num_semaine =".$semaine. "and id_Pro=".$num;
        $res = DBConnex::getInstance()->query($sql);
        $liste = $res->fetchAll(PDO::FETCH_ASSOC);
        $unePanier=null;
        
        if(!empty($liste))
        {
            $unePanier =new Proposer();
            $unePanier->hydrate($liste);
        }
        return $unePanier;
    }

    //////////////////////////////////////////Recupere le prix du produit selon sa semaine//////////////////////////////////////////////////////

    public static function getPrixProduit($code,$semaine,$codeadh)
    {
        $sql = "SELECT prix FROM `proposer` where id_pro =".$code. " and num_semaine=".$semaine. " and code_adh=".$codeadh;
        $res = DBConnex::getInstance()->query($sql);
        $nom = $res->fetch()[0]; 

        return $nom;
    }

    //////////////////////////////////////////Une vois la commande validé soustrait la qtte//////////////////////////////////////////////////////

    public static  function modifierQtte($qtte,$code,$semaine,$codeadh)
    {
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE proposer SET qtte= qtte-:qtte  where id_pro =:code" ." and num_semaine= :semaine and code_adh= :codeadh");
        
        $requetePrepa->bindParam( ":code",$code);
        $requetePrepa->bindParam( ":qtte",$qtte);
        $requetePrepa->bindParam( ":semaine",$semaine);
        $requetePrepa->bindParam( ":codeadh",$codeadh);

        $requetePrepa->execute();
    }

    public static function getNombre($code,$semaine,$codeadh)
    {
        $sql = "SELECT qtte FROM `proposer` where id_pro =".$code. " and num_semaine=".$semaine. " and code_adh=".$codeadh;
        $res = DBConnex::getInstance()->query($sql);
        $nom = $res->fetch()[0]; 

        return $nom;
    }

}