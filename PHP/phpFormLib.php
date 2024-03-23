<?php
/**
 * Created by PhpStorm.
 * User: dominique
 * Date: 14/03/19
 * Time: 11:31
 */

// recherche d'une valeur par défaut à attribuer à un input text
// si l'information est déjà saisie dans un formulaire incomplet
function getInputValue(string $nomVar) : string {
    if (isset($_REQUEST[$nomVar]) && $_REQUEST[$nomVar])
        return "value='".$_REQUEST[$nomVar]."' ";
    return "";
}

// fabrication d'un input HTML de type text
function getInputText(string $nomVar, array $attributs=[]) : string {
    $inputHtml = "<input type='text' name='$nomVar' ";
    $inputHtml .= getInputValue($nomVar);
    if (!empty($attributs)) {
        foreach ($attributs as $attribut => $valeur)
        $inputHtml.= $attribut."='$valeur' ";
    }
    $inputHtml .= "/>";
    return $inputHtml;
}

// fabrication d'une collection d'options de liste de selection HTML à partir d'un fichier
// récupération des options déjà sélectionnées dans un formulaire incomplet

function getOptionsFromFile(string $fileName, string $nomVar): string {
    $lesOptions ="";
    $fp = fopen($fileName, "r");
    while(!feof($fp)) {
        $valeur = trim(fgets($fp, 50));
        $lesOptions .= "<option value='$valeur' ";
        if (isset($_REQUEST[$nomVar]) && $_REQUEST[$nomVar]==$valeur)
            $lesOptions .= "selected='selected' ";
        $lesOptions .= ">$valeur</option>\n";
    }
    return $lesOptions;
}

// fabrication d'une collection de checkbox HTML à partir d'un tableau de valeurs

function getCheckBoxesFromArray(array $valeurs, string $nomVar): string {
    $lesCheckBoxes = "";
    foreach ($valeurs as $valeur) {
        $lesCheckBoxes .= "$valeur <input type='checkbox' name='$nomVar"."[]' ";
        if (isset($_REQUEST[$nomVar]) && in_array($valeur, $_REQUEST[$nomVar])) {
            $lesCheckBoxes .= "checked='checked' ";
        }
        $lesCheckBoxes .= "value='$valeur'>\n";
    }
    return $lesCheckBoxes;
}

// fabrication d'une collection de boutons radio HTML à partir d'un tableau de valeurs

function getRadiosFromArray(array $valeurs, string $nomVar): string {
    $lesRadios = "";
    foreach ($valeurs as $valeur) {
        $lesRadios .= "$valeur <input type='radio' name='$nomVar' ";
        if (isset($_REQUEST[$nomVar]) && $valeur == $_REQUEST[$nomVar]) {
            $lesRadios .= "checked='checked' ";
        }
        $lesRadios .= "value='$valeur'>\n";
    }
    return $lesRadios;
}

// construction d'une liste HTML à partir d'un tableau

function getFormResultIntoUL() : string {
    $resultat = "<ul>\n";
    foreach($_REQUEST as $var) {
        if (is_array($var)) {
            $resultat .= "<li><ul>";
            foreach ($var as $item) {
                $resultat .= "<li>$item</li>\n";
            }
            $resultat .= "</ul></li>\n";
        }
        else {
            $resultat .= "<li>$var</li>\n";
        }
    }
    return $resultat."</ul>\n";

}

// vérification de la présence des valeurs obligatoires d'un formulaire
function valideForm($method, $tabCles) {
    foreach ($tabCles as $cle) {
        if (!isset($method[$cle]))
            return FALSE;
        if (is_string($method[$cle]) && trim($method[$cle]) === "")
            return FALSE;
        if (is_array($method[$cle]) && empty($method[$cle]))
            return FALSE;
    }
    return TRUE;
}
