<!DOCTYPE html>
<html lang="fr">

<?php
// Définition des variables globales
$GLOBALS["title-page"] = "Liste des artistes";
$GLOBALS["id-page"] = "nav-liste-artistes";
$GLOBALS["bdd-lecture-PDO"] = null;

// Inclusion du script permettant de se connecter à la BDD
// (et stockage de l'objet dans $GLOBALS["bdd-lecture-PDO"])
require("inclusions/connexion-bdd-lecture.php");

// Inclusion du script fournissant des fonctions permettant d'exécuter
// des requêtes SQL sur la BDD
require("inclusions/fonctions-bdd.php");
?>

<?php
// Inclusion des méta-données de la page (<head>)
require("inclusions/head.php");
?>

<body>

	<?php
	// Inclusion de l'en-tête de la page (<header>)
	require("inclusions/header.php");
	$aArtistes = executeRequeteQuiRetourneDesEnregistrements(
		$GLOBALS["bdd-lecture-PDO"],
		"SELECT * FROM artiste
		INNER JOIN concert ON artiste.id_artiste = concert.id_artiste" 
	);
	?>

	<!-- Contenu principal de la page -->
	<main class="container px-5">
		<h1>Liste des artistes</h1>

		<p class="lead">Cette page affiche la liste des artistes qui se produisent pendant le festival 2022 (ordre alphabétique).</p>

		
		<div class="row my-5">
			<?php foreach($aArtistes as $artiste) { ?> 

				<div class="col-lg-3 col-md-4 col-sm-6 my-2">
					<a style="text-decoration: none; color: black" href="<?= $artiste['lien_site'] ?>">
						<div class="card">
							<img src="<?= $artiste['lien_photo'] ?>" class="card-img-top" alt="Illustration artiste">
							<div class="card-body">
								<h5 class="card-title"><span class="donnee-bdd gras"><?= $artiste['nom'] ?></span></h5>
								<p class="card-text">
									Jour du concert : <span class="donnee-bdd"><?= $artiste['date_concert'] ?></span>
								</p>
							</div>
						</div>
					</a>
				</div> 

			<?php } ?>
		</div>

	</main>

	<!-- Inclusion du JS de Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>