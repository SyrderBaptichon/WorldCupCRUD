<?php
include "phpHtmlLib.php";
include "phpFormLib.php";
include "phpBDLib.php";

$id = $_GET['equipe_id'];


deleteEquipe($id);
header("Location: equipe.php");
?>