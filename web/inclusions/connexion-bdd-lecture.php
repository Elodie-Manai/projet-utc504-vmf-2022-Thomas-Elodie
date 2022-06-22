<?php
// Informations de connexion à la BDD
$url_hote_mysql = "...";
$nom_base = "...";
$nom_utilisateur_base = "";
$mdp_utilisateur_base = "";
// TODO Compléter avec les informations de connexion de votre propre BDD

// Vérification des informations de connexion
if (
	empty($url_hote_mysql) || empty($nom_base)
	|| empty($nom_utilisateur_base) || empty($mdp_utilisateur_base)
) {
	// Si jamais une des informations est manquante, on affiche un message d'erreur
	echo '<p style="font-size:1.4em; color:firebrick; margin:15px;">ERREUR : Une des informations de connexion est manquante !</p>';
}

// Connexion à la BDD en utilisant les "PHP Data Objects" (PDO)
try {
	// Définition et stockage de l'objet de connexion
	$GLOBALS["bdd-lecture-PDO"] = new PDO(
		'mysql:host=' . $url_hote_mysql . ';dbname=' . $nom_base . ';charset=utf8',
		$nom_utilisateur_base,
		$mdp_utilisateur_base
	);
} catch (Exception $e) {
	// Si jamais on n'arrive pas à se connecter à la base,
	// on affiche un message d'erreur
	echo '<p style="font-size:1.4em; color:firebrick; margin:15px;">ERREUR : Problème de connexion à la BDD dont les détails sont :<br> <i>' . $e->getMessage() . '</i></p>';
}
