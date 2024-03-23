<?php
function getDebutHTML(string $title) : string {
    return "<!DOCTYPE html>
    <html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' type='text/css' href='../CSS/style.css'>
        <title>$title</title>
    </head>
    <body>";
}

function barreDeNavigation(): string {
    return "<div id='menu'>
         <div id='siteName'>
             <h1>Projet <span class='primary-color'>PHP-BD</span></h1>
         </div>
         <div id='navbar'>
             <ul>
                 <li><a href='index.php' name='hautPage'>Acceuil</a></li>
                 <li><a href='equipe.php'>Équipe</a></li>
                 <li><a href='membre.php'>Membre</a></li>
             </ul>
         </div>
     </div>
     <div class='container'>";
 }

function contenuAcceuil(): string {
    return "
    <div id='contenu'>
    </div>";
}

// fin d'un document HTML
function getFinHTML(): string {
    return "</div>
            <div id=\"auteurs\">
                <p>
                    <ul>
                        <li>BAPTICHON Syrder</li>
                        <li>BEAUDOUIN Mathéo</li>
                        <li>CHEIKH Amine</li>
                </p>
            </div></body></html>";
}

function intoBalise(string $nomElement, string $contenuElement,
                    array $params = null): string {
    $resu = "<$nomElement "; // amorce la construction de la balise ouvrante
    if (isset($params)) { // traite le 3e parametre s'il existe
        foreach ($params as $attribut => $valeur)
            $resu .= $attribut."='$valeur'"; // construit les attributs de la balise HTML
    }
    if ($contenuElement==="")
        $resu .=" />"; // ferme la balise s'il s'agit d'un élément vide
    else
        $resu .= ">$contenuElement</$nomElement>"; // termine la balise ouvrante, intègre le contenu et ferme la balise
    return $resu; // retourne la chaine de caractères construite
}
?>