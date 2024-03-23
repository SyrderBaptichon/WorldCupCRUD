<?php
include "phpHtmlLib.php";
include "phpFormLib.php";
include "phpBDLib.php";

// Connexion à la base de données
$ptrDB = connexion();

if (!$ptrDB) {
  echo ("Problème de connection");
} else {
  if (valideForm($_POST, ['equipe_nom', 'equipe_fed', 'equipe_cont'])) {
    $requete = "INSERT INTO P11_Equipe (equipe_nom, equipe_fed, equipe_cont) VALUES ($1, $2, $3)";
    pg_prepare($ptrDB, "reqPrep", $requete);
    $equipe_nom = htmlspecialchars($_POST['equipe_nom']);
    $equipe_fed = htmlspecialchars($_POST['equipe_fed']);
    $equipe_cont = htmlspecialchars($_POST['equipe_cont']);
    $requeteExe = pg_execute($ptrDB, "reqPrep", array(
      $equipe_nom,
      $equipe_fed,
      $equipe_cont)
    );
    header("Location: equipe.php");
  }
}
?>