<?php
	/**
	 * Fonction qui exécute une requête SQL SELECT et qui retourne
	 * un tableau contenant le 1er enregistrement retourné par la requête.
	 */
	function executeRequeteQuiRetourneUnEnregistrement($objConnexionBDD, $requeteSQL){
		$req = $objConnexionBDD->query($requeteSQL);
		if($req !== false) {
			$resReq = $req->fetch();
			return $resReq[0];
		} else {
			return null;
		}
	}

	/**
	 * Fonction qui exécute une requête SQL SELECT et qui retourne
	 * un tableau de tableaux contenant tous les enregistrements
	 * retournés par la requête.
	 */
	function executeRequeteQuiRetourneDesEnregistrements($objConnexionBDD, $requeteSQL){
		$req = $objConnexionBDD->query($requeteSQL);
		if($req !== false) {
			$resReq = $req->fetchAll();
			return $resReq;
		} else {
			return null;
		}
	}
