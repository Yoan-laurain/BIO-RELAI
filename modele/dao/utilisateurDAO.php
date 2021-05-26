<?php

class UtilisateurDAO extends PDO 
{         
   //////////////////////////////////////////////////Vérifie le statut de l'utilisateur//////////////////////////////////////////

   public static function verification(Utilisateur $utilisateur)
     {
        $requetePrepa = DBConnex::getInstance()->prepare("select * from client where mail = :mail and  mdp = md5(:mdp)");
        $mail= $utilisateur->getMail();
        $mdp=$utilisateur->getMdp();
            
        $requetePrepa->bindParam( ":mail",$mail);
        $requetePrepa->bindParam( ":mdp" , $mdp);
            
        $requetePrepa->execute();
        $mail= $requetePrepa->fetch();
   
        return $mail;
     }
}