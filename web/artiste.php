<!DOCTYPE html>
<html lang="fr">

<?php
// Définition des variables globales
$GLOBALS["title-page"] = "Programmation par jour";

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
	$artiste = executeRequeteQuiRetourneDesEnregistrements(
		$GLOBALS["bdd-lecture-PDO"],
		"SELECT * FROM artiste, video WHERE artiste.id_artiste = " . $_GET['id'] . ";" 
	)[0];
	$aVideos = executeRequeteQuiRetourneDesEnregistrements(
		$GLOBALS["bdd-lecture-PDO"],
		"SELECT * FROM  video WHERE video.id_artiste = " . $_GET['id'] . ";" 
	);
	?>

	<!-- Contenu principal de la page -->
	<main class="container px-5">
		<div style="text-align: center">
			<img src="<?= $artiste['lien_photo'] ?>" alt="artiste photo" class="img-fluid" style="width: 250px; height: 250px; border-radius: 100%;">
			<h1><?=$artiste['nom'] ?></h1>
			<a href="<?= $artiste['lien_site'] ?>" class="btn btn-outline-primary btn-lg">visitez moi</a>
		</div>
		<div class="row my-5">
			<h2>Mes créations</h2>
			<?php foreach($aVideos as $video) { ?>
				<?php 
				$url = $video['lien_video'];
				preg_match_all("#(?<=v=|v\/|vi=|vi\/|youtu.be\/)[a-zA-Z0-9_-]{11}#", $url, $match);		 
				?>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="card">
						<div class="card-body">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $match[0][0] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			<?php } ?>      
		</div>
	</main>

	<!-- Inclusion du JS de Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>