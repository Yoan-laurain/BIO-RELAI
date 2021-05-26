<?php
class FactureDAO
{
    /////////////////////////////////////////Recupere toutes les factures de la BDD et les hydrate//////////////////////////////////////////////

    public static function lesFacturesADH($code)
    {
        $result = [];
        $sql = "SELECT * FROM `commande` where code_adh =".$code. " group by NUM_COM";
        $res = DBConnex::getInstance()->query($sql);
        $liste = $res->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($liste)){
            foreach($liste as $Facture){
                $uneFacture =new Facture();
                $uneFacture->hydrate($Facture);
                $result[] = $uneFacture;
            }
        }
        return $result;
    }

    ////////////////////////////////////////////////Ajoute une commande/////////////////////////////////////////////////////////////////////////
    
    public static function ajouter($semaine,$date,$code_adh,$etat)
    {
        $requetePrepa = DBConnex::getInstance()->prepare("INSERT INTO commande(num_semaine,code_adh,date_,etat) VALUES(:semaine,:code,:Date2,:etat)");
        $requetePrepa->bindParam( ":semaine", $semaine); 
        $requetePrepa->bindParam( ":Date2", $date); 
        $requetePrepa->bindParam( ":code", $code_adh); 
        $requetePrepa->bindParam( ":etat", $etat); 

        $requetePrepa->execute();         
    }  

    ////////////////////////////////////////////////Supprime une commande//////////////////////////////////////////////////////////////////////

    public static function supprimer($id)
    {
        //Supprime la commande//

        $requetePrepa = DBConnex::getInstance()->prepare("DELETE from commande where num_com = :num_com");
            
        $requetePrepa->bindParam( ":num_com",$id);
 
        $requetePrepa->execute();

        //Supprime le contenue de la commande//

        $requetePrepa = DBConnex::getInstance()->prepare("DELETE from panier where num_commande = :num_com");
            
        $requetePrepa->bindParam( ":num_com",$id);
 
        $requetePrepa->execute();
    }

    ////////////////////////////////////////Récupère l'etat de code de commande passé en parametre/////////////////////////////////////////////

    public static function lire($code)
    {      
        $requetePrepa = DBConnex::getInstance()->prepare("select etat from commande where num_com = :code");
        $requetePrepa->bindParam( ":code", $code);
        $requetePrepa->execute();
        return  $requetePrepa->fetch()[0];
    }

    /////////////////////////////////////Verifie l'appartenance de la facture du code passé en parametre////////////////////////////////////////

    public static function lireAppartenance($code)
    {      
        $requetePrepa = DBConnex::getInstance()->prepare("select code_adh from commande where num_com = :code");
        $requetePrepa->bindParam( ":code", $code);
        $requetePrepa->execute();
        return  $requetePrepa->fetch()[0];
    }

    /////////////////////////////////////Modifie l'etat de la commande//////////////////////////////////////////////////////////////////////////

    public static  function modifier($code)
    {
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE commande SET etat='validé' where num_com = :code");
        
        $requetePrepa->bindParam( ":code",$code);

        $requetePrepa->execute();
    }

    //////////////////////////////////Recupere le numero de la derniere commande//////////////////////////////////////////////////////////////////

    public static function MAX()
    {      
        $requetePrepa = DBConnex::getInstance()->prepare("select MAX(num_com) from commande");
        $requetePrepa->execute();
        return  $requetePrepa->fetch()[0];
    }

    /////////////////////////////////////Recupere le numero de la semaine de la commande passe en parametre//////////////////////////////////////

    public static function lireSemaine($code)
    {      
        $requetePrepa = DBConnex::getInstance()->prepare("select num_semaine from commande where num_com = :code");
        $requetePrepa->bindParam( ":code", $code);
        $requetePrepa->execute();
        return  $requetePrepa->fetch()[0];
    }

}