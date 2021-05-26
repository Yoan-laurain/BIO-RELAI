<?php

//Recupere la semaine actuelle//

$semaine=date('W');
$jour=date('N');
$messageCommande="";
$messageVide="";

/////////////////////////////////////////////////DEBUT FORMULAIRE///////////////////////////////////////////////////////////////////////

$formulaireProduitProposer = new Formulaire('post', 'index.php', 'fProduitProposer', 'fProduitProposer');

if ($jour!=3 && $jour!=4)   //Verifie le jour de la semaine//
{
    //Recupere la liste des produits proposer de la semaine actuelle//

    $_SESSION['listeProduitsProposer'] = new Proposers(ProposerDAO::lesProduitsProposer($semaine));

    /////////////////////////////////Si il n'y a pas de produits proposer cette semaine//////////////////////////////////////////////////////

    if ($_SESSION['listeProduitsProposer']=="") 
    {
        $formulaireProduitProposer->ajouterComposantLigne($formulaireProduitProposer->creerLabel('Il ny a pas de produits!'));	
        $formulaireProduitProposer->ajouterComposantTab();
    }

    //////////////////////////////////////Recupere les ProduitProposers de la BDD//////////////////////////////////////////////////////////

    $i=0;

    if (isset($_SESSION['listeClear']))
    {   
        if(!empty($_SESSION["listeClear"]->getProposer()))
        {
            
            $formulaireProduitProposer->ajouterComposantLigne("<table class='Facture'>");
            $formulaireProduitProposer->ajouterComposantLigne("<th>Produit</th><th>Nom</th><th>Quantitée</th><th>Prix</th><th>unité</th><th>Producteur</th><th>Acheter</th>");

            foreach ($_SESSION['listeClear']->getProposer() as $unProduitProposer)
            {
                $formulaireProduitProposer->ajouterComposantLigne("<tr>");
                $formulaireProduitProposer->ajouterComposantLigne("<td>");    
                $formulaireProduitProposer->ajouterComposantLigne($formulaireProduitProposer->creerInputImage("produit","images/".ProduitDAO::getNomProduit($unProduitProposer->getId_PRO()).".jpg" , "produit"));
                $formulaireProduitProposer->ajouterComposantLigne("</td>");
                $formulaireProduitProposer->ajouterComposantLigne("<td>");
                $formulaireProduitProposer->ajouterComposantLigne(ProduitDAO::getNomProduit($unProduitProposer->getId_PRO()));
                $formulaireProduitProposer->ajouterComposantLigne("</td>");
                $formulaireProduitProposer->ajouterComposantLigne("<td>");
                $formulaireProduitProposer->ajouterComposantLigne($unProduitProposer->getQtte());
                $formulaireProduitProposer->ajouterComposantLigne("</td>");
                $formulaireProduitProposer->ajouterComposantLigne("<td>");
                $formulaireProduitProposer->ajouterComposantLigne($unProduitProposer->getPrix());
                $formulaireProduitProposer->ajouterComposantLigne("</td>");
                $formulaireProduitProposer->ajouterComposantLigne("<td>");
                $formulaireProduitProposer->ajouterComposantLigne($unProduitProposer->getUnite());
                $formulaireProduitProposer->ajouterComposantLigne("</td>");
                $formulaireProduitProposer->ajouterComposantLigne("<td>");
                $formulaireProduitProposer->ajouterComposantLigne(ProducteurDAO::getNomProducteur($unProduitProposer->getCode_adh()));
                $formulaireProduitProposer->ajouterComposantLigne("</td>");
                $formulaireProduitProposer->ajouterComposantLigne("<td>");
                $formulaireProduitProposer->ajouterComposantLigne($formulaireProduitProposer->creeListeDeroulante($unProduitProposer->getQtte()+1,"liste".$i,0));
                $formulaireProduitProposer->ajouterComposantLigne("</td>");
                $i++;
            }
        }
        else
        {
            $messageVide="Votre commande possede tous les produits de la semaine!";    
        }
    }
    else
    {
        
        $formulaireProduitProposer->ajouterComposantLigne("<table class='Facture'>");
        $formulaireProduitProposer->ajouterComposantLigne("<th>Produit</th><th>Nom</th><th>Quantitée</th><th>Prix</th><th>unité</th><th>Producteur</th><th>Acheter</th>");

        foreach ($_SESSION['listeProduitsProposer']->getProposer() as $unProduitProposer)
        {
            $formulaireProduitProposer->ajouterComposantLigne("<tr>");
            $formulaireProduitProposer->ajouterComposantLigne("<td>");    
            $formulaireProduitProposer->ajouterComposantLigne($formulaireProduitProposer->creerInputImage("produit","images/".ProduitDAO::getNomProduit($unProduitProposer->getId_PRO()).".jpg" , "produit"));
            $formulaireProduitProposer->ajouterComposantLigne("</td>");
            $formulaireProduitProposer->ajouterComposantLigne("<td>");
            $formulaireProduitProposer->ajouterComposantLigne(ProduitDAO::getNomProduit($unProduitProposer->getId_PRO()));
            $formulaireProduitProposer->ajouterComposantLigne("</td>");
            $formulaireProduitProposer->ajouterComposantLigne("<td>");
            $formulaireProduitProposer->ajouterComposantLigne($unProduitProposer->getQtte());
            $formulaireProduitProposer->ajouterComposantLigne("</td>");
            $formulaireProduitProposer->ajouterComposantLigne("<td>");
            $formulaireProduitProposer->ajouterComposantLigne($unProduitProposer->getPrix());
            $formulaireProduitProposer->ajouterComposantLigne("</td>");
            $formulaireProduitProposer->ajouterComposantLigne("<td>");
            $formulaireProduitProposer->ajouterComposantLigne($unProduitProposer->getUnite());
            $formulaireProduitProposer->ajouterComposantLigne("</td>");
            $formulaireProduitProposer->ajouterComposantLigne("<td>");
            $formulaireProduitProposer->ajouterComposantLigne(ProducteurDAO::getNomProducteur($unProduitProposer->getCode_adh()));
            $formulaireProduitProposer->ajouterComposantLigne("</td>");
            $formulaireProduitProposer->ajouterComposantLigne("<td>");
            $formulaireProduitProposer->ajouterComposantLigne($formulaireProduitProposer->creeListeDeroulante($unProduitProposer->getQtte()+1,"liste".$i,0));
            $formulaireProduitProposer->ajouterComposantLigne("</td>");
            $i++;
        }
    }

    $formulaireProduitProposer->ajouterComposantLigne("</table>");
    $formulaireProduitProposer->ajouterComposantTab();

    //////////////////////////////////////////////////////Bouton Passer commande//////////////////////////////////////////////////////////////
    if($messageVide=="")
    {
        $formulaireProduitProposer->ajouterComposantLigne($formulaireProduitProposer-> creerInputSubmit('Achat', 'Achat', ''));
        $formulaireProduitProposer->ajouterComposantTab();
    }
    //////////////////////////////////////////////////////Bouton Passer commande//////////////////////////////////////////////////////////////
}
else
{
    $formulaireProduitProposer->ajouterComposantLigne($formulaireProduitProposer->creerLabel('Vous ne pouvez acheter que du vendredi au mardi!'));
    $formulaireProduitProposer->ajouterComposantTab();	
}


