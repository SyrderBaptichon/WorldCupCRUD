<?php
include "phpHtmlLib.php";
include "phpFormLib.php";
include "phpBDLib.php";

if (valideForm($_POST, ['equipe_nom', 'equipe_fed', 'equipe_cont'])) {
  $equipe_id = $_POST['equipe_id'];
  $equipe_nom = $_POST['equipe_nom'];
  $equipe_fed = $_POST['equipe_fed'];
  $equipe_cont = $_POST['equipe_cont'];

  updateEquipe(array($equipe_id, $equipe_nom, $equipe_fed, $equipe_cont));
  header("Location: equipe.php");
}
?>