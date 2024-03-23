<?php
include "phpHtmlLib.php";
include "phpFormLib.php";
include "phpBDLib.php";

$page_HTML = getDebutHTML("Membre")
.barreDeNavigation();

// Connexion à la base de données
$ptrDB = connexion();

$requete = "SELECT * FROM P11_Membre";
$ptrQuery = pg_query($ptrDB, $requete);
if ($ptrQuery) {
  $page_HTML .= "<h1>TABLE MEMBRE </h1>";
  $page_HTML .= "<table>
                  <tr id=\"header\">";
  $tabMembre = pg_meta_data($ptrDB, 'p11_membre', false);
  $colnames = array_keys($tabMembre);
  array_push($colnames, "Modification", "Supression");
  foreach ($colnames as $col) {
    $page_HTML .= "<th>$col</th>";
  }
  $page_HTML .= "</tr>\n";
  while ($ligne = pg_fetch_row($ptrQuery)) { //lit une ligne
    $page_HTML .= "<tr>";
    for ($j = 0; $j < count($ligne); $j++) { //parcours le tableau
      $page_HTML .= "<td>" . $ligne[$j] . " </td>";
    }
    $membre_id = $ligne[0];
    $page_HTML .= "<td><a href='updateMembre.php?membre_id=$membre_id'>Modifier</a></td>\n
    <td><a href='supprimerMembre.php?membre_id=$membre_id'>Supprimer</a></td>\n
        </tr>\n";
  }
  $page_HTML .= "</table>";
  pg_free_result($ptrQuery);
}
pg_close($ptrDB);


$page_HTML .= intoBalise("a", "Insertion", array('href' => 'insererMembre.php', 'class' => 'btn btn-primary'))
  . intoBalise("a", "Retour à l'acceuil", array('href' => 'index.php', 'class' => 'btn btn-primary'))
  . getFinHTML();

echo $page_HTML;
?>