$formulaireProduitProposer->ajouterComposantLigne($formulaireProduitProposer->creerMessage($messageCommande));
$formulaireProduitProposer->ajouterComposantLigne($formulaireProduitProposer->creerMessage($messageVide));
$formulaireProduitProposer->ajouterComposantTab();	

$formulaireProduitProposer->creerFormulaire();

///////////////////////////////////////////////FIN FORMULAURE////////////////////////////////////////////////////////////////////////////


if (isset($_POST['Achat'])) //Si il veut ajouter au panier//
{
    if (isset($_SESSION["listeClear"]))  //Si il rajoute au panier//
    {
        for($t=0;$t<$i;$t++) //Parcours toutes les liste déroulantes//
        {
            if ($_POST['liste'.$t]!=0) //Si il a choisi au moins 1 element du produit//
            {
                $produit=$_SESSION['listeClear']->getProposer()[$t];
                PanierDAO::ajouter($_SESSION["numCom2"],$_SESSION['identification'],$produit->getPrix()*($_POST['liste'.$t]),$produit->getId_PRO(),($_POST['liste'.$t]),$produit->getCode_adh());  
            }
        }
        $messageCommande="Effectué il ne reste plus que à valider votre commande dans lespace facture";
        header('location: index.php');
        
        $i=0;
    }
    else //Si c'est une nouvelle commande//
    {
        FactureDAO::ajouter($semaine,$date,$_SESSION['identification'],"En attente"); //Ajoute la facture//

        for($t=0;$t<$i;$t++) //Parcours toutes les liste déroulantes//
        {
            if ($_POST['liste'.$t]!=0) //Si il a choisi au moins 1 element du produit//
            {
                $produit=$_SESSION['listeProduitsProposer']->getProposer()[$t];
                PanierDAO::ajouter(FactureDAO::MAX(),$_SESSION['identification'],$produit->getPrix()*($_POST['liste'.$t]),$produit->getId_PRO(),($_POST['liste'.$t]),$produit->getCode_adh());  
            }
        }
        $messageCommande="Effectué il ne reste plus que à valider votre commande dans lespace facture";
        header('location: index.php');
    
        $i=0;
    }

    $_SESSION['MP']="AdherentsFactures";
}

require_once 'vue/adherents/vueAdherentsAchats.php' ;
?>