<?php

//Variables//

$messageErreurRecherche="Vous n'avez pas de commande a ce numéro!";

if(isset($_GET['numCom']))
{
	$_SESSION['numCom']= $_GET['numCom'];
}
else
{
    if(!isset($_SESSION['numCom']))
    {
		$_SESSION['numCom']="";
	}
}

if(isset($_POST['cherche']))
{
    $_SESSION['numCom']= $_POST['Com'];
}
else
{
    $_POST['Com']=$_SESSION['numCom'];
}

//////////////////////////////////////////////BOUTON SAUVEGARDER/////////////////////////////////////////////////////

if (isset($_POST['SavePanier']))
{
    $_SESSION['Panier']= new Paniers(PanierDAO::lesElements($_POST['Com']));

    for($t=0;$t<sizeof($_SESSION['Panier']->getPaniers());$t++) //Parcours toutes les liste déroulantes//
    {

        var_dump($_POST['liste'.$t]);

        if ($_POST['liste'.$t]!="0") //Si il a choisi au moins 1 element du produit//
        {
            $unElement=$_SESSION['Panier']->getPaniers()[$t];
            PanierDAO::MAJ($unElement->getId_Pro(),($_POST["liste".$t]),$_SESSION['identification'],$unElement->getProducteur());
        }
    }
   // die();
    header('location: index.php');
}

//////////////////////////////////////////////BOUTON SAUVEGARDER/////////////////////////////////////////////////////

//Si il veut rajouter des elements au panier//

if (isset($_POST['AjouterPanier']))
{       
    $_SESSION["listeClear"]=new Proposers([]);
    
    foreach ($_SESSION['listeProduitsProposer']->getProposer() as $unElement) //Parcours tous les elements des produits de la semaine//
    {
        $bool=False;
       
        foreach ( $_SESSION['Panier']->getPaniers() as $unPanier)//Parcours tous les elements du panier//
        {
            if ($unPanier->getId_PRO() == $unElement->getId_PRO() && $unPanier->getProducteur() == $unElement->getCode_adh()) //Si un element du panier est contenue dans la liste des produits de la semaine//
            {
                $bool=true;
            }                           
        }

        if($bool==false)
        {
            $_SESSION["listeClear"]->AjouterProduit($unElement);
        }
    }

    $_SESSION["numCom2"]=$_POST["Com"];
    $_SESSION['MP']="AdherentsAchats";
    header('location: index.php');
}
else
{
    if(isset($_SESSION["listeClear"]))
    {
        unset($_SESSION["listeClear"]);
    }
}

//////////////////////////////////////////////////////////// BOUTON SUPPRIMER /////////////////////////////////////////////////////////

if(isset($_POST['SupprimerPanier']))
{
    PanierDAO::Supprimer($_POST['Com'],$_SESSION['identification'],$_POST["SupprimerPanier"],PanierDAO::lireProducteurPanier($_POST['Com'],$_SESSION['identification'],$_POST["SupprimerPanier"]));

    if (empty(PanierDAO::lireTout($_POST['Com'])))
    {
        FactureDAO::supprimer($_POST['Com']);
    }
}

//////////////////////////////////////////////////////////// BOUTON SUPPRIMER /////////////////////////////////////////////////////////

//////////////////////////////////////////////////////Debut du formulaire///////////////////////////////////////////////////////////////

$formulairePanier = new Formulaire('post', 'index.php', 'fPanier', 'fPanier');

$formulairePanier->ajouterComposantLigne($formulairePanier->creerLabel("<H1> Contenue des vos commandes </H1>"));
$formulairePanier->ajouterComposantLigne($formulairePanier->creerLabel('Tapez le numéro de votre commande'));
$formulairePanier->ajouterComposantLigne("</br>");	
$formulairePanier->ajouterComposantLigne($formulairePanier->creerInputTexte('Com', 'Com', $_SESSION['numCom'], 0, "", ''));
$formulairePanier->ajouterComposantTab();

//Bouton//
    
$formulairePanier->ajouterComposantLigne($formulairePanier-> creerInputSubmit('cherche', 'cherche', 'Chercher'));
$formulairePanier->ajouterComposantTab();
    
////////////////////Si il appuie sur le bouton recherche ou si il vient du controleur facture en ayant appuyé sur voir///////////////////////////

