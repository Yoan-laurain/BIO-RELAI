<?php

//Variables//

$semaine=date('W');
$jour=date('N');

/////////////////////////////////////////////////DEBUT FORMULAIRE///////////////////////////////////////////////////////////////////////

$formulaireProduitProposer = new Formulaire('post', 'index.php', 'fProduitProposer', 'fProduitProposer');

if ($jour!=3 && $jour!=4)   //Verifie le jour de la semaine//
{

    //Recupere tout les produit proposer cette semaine//

    $_SESSION['listeProduitsProposer'] = new Proposers(ProposerDAO::lesProduitsProposer($semaine));
    
    $formulaireProduitProposer->ajouterComposantLigne($formulaireProduitProposer->creerLabel("<H1> Produits de la semaine</H1>"));
    $formulaireProduitProposer->ajouterComposantLigne("<tr>");
    $formulaireProduitProposer->ajouterComposantLigne("<table class='Facture'>");
    $formulaireProduitProposer->ajouterComposantLigne("<th>Produit</th><th>Nom</th><th>Quantitée</th><th>Prix</th><th>unité</th><th>Producteur</th>");

    if ($_SESSION['listeProduitsProposer']=="")
    {
        $formulaireProduitProposer->ajouterComposantLigne($formulaireProduitProposer->creerLabel('Il ny a pas de produits!'));	
    }

    //Recupere les Produit Proposers de la BDD//

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
    }

    $formulaireProduitProposer->ajouterComposantLigne("</table>");
    $formulaireProduitProposer->ajouterComposantTab();
}
else
{
    $formulaireProduitProposer->ajouterComposantLigne($formulaireProduitProposer->creerLabel('Il ny a des produits que du vendredi au mardi!'));
    $formulaireProduitProposer->ajouterComposantTab();	
}

$formulaireProduitProposer->creerFormulaire();

///////////////////////////////////////////////FIN FORMULAURE////////////////////////////////////////////////////////////////////////////

require_once 'vue/adherents/vueAdherentsAchats.php' ;
?>