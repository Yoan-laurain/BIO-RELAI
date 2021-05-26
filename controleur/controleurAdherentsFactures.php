<?php

//Variables//

$messageErreurSuppression="";
$messageErreurValide="";

/////////////////////////////////////////Si il veut voir le contenue de sa commande///////////////////////////////////////////////////////////

if(isset($_POST['Voir']))
{
    $_SESSION['numCom']=$_POST['choix'];
    $_SESSION['MP']="AdherentsPanier";
    header('location: index.php');
}

////////////////////////////////////////Si il veut supprimer une commande//////////////////////////////////////////////////////////////////////

if (isset($_POST['Supprimer'])) 
{
    if (FactureDAO::lire($_POST['choix'])=='En attente') //Si elle est en attente//
    {
        FactureDAO::supprimer($_POST['choix']);
        header('location: index.php');
    }
    else
    {
        $messageErreurSuppression="Vous ne pouvez pas supprimez une commande validé!";
    } 
}

///////////////////////////////////////Si il veut valider sa commande//////////////////////////////////////////////////////////////////////////

if(isset($_POST['Valide']))
{
    if (FactureDAO::lire($_POST['choix'])=="validé")
    {
        $messageErreurValide="La commande est déjà validé!";
    }
    else
    {
        FactureDAO::modifier($_POST['choix']);
        $Lesitems = (PanierDAO::lesElements($_POST['choix']));

        foreach ($Lesitems as $item)
        {     
            ProposerDAO::modifierQtte($item->getQtte(),$item->getId_Pro(),FactureDAO::lireSemaine($_POST['choix']),$item->getProducteur());
        }
        header('location: index.php');
    }
}

//Instancier un objet contenant la liste des factures et le conserver dans une variable de session//

$_SESSION['listeFactures'] = new Factures(FactureDAO::lesFacturesADH($_SESSION['identification']));
 
/////////////////////////////////////////////////DEBUT FORMULAIRE///////////////////////////////////////////////////////////////////////

$formulaireFacture = new Formulaire('post', 'index.php', 'fFacture', 'fFacture');

///Si il ne possede aucune factures///

if (empty($_SESSION['listeFactures']->getFactures()))
{
    $formulaireFacture->ajouterComposantLigne($formulaireFacture->creerLabel('Vous n avez pas de factures! Vous pouvez en passez une dans lespace achat'));	
    $formulaireFacture->ajouterComposantTab();
}
else
{
    $formulaireFacture->ajouterComposantLigne($formulaireFacture->creerLabel("<H1> Toutes les Factures </H1>"));
    $formulaireFacture->ajouterComposantLigne("<tr>");
    $formulaireFacture->ajouterComposantLigne("<table class='Facture'>");
    $formulaireFacture->ajouterComposantLigne("<th>Commande</th><th>Semaine</th><th>Date</th><th>Etat</th>");


    //Recupere les Factures de la BDD//

    foreach ($_SESSION['listeFactures']->getFactures() as $uneFacture)
    {
        $formulaireFacture->ajouterComposantLigne("<tr>");
        $formulaireFacture->ajouterComposantLigne("<td>");
        $formulaireFacture->ajouterComposantLigne($uneFacture->getNum_com());
        $formulaireFacture->ajouterComposantLigne("</td>");
        $formulaireFacture->ajouterComposantLigne("<td>");
        $formulaireFacture->ajouterComposantLigne($uneFacture->getNum_semaine());
        $formulaireFacture->ajouterComposantLigne("</td>");
        $formulaireFacture->ajouterComposantLigne("<td>");
        $formulaireFacture->ajouterComposantLigne($uneFacture->getDate_());
        $formulaireFacture->ajouterComposantLigne("</td>");
        $formulaireFacture->ajouterComposantLigne("<td>");
        $formulaireFacture->ajouterComposantLigne($uneFacture->getEtat());
        $formulaireFacture->ajouterComposantLigne("</td>");
        $formulaireFacture->ajouterComposantLigne("<td>");
        $formulaireFacture->ajouterComposantLigne($formulaireFacture->creerInputRadio("choix", 1, $uneFacture->getNum_com(), "",""));
        $formulaireFacture->ajouterComposantLigne("</td>");
    }

    $formulaireFacture->ajouterComposantLigne("</table>");
    $formulaireFacture->ajouterComposantTab();

    /////////////////////////////////////////////Les differents boutons////////////////////////////////////////////////////////

    $formulaireFacture->ajouterComposantLigne($formulaireFacture-> creerInputSubmit('Supprimer', 'Supprimer', 'Supprimer'));

    $formulaireFacture->ajouterComposantLigne($formulaireFacture-> creerInputSubmit('Valide', 'Valide', 'Validé'));

    $formulaireFacture->ajouterComposantLigne($formulaireFacture-> creerInputSubmit('Voir', 'Voir', 'Voir'));
    $formulaireFacture->ajouterComposantTab();

    $formulaireFacture->ajouterComposantLigne($formulaireFacture->creerMessage($messageErreurSuppression.$messageErreurValide));
    $formulaireFacture->ajouterComposantTab();
}

$formulaireFacture->creerFormulaire();

///////////////////////////////////////////////FIN FORMULAURE////////////////////////////////////////////////////////////////////////////

require_once 'vue/adherents/vueFactures.php' ;
?>