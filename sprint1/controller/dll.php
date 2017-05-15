<?php

function connectDB() {
    global $db, $connexion;

    try {
        //$connexion = new PDO('mysql:host=localhost;dbname=lyracom;port=8888', "root", "") ;
        $connexion = new PDO('mysql:host=' . $db["host"] . ';dbname=' . $db["name"], $db["user"], $db["pwd"]);
        $connexion->query('SET NAMES UTF8');
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage() . '<br />';
        echo 'N� : ' . $e->getCode();
    }
}

function closeDB() {
    global $db, $connexion;

    $connexion = null;
}

function replaceComma($string) {
    return str_replace(',', '.', $string);
}

function replaceDot($string) {
    return str_replace('.', ',', $string);
}

function haveRight($right) {
    global $USER_LOG_GROUP, $NAV;
    $rightgroup = getRightGroupsbyGroupUserAndFunctionality($NAV, $USER_LOG_GROUP->getId());
    if (!empty($rightgroup)) {
        //sprintf rajoute éventuellement des zero
        $mask = sprintf("%08d", decbin($rightgroup->getValue()));
        $right = sprintf("%08d", decbin($right));
        $result = $right & $mask;

        return $result != 0;
    } else {
        return false;
    }
}

function initMetas() {
    global $idLang, $nav, $meta_title, $meta_description, $meta_kw;

    if ($idLang == 1) {
        $meta_kw = "";
        switch ($nav) {
            case "home": {
                    $meta_title = "";
                    $meta_description = "";
                    break;
                }
        }
    }
}

function switchLanguage($idLang) {
    global $rooturlFr, $rooturlEn;

    switch ($idLang) {

        case 1 : {
                return $rooturlEn . $_SERVER['REQUEST_URI'];
                break;
            }
        case 2 : {
                return $rooturlFr . $_SERVER['REQUEST_URI'];
                break;
            }
        default : {
                return $rooturlEn . $_SERVER['REQUEST_URI'];
                break;
            }
    }
}

////////////////////////
///DEBUG
////////////////////////

function alert($msg) {
    echo "<script language='javascript'>alert('" . $msg . "');</script>";
}

////////////////////////
//TRAITEMENT DES DONNEES
////////////////////////

function generateTitle() {
    global $rooturl, $site_title;

    $title = $site_title;


    return $title;
}

function mysql_DateTime($d) {

    $date = substr($d, 8, 2) . "/";        // jour
    $date = $date . substr($d, 5, 2) . "/";  // mois
    $date = $date . substr($d, 0, 4) . " "; // ann?e
    $date = $date . substr($d, 11, 5);     // heures et minutes

    return substr($date, 0, 10);
}

function mysql_DateTimeHours($d) {

    $date = substr($d, 8, 2) . "/";        // jour
    $date = $date . substr($d, 5, 2) . "/";  // mois
    $date = $date . substr($d, 0, 4) . " "; // ann?e
    $date = $date . substr($d, 11, 5);     // heures et minutes

    return $date;
}

function parseHours($d) {
    return substr($d, 11, 18);
}

//Converti au format anglais une date en francais
function datefr2en($mydate) {
    @list($jour, $mois, $annee) = explode('/', $mydate);
    return @date('Y-m-d', mktime(0, 0, 0, $mois, $jour, $annee));
}

//Converti au format anglais une date en francais
function datetimefr2en($mydatetime) {

    @list($date, $time) = explode(' ', $mydatetime);

    @list($jour, $mois, $annee) = explode('/', $date);
    @list($hour, $minute) = explode(':', $time);

    return @date('Y-m-d H:i', mktime($hour, $minute, 0, $mois, $jour, $annee));
}

function minToHMS($time) {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    if(sizeof($hours) <= 1){
        $result = "0" . $hours . ":" . $minutes . ":" . "00";
    }else{
        $result = $hours . ":" . $minutes . ":" . "00"; 
    }
    return $result;
}

function datetimeToDateEn($date) {
    return str_replace("-", "/", $date);
}

//Test si le champ est vide (champs requis)
function estVide($champ) {
    if ($champ == "")
        return true;
    else
        return false;
}

function testTextAlpha($text) {
    return !ctype_space($text) && !estVide($text);
}

function testTextAlphaNum($text) {
    return ctype_alnum($text) && !estVide($text);
}

function testEnDate($date) {
    return preg_match("#^(1[9][0-9][0-9]|2[0][0-9][0-9])[- / .]([1-9]|0[1-9]|1[0-2])[- / .]([1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-1])$#", $date);
}

function testBirthday($y, $m, $d) {
    global $majorityYear;


    $date = $d . "/" . $m . "/" . $y;
    alert($date);
    if (preg_match("#^([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})$#", $date) && $y <= $majorityYear) {
        return true;
    } else {
        return false;
    }
}

//Fonction de s?curisation des champs pour ?viter des attaque SQL, Javascript, etc...
function sChamp($champ) {
    return htmlentities(trim($champ), ENT_QUOTES, "UTF-8");
}

