<?php

//Variables//

$messageErreurConnexion="";

if(!isset($_SESSION['identification']) || !$_SESSION['identification']){  //Creation du formulaire de connexion//

	$formulaireConnexion = new Formulaire('post', 'index.php', 'fConnexion', 'fConnexion');
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabel('Email :'));
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputTexte('mail', 'mail', '', 1, 'Entrez votre mail', ''));
	$formulaireConnexion->ajouterComposantTab();

	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabel('Mot de Passe :'));
	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputMdp('mdp', 'mdp',  1, 'Entrez votre mot de passe', ''));
	$formulaireConnexion->ajouterComposantTab();

	$formulaireConnexion->ajouterComposantLigne($formulaireConnexion-> creerInputSubmit('submitConnex', 'submitConnex', 'Se connecter'));
	$formulaireConnexion->ajouterComposantTab();
	
	$formulaireConnexion->creerFormulaire();

	$formulaireConnexion2 = new Formulaire('post', 'index.php', 'fConnexion', 'fConnexion');
	
	$formulaireConnexion2->ajouterComposantLigne($formulaireConnexion2->creerLabel('Premiere visite :'));
	$formulaireConnexion2->ajouterComposantLigne($formulaireConnexion2-> creerInputSubmit('Inscription', 'Inscription', 'Crée un compte'));
	$formulaireConnexion2->ajouterComposantTab();

	$formulaireConnexion2->ajouterComposantLigne($formulaireConnexion2->creerMessage($messageErreurConnexion));
	$formulaireConnexion2->ajouterComposantTab();
		
	$formulaireConnexion2->creerFormulaire();

	require_once 'vue/vueConnexion.php' ;
}
else
{
	$_SESSION['identification']=[];
	$_SESSION['MP']="accueil";
	header('location: index.php');
}


