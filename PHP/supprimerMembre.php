<?php
include "phpHtmlLib.php";
include "phpFormLib.php";
include "phpBDLib.php";

$membre_id = $_GET['membre_id'];

deleteMembre($membre_id);
header("Location: membre.php");
?>