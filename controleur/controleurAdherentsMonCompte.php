<?php

//Recuperer les informations du client//

$Client = ClientDAO::lire($_SESSION['identification']);

//Variables//

$messageErreurCompte="";
$messageErreurPrenom="";
$messageErreurEmail="";
$messageErreurMdp="";
$messageErreurModif="";
$messageErreurMp="";
$messageErreurCompte="";

///////////////////////////////////////////Si il appuie sur le bouton sauvegarder/////////////////////////////////////////////////////////

if(isset($_POST['Modif'])) 
{
    if ((preg_match("#(?:[[:alpha:]]{1,30}|[-']{1})#i",($_POST['Prenom'])) &&  (preg_match("#(?:[[:alpha:]]{1,30}|[-']{1})#i",($_POST['Nom'])))))//Verifie le prénom et le nom//
    {}     
    else
    {
        $messageErreurPrenom="nom et/ou prénom incorrect!";
    }     
    if(preg_match('`^[[:alnum:]]([-_.]?[[:alnum:]])*@[[:alnum:]]([-.]?[[:alnum:]])*\.([a-z]{2,4})$`',($_POST['mail2']))) //Vérifie l'email//
    {}
    else
    {
        $messageErreurEmail="L Email doit etre correct"; 
    }   
    if (isset($_POST['Newmdp'])) //Si il veut aussi changer sont mot de passe//
    {
        if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{3,14}$/",$_POST['Newmdp'])) //Vérifie le mdp//
        {}
        else
        {
            $messageErreurMdp="le mot de passe doit etre correct!";
            $messageErreurMp="Le mot de passe doit avoir 1 majuscules,minuscule,chiffre,caracteres special et contenir au total 5 caracteres minimum et 14 maximum";
        }
        if (md5($_POST['mdp'])==$Client->getMdp())     //Si l'ancien mdp est correct//
        {}
        else                                                                                  
        {
            $messageErreurModif = "Ancien mot de passe est incorrect";
        }
    }

    if ($messageErreurEmail=='' && $messageErreurModif=='' && $messageErreurPrenom=='' && !isset($_POST['Newmdp'])) //Si il veut changer ses informtions sans le mdp//
    {

        $Client2 = new Client($_POST['mail2'], $Client->getMdp());
        //Verifie si le compte n'exite pas deja//

        if (ClientDAO::verificationMail($Client)=="" || $Client->getMail()==$_POST['mail2'])
        {
            ClientDAO::Modifier($_POST['Nom'],$_POST['Prenom'],$_POST['mail2'],$Client->getcode_Adh());    
            header('location: index.php');  
        }
        else
        {
            $messageErreurCompte="Ce compte existe déja!";
        }
    }
    else if ($messageErreurEmail=='' && $messageErreurModif=='' && $messageErreurPrenom=='' && $messageErreurMdp=='' && isset($_POST['Newmdp']))//Si il veut changer egalement le mdp//
    {
        $Client3 = new Client($_POST['mail2'],  $Client->getMdp());
        
        //Verifie si le compte n'exite pas deja//

        var_dump($Client->getcode_Adh());

        if (ClientDAO::verificationMail($Client3)=="" || $Client3->getMail()==$_POST['mail2'])
        {
            ClientDAO::Modifier2($_POST['Nom'],$_POST['Prenom'],$_POST['mail2'],$Client->getcode_Adh(),$_POST['Newmdp']);      
            header('location: index.php');  
        }
        else
        {
            $messageErreurCompte="Ce compte existe déja!";
        }
    }
}

//Permet de ne pas re-remplir les champs pour afficher l'erreur//

if ($messageErreurPrenom!="")
{
    $Prenom="";
    $nom="";
}
else  
{
    $Prenom=$Client->getPrenom_Adh();
    $nom=$Client->getNom_Adh();
}

if($messageErreurEmail!="")
{
    $Mail="";
}
else{
    $Mail= $Client->getMail();
}

//////////////////////////////////////////////////DEBUT FORMULAIRE////////////////////////////////////////////////////////////////////////////

//Formulaire des informations du compte//

$formulaireCompte = new Formulaire('post', 'index.php', 'fCompte', 'fCompte');

$formulaireCompte->ajouterComposantLigne($formulaireCompte->creerLabel('Prenom :'));	
$formulaireCompte->ajouterComposantLigne($formulaireCompte->creerInputTexte('Prenom', 'Prenom',$Prenom , 0,$messageErreurPrenom, ''));
$formulaireCompte->ajouterComposantTab();

$formulaireCompte->ajouterComposantLigne($formulaireCompte->creerLabel('Nom :'));
$formulaireCompte->ajouterComposantLigne($formulaireCompte->creerInputTexte('Nom', 'Nom',$nom, 1, $messageErreurPrenom, ''));
$formulaireCompte->ajouterComposantTab();

$formulaireCompte->ajouterComposantLigne($formulaireCompte->creerLabel('Email :'));
$formulaireCompte->ajouterComposantLigne($formulaireCompte->creerInputTexte('mail2', 'mail2',$Mail, 1, $messageErreurEmail, ''));
$formulaireCompte->ajouterComposantTab();

if(isset($_POST['Changer']) || isset($_POST['Modif']) && isset($_POST['Newmdp'])) //Si il veut changer de mot de passe//
{
    $formulaireCompte->ajouterComposantLigne($formulaireCompte->creerLabel(' Ancien Mot de Passe :'));
    $formulaireCompte->ajouterComposantLigne($formulaireCompte->creerInputMdp('mdp', 'mdp',  1, $messageErreurModif, ''));
    $formulaireCompte->ajouterComposantTab();

    $formulaireCompte->ajouterComposantLigne($formulaireCompte->creerLabel('Nouveau Mot de Passe :'));
    $formulaireCompte->ajouterComposantLigne($formulaireCompte->creerInputMdp('Newmdp', 'Newmdp',  1, $messageErreurMdp, ''));
    $formulaireCompte->ajouterComposantTab();

}
else
{
    $formulaireCompte->ajouterComposantLigne($formulaireCompte-> creerInputSubmit('Changer', 'Changer', 'Modifier MDP'));
}

$formulaireCompte->ajouterComposantLigne($formulaireCompte-> creerInputSubmit('Sup', 'Sup', 'Supprimer'));

$formulaireCompte->ajouterComposantLigne($formulaireCompte-> creerInputSubmit('Modif', 'Modif', 'Sauvegarder'));
$formulaireCompte->ajouterComposantTab();

	
$formulaireCompte->ajouterComposantLigne($formulaireCompte->creerMessage($messageErreurMp.$messageErreurCompte));    
$formulaireCompte->ajouterComposantTab();

$formulaireCompte->creerFormulaire();

/////////////////////////////////////////////////////////////FIN FORMULAIRE/////////////////////////////////////////////////////////////////////

require_once 'vue/adherents/vueAdherentsMonCompte.php' ;
?>