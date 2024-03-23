<?php
include "phpHtmlLib.php";
include "phpFormLib.php";
include "phpBDLib.php";

// Connexion à la base de données
$ptrDB = connexion();

if (!$ptrDB) {
  echo ("Problème de connection");
} else {
  if (valideForm($_POST, ['membre_nom', 'membre_prenom', 'membre_statut', 'equipe_id'])) {
    $requete = "INSERT INTO P11_Membre (membre_nom, membre_prenom, membre_statut, membre_poste, membre_num, equipe_id) VALUES ($1, $2, $3, $4, $5, $6)";
    pg_prepare($ptrDB, "reqInsertMembre", $requete);
    $membre_nom = htmlspecialchars($_POST['membre_nom']);
    $membre_prenom = htmlspecialchars($_POST['membre_prenom']);
    $membre_statut = $_POST['membre_statut'];
    $membre_poste = $_POST['membre_poste'];
    $membre_num = $_POST['membre_num'];
    $equipe_id = $_POST['equipe_id'];
    if ($membre_statut == 'Joueur') {
      $requeteExe = pg_execute(
        $ptrDB,
        "reqInsertMembre",
        array(
          $membre_nom,
          $membre_prenom,
          $membre_statut,
          $membre_poste,
          $membre_num,
          $equipe_id
        )
      );
    } else {
      $requeteExe = pg_execute(
        $ptrDB,
        "reqInsertMembre",
        array(
          $membre_nom,
          $membre_prenom,
          $membre_statut,
          NULL,
          NULL,
          $equipe_id
        )
      );
    }
    header("Location: membre.php");
  }
}
?>