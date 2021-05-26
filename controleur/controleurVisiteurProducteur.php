<?php

//Instancier un objet contenant la liste des producteurs et le conserver dans une variable de session//

$_SESSION['listeProducteurs'] = new Producteurs(ProducteurDAO::lesProducteurs());
 
/////////////////////////////////////////////////DEBUT FORMULAIRE///////////////////////////////////////////////////////////////////////

$formulaireProducteur = new Formulaire('post', 'index.php', 'fProducteur', 'fProducteur');

$formulaireProducteur->ajouterComposantLigne($formulaireProducteur->creerLabel("<H1> Toutes les Producteurs </H1>"));
$formulaireProducteur->ajouterComposantLigne("<tr>");
$formulaireProducteur->ajouterComposantLigne("<table class='Facture'>");
$formulaireProducteur->ajouterComposantLigne("<th>Nom</th><th>Prenom</th><th>Descriptif</th><th>Commune</th><th>code Postal</th><th>Adresse</th>");


//Recupere les Producteurs de la BDD//

foreach ($_SESSION['listeProducteurs']->getProducteurs() as $unProducteur)
{
    $formulaireProducteur->ajouterComposantLigne("<tr>");
    $formulaireProducteur->ajouterComposantLigne("<td>");
    $formulaireProducteur->ajouterComposantLigne($unProducteur->getNom_adh());
    $formulaireProducteur->ajouterComposantLigne("</td>");
    $formulaireProducteur->ajouterComposantLigne("<td>");
    $formulaireProducteur->ajouterComposantLigne($unProducteur->getPrenom_adh());
    $formulaireProducteur->ajouterComposantLigne("</td>");
    $formulaireProducteur->ajouterComposantLigne("<td>");
    $formulaireProducteur->ajouterComposantLigne($unProducteur->getDescriptif());
    $formulaireProducteur->ajouterComposantLigne("</td>");
    $formulaireProducteur->ajouterComposantLigne("<td>");
    $formulaireProducteur->ajouterComposantLigne($unProducteur->getCommune());
    $formulaireProducteur->ajouterComposantLigne("</td>");
    $formulaireProducteur->ajouterComposantLigne("<td>");
    $formulaireProducteur->ajouterComposantLigne($unProducteur->getCodepostal());
    $formulaireProducteur->ajouterComposantLigne("</td>");
    $formulaireProducteur->ajouterComposantLigne("<td>");
    $formulaireProducteur->ajouterComposantLigne($unProducteur->getAdresse());
    $formulaireProducteur->ajouterComposantLigne("</td>");
}

$formulaireProducteur->ajouterComposantLigne("</table>");
$formulaireProducteur->ajouterComposantTab();

$formulaireProducteur->creerFormulaire();

///////////////////////////////////////////////FIN FORMULAURE////////////////////////////////////////////////////////////////////////////

require_once 'vue/visiteurs/vueVisiteurProducteurs.php' ;
?>