if (isset($_POST['cherche'])|| isset($_SESSION['numCom']))
{


    //Verifie l'appartance de la facture//

    if(FactureDAO::lireAppartenance($_POST['Com'])==$_SESSION['identification'])
    {
        if(FactureDAO::lire($_POST['Com'])=="En attente") //Pour modifier //
        {

            $_SESSION['Panier']= new Paniers(PanierDAO::lesElements($_POST['Com']));
            $formulairePanier->ajouterComposantLigne("<table class='Facture'>");
            $formulairePanier->ajouterComposantLigne("<th>Produit</th><th>Numero</th><th>nom</th><th>Quantitée</th><th>Motant</th><th>Producteur</th>");

            $i=0;
        
            foreach ($_SESSION['Panier']->getPaniers() as $unElement)
            {
                $formulairePanier->ajouterComposantLigne("<tr>");
                $formulairePanier->ajouterComposantLigne("<td>");    
                $formulairePanier->ajouterComposantLigne($formulairePanier->creerInputImage("produit","images/".ProduitDAO::getNomProduit($unElement->getId_PRO()).".jpg" , "produit"));
                $formulairePanier->ajouterComposantLigne("</td>");
                $formulairePanier->ajouterComposantLigne("<td>");
                $formulairePanier->ajouterComposantLigne($unElement->getNum_commande());
                $formulairePanier->ajouterComposantLigne("</td>");
                $formulairePanier->ajouterComposantLigne("<td>");
                $formulairePanier->ajouterComposantLigne(ProduitDAO::getNomProduit($unElement->getId_PRO()));
                $formulairePanier->ajouterComposantLigne("</td>");
                $formulairePanier->ajouterComposantLigne("<td>");
                $formulairePanier->ajouterComposantLigne($formulairePanier->creeListeDeroulante(ProposerDAO::getNombre($unElement->getId_PRO(),FactureDAO::lireSemaine($unElement->getNum_commande()),$unElement->getProducteur())+1,"liste".$i,$unElement->getQtte()));
                $formulairePanier->ajouterComposantLigne("</td>");
                $formulairePanier->ajouterComposantLigne("<td>");
                $formulairePanier->ajouterComposantLigne($unElement->getQtte()*ProposerDAO::getPrixProduit($unElement->getId_PRO(),FactureDAO::lireSemaine($unElement->getNum_commande()),$unElement->getProducteur()));
                $formulairePanier->ajouterComposantLigne("</td>");
                $formulairePanier->ajouterComposantLigne("<td>");
                $formulairePanier->ajouterComposantLigne(ProducteurDAO::getNomProducteur($unElement->getProducteur()));
                $formulairePanier->ajouterComposantLigne("</td>");
                $formulairePanier->ajouterComposantLigne("<td>");         
                $formulairePanier->ajouterComposantLigne($formulairePanier->creerInputSubmit('SupprimerPanier','X',$unElement->getId_PRO()));          
                $formulairePanier->ajouterComposantLigne("</td>");
                $formulairePanier->ajouterComposantTab();
                $i++;
            }
            $formulairePanier->ajouterComposantLigne("</table>");
            $formulairePanier->ajouterComposantTab();

            $formulairePanier->ajouterComposantLigne($formulairePanier-> creerInputSubmit('AjouterPanier', 'AjouterPANIER', 'AJOUTER'));
            $formulairePanier->ajouterComposantLigne($formulairePanier-> creerInputSubmit('SavePanier', 'SavePANIER', 'SAUVEGARDER'));
            $formulairePanier->ajouterComposantTab();
        }
        else //Si deja validé//
        {
            $_SESSION['Panier']= new Paniers(PanierDAO::lesElements($_POST['Com']));
            $formulairePanier->ajouterComposantLigne("<table class='Facture'>");
            $formulairePanier->ajouterComposantLigne("<th>Produit</th><th>Numero</th><th>nom</th><th>Quantitée</th><th>Motant</th><th>Producteur</th>");
        
            foreach ($_SESSION['Panier']->getPaniers() as $unElement)
            {
                $formulairePanier->ajouterComposantLigne("<tr>");
                $formulairePanier->ajouterComposantLigne("<td>");    
                $formulairePanier->ajouterComposantLigne($formulairePanier->creerInputImage("produit","images/".ProduitDAO::getNomProduit($unElement->getId_PRO()).".jpg" , "produit"));
                $formulairePanier->ajouterComposantLigne("</td>");
                $formulairePanier->ajouterComposantLigne("<td>");
                $formulairePanier->ajouterComposantLigne($unElement->getNum_commande());
                $formulairePanier->ajouterComposantLigne("</td>");
                $formulairePanier->ajouterComposantLigne("<td>");
                $formulairePanier->ajouterComposantLigne(ProduitDAO::getNomProduit($unElement->getId_PRO()));
                $formulairePanier->ajouterComposantLigne("</td>");
                $formulairePanier->ajouterComposantLigne("<td>");
                $formulairePanier->ajouterComposantLigne($unElement->getQtte());
                $formulairePanier->ajouterComposantLigne("</td>");
                $formulairePanier->ajouterComposantLigne("<td>");
                $formulairePanier->ajouterComposantLigne($unElement->getQtte()*ProposerDAO::getPrixProduit($unElement->getId_PRO(),FactureDAO::lireSemaine($unElement->getNum_commande()),$unElement->getProducteur()));
                $formulairePanier->ajouterComposantLigne("</td>");
                $formulairePanier->ajouterComposantLigne("<td>");
                $formulairePanier->ajouterComposantLigne(ProducteurDAO::getNomProducteur($unElement->getProducteur()));
                $formulairePanier->ajouterComposantLigne("</td>");
            }
            $formulairePanier->ajouterComposantLigne("</table>");
            $formulairePanier->ajouterComposantTab();
    
        }  
    }
    else
    {
        $formulairePanier->ajouterComposantLigne($formulairePanier->creerMessage($messageErreurRecherche));
        $formulairePanier->ajouterComposantTab();
    }
}

$formulairePanier->creerFormulaire();

require_once 'vue/adherents/vueAdherentsPanier.php' ;
?>