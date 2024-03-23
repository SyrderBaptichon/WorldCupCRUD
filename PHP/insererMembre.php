<?php
include "phpHtmlLib.php";
include "phpFormLib.php";

$page_HTML = getDebutHTML("Insertion d'équipe");
$page_HTML .= intoBalise("h2", "Insérer un membre");

$form = intoBalise("h3", "formulaire d'insertion d'un membre");

$form .= '
<form action="traitementInsererMembre.php" method="post">
    <p><b>Nom : </b>
    <input type="text" name="membre_nom"  size="10" /></p>
    <p><b>Prénom : </b>
    <input type="text" name="membre_prenom"  size="10" /></p>
    <p><b>Statut : </b> 
    Sélectionneur <input type="radio" name="membre_statut" 
                    value="Selectionneur"  />
    Joueur <input type="radio" name="membre_statut"     
                  value="Joueur" /></p>

    <p><b>Poste : </b>
    <select size="3" name="membre_poste">
        <option value="Gardien" > Gardien </option>
        <option value="Defenseur" > Défenseur</option>
        <option value="Milieu"> Milieu</option>
        <option value="Attaquant"> Attaquant</option>
    </select></p>
    <p><b>Numéro : </b>
    <input type="number" name="membre_num"  size="1" /></p>
    <p><b>Identifiant d\'équipe : </b>
    <input type="number" name="equipe_id"  size="1" /></p>
    <p><input type="submit" name="enregistrement" value="Envoyer" />
    <input type="reset" name="annuler" value="Effacer" /> </p>

    </form>
';

$page_HTML .= $form
    . intoBalise("a", "Retour à l'acceuil", array('href' => 'index.php', 'class' => 'btn btn-primary'))
    . getFinHTML();
echo $page_HTML;
?>