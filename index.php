<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

// Test de connexion à la base
$config = parse_ini_file("config.ini");
try {
	$pdo = new \PDO("mysql:host=".$config["host"].";dbname=".$config["database"].";charset=utf8", $config["user"], $config["password"]);
} catch(Exception $e) {
	echo "<h1>Erreur de connexion à la base de données:</h1>";
	//echo $e->getMessage();
	//exit;
}

// Chargement des fichiers MVC
require("controller/controller.php");
require("view/vue.php");
require("model/user.php");
require("model/message.php");


// Routes
if(isset($_GET["action"])) {
	switch($_GET["action"]) {
		case "inscription":
			(new controller)->inscription();
			break;
		case "connexion":
			(new controller)->connexion();
			break;
		case "recupererUser":
				(new controller)->recupererUser();
			break;
		case "ajoutMessage":
				(new controller)->ajoutMessage();
			break;
		case "recupererMessage":
				(new controller)->recupererMessage();
		break;
		case "deconnexion":
			(new controller)->deconnexion();
		break;
		case "updatePwd":
			(new controller)->updatePwd();
		break;
		case "profil":
			(new controller)->editionProfil();
		break;
		case "refresh":
			(new controller)->refresh();
		break;
		// Route par défaut : erreur 404
		default:
			(new controller)->erreur404();
		break;
	}
}else{
	if((isset($_GET["action"]) == null) and (isset($_SESSION["connexion"]))){
		(new controller)->ajoutMessage();
	}else{
		(new controller)->connexion();
	}
}