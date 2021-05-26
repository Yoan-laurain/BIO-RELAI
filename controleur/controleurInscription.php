<?php
//Inscription d'un client//

$Validation=false;

//Variables//

$messageErreurInscription="";
$messageErreurPrenom="";
$messageErreurEmail="";
$messageErreurEmailConf="";
$messageErreurMdp="";
$messageErreurCompte="";
$messageErreurMp="";

//////////////////////////////////Si il appuie sur le bouton crée un compte///////////////////////////////////////////////////////////////

if (isset($_POST['Crée']))                                                               
{ 
    if ((preg_match("#(?:[[:alpha:]]{1,30}|[-']{1})#i",($_POST['Prenom'])) &&  (preg_match("#(?:[[:alpha:]]{1,30}|[-']{1})#i",($_POST['Nom'])))))//Verifie le prénom et le nom//
    {}     
    else
    {
        $messageErreurPrenom="nom et/ou prénom incorrect!";
    }     
    if(preg_match('`^[[:alnum:]]([-_.]?[[:alnum:]])*@[[:alnum:]]([-.]?[[:alnum:]])*\.([a-z]{2,4})$`',($_POST['Email']))) //Vérifie l'email//
    {}
    else
    {
        $messageErreurEmail="L Email doit etre correct"; 
    }   
    if(preg_match('`^[[:alnum:]]([-_.]?[[:alnum:]])*@[[:alnum:]]([-.]?[[:alnum:]])*\.([a-z]{2,4})$`',$_POST['Conf'])) //Vérifie la confirmation de l'email//
    {}
    else
    {
       $messageErreurEmailConf="L Email de confirmation doit etre correct";
    } 
    if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{3,14}$/",$_POST['mdp'])) //Vérifie le mdp//
    {} 
    else
    {
        $messageErreurMdp="le mot de passe doit etre correct!";
        $messageErreurMp="Le mot de passe doit avoir 1 majuscules,minuscule,chiffre,caracteres special et contenir au total 5 caracteres minimum et 14 maximum";
    }

    if (($_POST['Email'])==($_POST['Conf']))     //Si l'email et sa confirmation sont equivalentes//
    {}
    else                                                                                  
    {
        $messageErreurInscription = "Les deux emails doivent etre identiques";
    }

    //Si tout est bon ajoute le client//

    if ($messageErreurEmail=='' && $messageErreurEmailConf=='' && $messageErreurInscription=='' && $messageErreurMdp=='' && $messageErreurPrenom=='')
    {
        $Client = new Client($_POST['Email'], $_POST['mdp']);
        //Verifie si le compte n'exite pas deja//

        if (ClientDAO::verificationMail($Client)=="")
        {
            ClientDAO::ajouter($_POST['Nom'],$_POST['Prenom'],$_POST['mdp'],$_POST['Email']);      
            $Validation=true;
        }
        else
        {
            $messageErreurCompte="Ce compte existe déja!";
        }
    }
}
//////////////////////////////////////////////DEBUT DU FORMULAIRE//////////////////////////////////////////////////////////////
if(!$Validation)
{ 
	$formulaireInscription = new Formulaire('post', 'index.php', 'fInscription', 'fInscription');
	
	$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Prenom :'));	
	$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('Prenom', 'Prenom', "", 0, $messageErreurPrenom, ''));
	$formulaireInscription->ajouterComposantTab();

	$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Nom :'));
	$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('Nom', 'Nom','',  1, $messageErreurPrenom, ''));
    $formulaireInscription->ajouterComposantTab();
    
    $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Email :'));
	$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('Email', 'Email', '', 2, $messageErreurEmail, ''));
	$formulaireInscription->ajouterComposantTab();
    
    $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Confirmation Email :'));
	$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('Conf', 'Conf','',  3, $messageErreurEmailConf, ''));
    $formulaireInscription->ajouterComposantTab();
    
    $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Mot de Passe :'));
	$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputMdp('mdp', 'mdp',  4, $messageErreurMdp, ''));
    $formulaireInscription->ajouterComposantTab();
    
    $formulaireInscription->ajouterComposantLigne($formulaireInscription-> creerInputSubmit('Crée', 'Crée', 'Crée un compte'));
	$formulaireInscription->ajouterComposantTab();
	
	$formulaireInscription->ajouterComposantLigne($formulaireInscription->creerMessage($messageErreurInscription.$messageErreurCompte.$messageErreurMp));    
	$formulaireInscription->ajouterComposantTab();
    
    $formulaireInscription->creerFormulaire();
    
///////////////////////////////////////////////////////FIN DU FORMULAIRE/////////////////////////////////////////////////////////////////////////

	require_once 'vue/vueInscription.php' ;
}
else
{
	require_once 'vue/visiteurs/vueConfirmationInscription.php' ;
}