function decode($text) {
    return html_entity_decode($text, ENT_QUOTES, "UTF-8");
}

function testNum($nombre) {
    return is_numeric($nombre);
}

function testDecimal($value) {
    $value = replaceComma($value);

    return is_float(floatval($value));
}

function testEmail($email) {
    return preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,5}$#", $email);
}

function testHour($value) { //test sur format 08:32 ok
    return preg_match("#^([01]?[0-9]|2[0-3]):[0-5][0-9]$#", $value);
}

function returnSeconds($value) { // retour le nombre de seconde à parti d'une heure au format hh:ss
    $exploded = explode(":", $value);

    return $exploded[0] * 60 + $exploded[1];
}

function testDate($date) {
    return preg_match("#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#", $date);
}

function testNumTel($num) {
    return preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $num);
}

function testNumTelPort($num) {
    return preg_match("#^0[6-7]([-. ]?[0-9]{2}){4}$#", $num);
}

function testLatitude($value) {
    return !empty($value) && $value >= -90 && $value <= 90 && is_numeric($value);
}

function testLongitude($value) {
    return !empty($value) && $value >= -180 && $value <= 180 && is_numeric($value);
}

//Se rendre ? une adresse en $delais d?fini dans conf.php
function seRendreA($url) {
    header("Location: " . $url);
    //echo "<script language='javascript'>setTimeout(\"window.location='".$url."'\",0); </script>";
}

function seRendreAJava($url) {

    echo "<script language='javascript'>setTimeout(\"window.location='" . $url . "'\",0); </script>";
}

//Se rendre ? une URL au bout de $delais MILISECONDES
function seRendreAenTemps($url, $delais) {


    echo "<script language='javascript'>setTimeout(\"window.location='" . $url . "'\"," . $delais . "); </script>";
}

function getClientIp() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

//////////////
//SECU
//////////////
//Permet d'initiliaser les varaiables de session (cas au moment ou l'on arrive sur le site)
function setSessions() {
    global $notconnected_inc, $defaulttoken_inc;


    if (!isset($_SESSION['COU'])) {
        $_SESSION['COU'] = $notconnected_inc;
    }
    if (!isset($_SESSION['TOU'])) {
        $_SESSION['TOU'] = $defaulttoken_inc;
    }
}

//G?n?re une chaine al?atoire avec une taille ($car)
function randomChaine($car) {
    $string = "";
    $chaine = "abcdefghijklpqrstuvwxyABDEFQRST0123456789";
    srand((double) microtime() * 1000000);
    for ($i = 0; $i < $car; $i++) {
        $string .= $chaine[rand() % strlen($chaine)];
    }

    return $string;
}

function randomAlphaM($car) {
    $string = "";
    $chaine = "ABCDEFGHIKNQRSTUVWXYZ";
    srand((double) microtime() * 1000000);
    for ($i = 0; $i < $car; $i++) {
        $string .= $chaine[rand() % strlen($chaine)];
    }

    return $string;
}

//Crypte la variable pass?e en param?tre
function chiffre($t) {
    global $salt1;
    global $salt2;


    $crypte = sha1($salt1 . $t . $salt2);

    return $crypte;
}

function getMonths() {
    $months = array();
    $months[] = "Janvier";
    $months[] = "F&eacute;vrier";
    $months[] = "Mars";
    $months[] = "Avril";
    $months[] = "Mai";
    $months[] = "Juin";
    $months[] = "Juillet";
    $months[] = "Ao&ucirc;t";
    $months[] = "Septembre";
    $months[] = "Octobre";
    $months[] = "Novembre";
    $months[] = "D&eacute;cembre";

    return $months;
}

function getDaysWeek() {
    $days = array();
    $days[] = "Lundi";
    $days[] = "Mardi";
    $days[] = "Mercredi";
    $days[] = "Jeudi";
    $days[] = "Vendredi";
    $days[] = "Samedi";
    $days[] = "Dimanche";
    return $days;
}

function sluggable($text) {
    $text = html_entity_decode((strip_tags(html_entity_decode($text, ENT_QUOTES, 'UTF-8'))));
    $separator = '-';
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array('&' => 'and', "'" => '');
    $text = mb_strtolower(trim($text), 'UTF-8');
    $text = str_replace(array_keys($special_cases), array_values($special_cases), $text);
    $text = preg_replace($accents_regex, '$1', htmlentities($text, ENT_QUOTES, 'UTF-8'));
    $text = preg_replace("/[^a-z0-9]/u", "$separator", $text);
    $text = preg_replace("/[$separator]+/u", "$separator", $text);



    if (empty($text)) {
        return 'n-a';
    }

    if ($text == "-") {
        return randomChaine(10);
    }

    return $text;
}

function isConnected() {

    global $connected_inc, $defaulttoken_inc;

    return $_SESSION['COU'] == $connected_inc && $_SESSION['TOU'] != $defaulttoken_inc;
}

function backline() {
    echo "<br /><hr /><br />";
}
