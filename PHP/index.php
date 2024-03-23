<?php
include "phpHtmlLib.php";

// Génération de la page d'acceuil
$page_HTML = getDebutHTML("Page d'acceuil")
              .barreDeNavigation()
              .contenuAcceuil()
              .getFinHTML();

echo $page_HTML;
?>