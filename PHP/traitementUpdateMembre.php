<?php
include "phpHtmlLib.php";
include "phpFormLib.php";
include "phpBDLib.php";

if (valideForm($_POST, ['membre_nom', 'membre_prenom', 'membre_statut', 'equipe_id'])) {
  $membre_id = $_POST['membre_id'];
  $membre_nom = $_POST['membre_nom'];
  $membre_prenom = $_POST['membre_prenom'];
  $membre_statut = $_POST['membre_statut'];
  $membre_poste = $_POST['membre_poste'];
  $membre_num = $_POST['membre_num'];
  $equipe_id = $_POST['equipe_id'];

  updateMembre(array($membre_id, $membre_nom, $membre_prenom, $membre_statut, $membre_poste, $membre_num, $equipe_id));
  header("Location: membre.php");
}
?>