<?php
include "phpHtmlLib.php";
include "phpFormLib.php";

$page_HTML = getDebutHTML("Modification d'équipe");
$page_HTML .= intoBalise("h2", "Modifier l'équipe");
$id = $_GET['equipe_id'];


$form = intoBalise("h3", "formulaire de modification d'une équipe")
      ."<form action='traitementUpdateEquipe.php' method='post'>
        <input type='hidden' name='equipe_id' value='$id' />
        <p><b>Nom : </b>
          <input type='text' name='equipe_nom'  size='10' /></p>

          <p><b>Fédération : </b>
            <input type='text' name='equipe_fed' size='10' /></p>

            <p> <b>Continent </b> : 
            Europe <input type='radio' name='equipe_cont' value='Europe' /> 
            Asie <input type='radio' name='equipe_cont' value='Asie' />  
            Afrique <input type='radio' name='equipe_cont' value='Afrique' /> 
            Amerique du Sud <input type='radio' name='equipe_cont' value='Amerique du Sud' /> 
            Amerique du Nord <input type='radio' name='equipe_cont' value='Amerique du Nord' /> 
            Antarctique <input type='radio' name='equipe_cont' value='Antarctique' /> 
            Océanie <input type='radio' name='equipe_cont' value='Océanie' /> 
            </p>
              <p><input type='submit' name='enregistrement' value='Envoyer' />

              <input type='reset' name='annuler' value='Effacer' /> </p>

          </form>";

$page_HTML .= $form
  . intoBalise("a", "Retour à l'acceuil", array('href' => 'index.php', 'class' => 'btn btn-primary'))
  . getFinHTML();
echo $page_HTML;
?>