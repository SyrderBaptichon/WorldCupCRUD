<?php
include "phpHtmlLib.php";
include "phpFormLib.php";
include "phpBDLib.php";

$page_HTML = getDebutHTML("Équipe")
              .barreDeNavigation(); 

// Connexion à la base de données
$ptrDB = connexion();

$requete = "SELECT * FROM P11_Equipe";
$ptrQuery = pg_query($ptrDB, $requete);
if ($ptrQuery) {
  $page_HTML .= "<h1>TABLE ÉQUIPE </h1>
                <table>
                    <tr id=\"header\">";
  $tabEquipe = pg_meta_data($ptrDB, 'p11_equipe', false);
  $colnames = array_keys($tabEquipe);
  array_push($colnames, "Modification", "Supression");
  foreach ($colnames as $col) {
    $page_HTML .= "<th>$col</th>\n";
  }
  $page_HTML .= " </tr>\n";
  while ($ligne = pg_fetch_row($ptrQuery)) { //lit une ligne
    $page_HTML .= "<tr>";
    for ($j = 0; $j < count($ligne); $j++) { //parcours le tableau
      $page_HTML .= "<td>" . $ligne[$j] . " </td>\n";
    }
    $id = $ligne[0];
    $page_HTML .= "<td><a href='updateEquipe.php?equipe_id=$id'>Modifier</a></td>\n
                  <td><a href='supprimerEquipe.php?equipe_id=$id'>Supprimer</a></td>\n
                      </tr>\n";
  }
  $page_HTML .= " </table>";
  pg_free_result($ptrQuery);
}
pg_close($ptrDB);

$page_HTML .= intoBalise("a", "Insertion", array('href' => 'insererEquipe.php', 'class' => 'btn btn-primary'))
  . intoBalise("a", "Retour à l'acceuil", array('href' => 'index.php', 'class' => 'btn btn-primary'))
  . getFinHTML();

echo $page_HTML;
?>