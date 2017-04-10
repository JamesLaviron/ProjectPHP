<?php


ob_start();
date_default_timezone_set('Europe/Paris');
header('Content-type: text/html; charset=utf-8');
$debug = 0;


ini_set('display_errors',1); 
error_reporting(E_ALL);  

//Chargement de la configuration du site
$resspath = str_replace("controller", '', __DIR__)."/"; //On prend le chemin de ce fichier - son dossier pour retourner à la racine du site.

$mediapath = $resspath."img/media/";
$jobpath = $mediapath."job/";


   
require_once($resspath."pages/generic/conf_inc.php");
//Chargement de la bibliothèque basiques
require_once($resspath."controller/dll.php");


//Chargement des classe



setSessions();
//Connexion à la base
connectDB();

//Metas HTTP
initMetas();


require_once($resspath.'pages/generic/url_inc.php'); 
require_once($resspath.'pages/generic/lang_inc.php');


/*
$detect = new Mobile_Detect();
$isMobile = $detect->isMobile() ;
$isTablet = $detect->isTablet();
$isLowDef = $isMobile || $isTablet;*/
