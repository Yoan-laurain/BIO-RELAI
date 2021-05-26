<?php
class ClientDAO
{

    ///////////////////////////////Récupère les informations du client en paramètre//////////////////////////////////////////////////////

    public static function lire($code) 
    { 
        $requetePrepa = DBConnex::getInstance()->prepare("select * from client where code_adh = :code_adh");
        $requetePrepa->bindParam( ":code_adh", $code);       
        $requetePrepa->execute();  

        $liste = $requetePrepa->fetchAll(PDO::FETCH_ASSOC); 
        
        if(!empty($liste))
        {
            foreach($liste as $client){
            $uneclient = new client();
            $uneclient->hydrate($client);
            }
        }
        return $uneclient;
    }

    /////////////////////////////////////////////Ajout d'un client////////////////////////////////////////////////////////////////////////
    
    public static function ajouter($unnom,$unPrenom,$unmdp,$unmail) 
    {
        $requetePrepa = DBConnex::getInstance()->prepare("INSERT INTO client(nom_adh,prenom_adh,mdp,mail) VALUES(:nom,:Prenom,md5(:mdp),:Mail)");
        $requetePrepa->bindParam( ":nom", $unnom); 
        $requetePrepa->bindParam( ":Prenom", $unPrenom); 
        $requetePrepa->bindParam( ":mdp", $unmdp); 
        $requetePrepa->bindParam( ":Mail", $unmail); 

        $requetePrepa->execute();
    }  

    //////////////////////////////////Vérification de la présence du client dans la BDD//////////////////////////////////////////////////

    public static function verification(client $client)
    {       
            $requetePrepa = DBConnex::getInstance()->prepare("select code_adh from client where mail = :mail and  mdp = md5(:mdp)");

            $mail= $client->getMail();
            $mdp=$client->getMdp();
                        
            $requetePrepa->bindParam( ":mail",$mail);
            $requetePrepa->bindParam( ":mdp" , $mdp);

            $requetePrepa->execute();   
            
            $code_adh = $requetePrepa->fetch();

            return $code_adh[0];
    }

    //////////////////////////////////Vérification de la présence du de l'email dans la BDD//////////////////////////////////////////////////


    public static function verificationMail(client $client)
    {       
            $requetePrepa = DBConnex::getInstance()->prepare("select code_adh from client where mail = :mail ");

            $mail= $client->getMail();
                        
            $requetePrepa->bindParam( ":mail",$mail);

            $requetePrepa->execute();   
            
            $code_adh = $requetePrepa->fetch();

            return $code_adh[0];
    }

    //////////////////////////////////////////////Modifie sans le mot de passe//////////////////////////////////////////////////////////

    public static  function modifier($nom,$prenom,$email,$codeadh) 
    {
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE client SET nom_adh= :nom , prenom_adh= :prenom ,mail= :email where code_adh = :codeadh");
        
        $requetePrepa->bindParam( ":codeadh",$codeadh);
        $requetePrepa->bindParam( ":nom",$nom);
        $requetePrepa->bindParam( ":prenom",$prenom);
        $requetePrepa->bindParam( ":email",$email);

        $requetePrepa->execute();
    }

    ////////////////////////////////////////////Modifie avec le mot de passe/////////////////////////////////////////////////////////////

    public static  function modifier2($nom,$prenom,$email,$codeadh,$mdp) 
    {
        $requetePrepa = DBConnex::getInstance()->prepare("UPDATE client SET nom_adh= :nom, prenom_adh= :prenom ,mail= :email ,mdp= md5(:mdp) where code_adh = :codeadh");
        
        $requetePrepa->bindParam( ":codeadh",$codeadh);
        $requetePrepa->bindParam( ":nom",$nom);
        $requetePrepa->bindParam( ":prenom",$prenom);
        $requetePrepa->bindParam( ":email",$email);
        $requetePrepa->bindParam( "mdp",$mdp);

        $requetePrepa->execute();
    }

    ///////////////////////////////////////////Supprime un compte/////////////////////////////////////////////////////////////////////////

    public static function supprimer($codeadh)
    {
        $requetePrepa = DBConnex::getInstance()->prepare("DELETE from client where code_adh = :code_adh");

        $requetePrepa->bindParam( ":code_adh",$codeadh);
        $requetePrepa->execute();

    }
}
