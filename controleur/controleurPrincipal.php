<?php

//Variables//

$semaine=date('W');
$date = date('yy-m-d');
$messageErreurConnexion = "Login ou mdp incorrect";

if(isset($_GET['MP']))
{
	$_SESSION['MP']= $_GET['MP'];
}
else
{
    if(!isset($_SESSION['MP']))
    {
		$_SESSION['MP']="accueil";
	}
}

///////////////////////////////////////////Si il veut se connecter//////////////////////////////////////////////////////////

if (isset($_POST['submitConnex'])) 
{
    //Creation d'un objet client et recuperation des infos correspondante au mail et mdp//
    
    $Client = new Client($_POST['mail'], $_POST['mdp']);
    $_SESSION['identification'] = ClientDAO::verification($Client);

    if($_SESSION['identification']) //Est authentifie//
    {
        $_SESSION['MP']="AdherentsAchats";
    }
    else //N'est pas authentifie//
    {
        echo $messageErreurConnexion;
    }
}
elseif(isset($_POST['Inscription'])) //Si il veut cree un compte//
{
	$_SESSION['MP']="inscription";
	header('location: index.php');
}

///////////////////////////////Si il veut supprimer sont compte//////////////////////////////////////////////////////////

if (isset($_POST['Sup'])) 
{
    ClientDAO::supprimer($_SESSION['identification']);
    unset($_SESSION['identification']);
    $_SESSION['MP']="Accueil";
}

//Menu//

$MP = new Menu("MP");

//Affiche connexion ou deconnexion suivant si l'utilisateur est connect�//

if (isset($_SESSION['identification']) && ($_SESSION['identification'])) //Si il est authentifi� //
{
    $MP->ajouterComposant($MP->creerItemLien("AdherentsAchats", "Achats"));
    $MP->ajouterComposant($MP->creerItemLien("AdherentsPanier", "Panier"));
    $MP->ajouterComposant($MP->creerItemLien("AdherentsFactures", "Factures"));
    $MP->ajouterComposant($MP->creerItemLien("AdherentsMonCompte", "Mon compte"));
    $MP->ajouterComposant($MP->creerItemLien("connexion", "Deconnexion")); 
}
else
{
    $MP->ajouterComposant($MP->creerItemLien("accueil", "Accueil"));
    $MP->ajouterComposant($MP->creerItemLien("VisiteurFonctionnement", "Fonctionnement"));
    $MP->ajouterComposant($MP->creerItemLien("VisiteurProducteur", "Producteurs"));
    $MP->ajouterComposant($MP->creerItemLien("VisiteurProduits", "Produits"));
    $MP->ajouterComposant($MP->creerItemLien("connexion", "Se connecter")); 
}

$menuPrincipalM2L = $MP->creerMenu($_SESSION['MP'],'MP'); //Cr�ation du menu//

include_once dispatcher::dispatch($_SESSION['MP']); 