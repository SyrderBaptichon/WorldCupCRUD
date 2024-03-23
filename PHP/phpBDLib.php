<?php
include 'connexion.php';

function connexion()
{
    $strConnex = "host=" . $_ENV['dbHost'] . " dbname=" . $_ENV['dbName'] . " user=" . $_ENV['dbUser'] . " password=" . $_ENV['dbPassword'];
    $ptrDB = pg_connect($strConnex);
    if (!$ptrDB) {
        echo ("Problème de connection: " .pg_last_error());
    }
    return $ptrDB;
}

// Méthode pour la table P11_Equipe
function getEquipeById(string $id): array
{
    $ptrDB = connexion();

    $query = "SELECT * FROM P11_Equipe WHERE equipe_id = $1";
    pg_prepare($ptrDB, "reqPrepSelectById", $query);
    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectById", array($id));

    if (isset($ptrQuery)) {
        $resu = pg_fetch_assoc($ptrQuery);
        if (empty($resu)) {
            $resu = array("message" => "Identifiant d'équipe non valide : $id");
        }
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
        return $resu;
    }
}

function getAllEquipe() : array {
    $ptrDB = connexion();

    $query = "SELECT * FROM P11_Membre";

    pg_prepare($ptrDB, "reqPrepSelectAll", $query);

    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectAll", array());

    $resu = array();

    if (isset($ptrQuery)) {
        $resu = pg_fetch_all($ptrQuery);
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resu;
}

function insertEquipe(array $equipe): array
{
    $ptrDB = connexion();

    $ptrInsert = "INSERT INTO P11_Equipe (equipe_nom, equipe_fed, equipe_cont) VALUES ($1,$2,$3)";
    pg_prepare($ptrDB, "reqPrep", $ptrInsert);
    $ptrQuery = pg_execute($ptrDB, "reqPrep", $equipe);

    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return getEquipeById($equipe['equipe_id']);
}

function updateEquipe(array $equipe) {
    $ptrDB = connexion();

    $ptrUpdate = "UPDATE P11_Equipe SET equipe_nom=$2, equipe_fed=$3 ,equipe_cont=$4 WHERE equipe_id=$1" ;
    pg_prepare($ptrDB , "reqPrep" , $ptrUpdate) ;
    $ptrQuery = pg_execute($ptrDB , "reqPrep" , $equipe) ;

    pg_free_result($ptrQuery);
    pg_close($ptrDB);
}

function deleteEquipe(string $id) {
    $ptrDB = connexion();
     
    $ptrDeleteSelec="DELETE FROM P11_Selectionne WHERE equipe_id = $1" ;
    $ptrDeletejoue= "DELETE FROM P11_Joue WHERE equipe_id = $1";
    $ptrDeleteMembre="DELETE FROM P11_Membre WHERE equipe_id = $1";
    $ptrDeleteEquipe= "DELETE FROM P11_Equipe WHERE equipe_id = $1";
     
    pg_prepare($ptrDB, "reqPrepSelec", $ptrDeleteSelec);
    pg_prepare($ptrDB, "reqPrepJoue", $ptrDeletejoue);
    pg_prepare($ptrDB , "reqPrepMembre" , $ptrDeleteMembre) ;
    pg_prepare($ptrDB , "reqPrepEquipe" , $ptrDeleteEquipe) ; 
     
    $ptrQuerySelec = pg_execute($ptrDB, "reqPrepSelec", array($id));
    $ptrQueryJoue = pg_execute($ptrDB, "reqPrepJoue", array($id));
    $ptrQueryMembre = pg_execute($ptrDB, "reqPrepMembre", array($id));
    $ptrQueryEquipe = pg_execute($ptrDB, "reqPrepEquipe", array($id));
    
    pg_free_result($ptrQuerySelec);
    pg_free_result($ptrQueryJoue);
    pg_free_result($ptrQueryMembre);
    pg_free_result($ptrQueryEquipe);
    pg_close($ptrDB);
}


// Méthode pour la table P11_Membre
function getMembreById(string $id): array
{
    $ptrDB = connexion();

    $query = "SELECT * FROM P11_Membre WHERE membre_id = $1";
    pg_prepare($ptrDB, "reqPrepSelectById", $query);
    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectById", array($id));

    if (isset($ptrQuery)) {
        $resu = pg_fetch_assoc($ptrQuery);
        if (empty($resu)) {
            $resu = array("message" => "Identifiant du membre non valide : $id");
        }
        pg_free_result($ptrQuery);
        pg_close($ptrDB);
        return $resu;
    }
}

function getAllMembre() : array {
    $ptrDB = connexion();

    $query = "SELECT * FROM P11_Membre";

    pg_prepare($ptrDB, "reqPrepSelectAll", $query);

    $ptrQuery = pg_execute($ptrDB, "reqPrepSelectAll", array());

    $resu = array();

    if (isset($ptrQuery)) {
        $resu = pg_fetch_all($ptrQuery);
    }
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return $resu;
}

function insertMembre(array $membre): array
{
    $ptrDB = connexion();

    $ptrInsert = "INSERT INTO P11_Membre (membre_nom, membre_prenom, membre_statut, membre_poste, membre_num, equipe_id) VALUES ($1,$2,$3,$4,$5,$6)";
    pg_prepare($ptrDB, "reqPrep", $ptrInsert);
    $ptrQuery = pg_execute($ptrDB, "reqPrep", $membre);

    pg_free_result($ptrQuery);
    pg_close($ptrDB);
    return getMembreById($membre['membre_id']);
}

function updateMembre(array $membre) {
    $ptrDB = connexion();

    $ptrUpdate = "UPDATE P11_Membre SET membre_nom=$2, membre_prenom=$3 ,membre_statut=$4, membre_poste=$5, membre_num=$6, equipe_id=$7 WHERE membre_id=$1" ;
    pg_prepare($ptrDB , "reqPrep" , $ptrUpdate) ;
    $ptrQuery = pg_execute($ptrDB , "reqPrep" , $membre) ;

    pg_free_result($ptrQuery);
    pg_close($ptrDB);
}

function deleteMembre(string $id) {
    $ptrDB = connexion();

    $ptrDeleteJoue = "DELETE FROM P11_Joue WHERE membre_id=$1";
    $ptrDeleteSelec = "DELETE FROM P11_Selectionne WHERE membre_id=$1";
    $ptrDelete ="DELETE FROM P11_Membre WHERE membre_id=$1" ;
    
    pg_prepare($ptrDB, "reqPrepSelec", $ptrDeleteSelec);
    pg_prepare($ptrDB, "reqPrepJoue", $ptrDeleteJoue);
    pg_prepare($ptrDB , "reqPrep" , $ptrDelete) ;

    $ptrQuerySelec = pg_execute($ptrDB, "reqPrepSelec", array($id));
    $ptrQueryJoue = pg_execute($ptrDB, "reqPrepJoue", array($id));
    $ptrQuery = pg_execute($ptrDB , "reqPrep" , array($id)) ;
    pg_free_result($ptrQuerySelec);
    pg_free_result($ptrQueryJoue);
    pg_free_result($ptrQuery);
    pg_close($ptrDB);
}
?>