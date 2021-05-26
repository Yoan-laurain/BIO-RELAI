<?php

class ProduitDAO
{
    //////////////////////////////Recupere le nom du produit dont le code est passé en parametre///////////////////////////////////////////

    public static function getNomProduit($code)
    {
        $sql = "SELECT libelle_pro FROM `produit` where id_pro =".$code;
        $res = DBConnex::getInstance()->query($sql);
        $nom = $res->fetch()[0];  
        return $nom;
    }

    ////////////////////////////Recupere le code du produit dont le nom est passe en parametre////////////////////////////////////////////

    public static function getCodeProduit($nom)
    {
        $sql = "SELECT id_pro FROM `produit` where id_pro =".$nom;
        $res = DBConnex::getInstance()->query($sql);
        $nom = $res->fetch()[0];  
        return $nom;
    }
}