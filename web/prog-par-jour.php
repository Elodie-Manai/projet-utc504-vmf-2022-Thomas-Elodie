<!DOCTYPE html>
<html lang="fr">

<?php
// Définition des variables globales
$GLOBALS["title-page"] = "Programmation par jour";
$GLOBALS["id-page"] = "nav-prog-par-jour";
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
		"SELECT *, artiste.nom as nom_artiste, scene.nom as nom_scene FROM concert, artiste, scene WHERE artiste.id_artiste = concert.id_artiste AND concert.id_scene = scene.id_scene  ORDER BY concert.date_concert, concert.heure_concert;" 
	);
	$aDates = executeRequeteQuiRetourneDesEnregistrements(
		$GLOBALS["bdd-lecture-PDO"],
		"SELECT date_concert FROM concert GROUP BY date_concert;" 
	);
	?>

	<!-- Contenu principal de la page -->
	<main class="container px-5">
		<h1>Programmation par jour</h1>

		<p class="lead">Cette page affiche la liste des concert par jour du festival 2022 (ordre chronologique).</p>

		<div class="row my-5">
			<?php foreach($aDates as $date) { ?>
			<h2 class="donnee-bdd gras" style="font-size: 2em" ><?= $date['date_concert'] ?></h2>
				<?php foreach($aArtistes as $artiste) { ?>
					<?php if($artiste['date_concert'] == $date['date_concert']) { ?>
						<div class="col-lg-3 col-md-4 col-sm-6 my-2">
							<a style="text-decoration: none; color: black" href="artiste.php?id=<?= $artiste['id_artiste'] ?>">
								<div class="card">
									<img src="<?= $artiste['lien_photo']; ?>" class="card-img-top" alt="Illustration artiste">
									<div class="card-body">
										<h5 class="card-title"><span class="donnee-bdd gras"><?= $artiste['nom_artiste']; ?></span></h5>
										<p class="card-text">
											Heure de début : <span class="donnee-bdd"><?= $artiste['heure_concert']; ?></span><br>
											Scène : <span class="donnee-bdd"><?= $artiste['nom_scene'] ?></span>
										</p>
									</div>
								</div>
							</a>
						</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</div>

	</main>

	<!-- Inclusion du JS de Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>