<?php

if (!isset($_SESSION['id_u'])) {
	header('Location: http://localhost/auto-ecole/');
	exit();
}

require('models/profilModels.php');

if (isset($_POST['subname'])) {
	$nom = $_POST['nom'];
	if ($nom != "") {
		$requete_update_nom = updateNom($nom);
		Session::destroy();
	} else {
		Alerts::setFlash("<strong>Le champ ne doit pas être vide !</strong>", "warning");
	}
}

if (isset($_POST['subprenom'])) {
	$prenom = $_POST['prenom'];
	if ($prenom != "") {
		$requete_update_prenom = updatePrenom($prenom);
		Session::destroy();
	} else {
		Alerts::setFlash("<strong>Le champ ne doit pas être vide !</strong>", "warning");
	}
}

if (isset($_POST['subtel'])) {
	$tel = $_POST['tel'];
	if ($tel != "") {
		$requete_update_tel = updateTel($tel);
		Session::destroy();
	} else {
		Alerts::setFlash("<strong>Le champ ne doit pas être vide !</strong>", "warning");
	}
}

if (isset($_POST['subadresse'])) {
	$adresse = $_POST['adresse'];
	if ($adresse != "") {
		$requete_update_adresse = updateAdresse($adresse);
		Session::destroy();
	} else {
		Alerts::setFlash("<strong>Le champ ne doit pas être vide !</strong>", "warning");
	}
}

if (isset($_POST['subcp'])) {
	$cp = $_POST['cp'];
	if ($cp != "") {
		$requete_update_cp = updateCp($cp);
		Session::destroy();
	} else {
		Alerts::setFlash("<strong>Le champ ne doit pas être vide !</strong>", "warning");
	}
}

if (isset($_POST['subemail'])) {
	$email = $_POST['email'];
	if ($email != "") {
		if (preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,6}$#", $email)) {
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$requete_email_exist = checkEmail($email);
				if (!$requete_email_exist) {
					$requete_update_email = updateEmail($email);
					Session::destroy();
				} else {
					Alerts::setFlash("<strong>Adresse email déjà utilisée !</strong>", "danger");
				}
			} else {
				Alerts::setFlash("Format de l'adresse email invalide !", "danger");
			}
		} else {
			Alerts::setFlash("Format de l'adresse email invalide !", "danger");
		}
	} else {
		Alerts::setFlash("<strong>Le champ ne doit pas être vide !</strong>", "warning");
	}
}

if (isset($_POST['submdp'])) {
	$mdp = sha1($_POST['mdp']);
	$newmdp = sha1($_POST['newmdp']);
	$newmdp2 = sha1($_POST['newmdp2']);
	if ($mdp != "" && $newmdp != "" && $newmdp2 != "") {
		$requete_mdp_user = checkMdp($mdp);
		if ($requete_mdp_user) {
			if ($newmdp == $newmdp2) {
				$requete_update_mdp = updateMdp($newmdp);
				Session::destroy();
			} else {
				Alerts::setFlash("<strong>Les mots de passe ne correpondent pas !</strong>", "danger");
			}
		} else {
			Alerts::setFlash("<strong>Mot de passe actuelle incorrect !</strong>", "danger");
		}
	} else {
		Alerts::setFlash("<strong>Les champs ne doivent pas être vide !</strong>", "warning");
	}
}

if (isset($_POST['subaccount'])) {
	$email = $_POST['email'];
	$mdp = sha1($_POST['mdp']);
	if ($email != "" && $mdp != "") {
		$requete_check_user = checkUser($email, $mdp);
		if ($requete_check_user) {
			$delete_account = deleteUser();
			Session::destroy();
		} else {
			Alerts::setFlash("<strong>Identifiants incorrects !</strong>", "danger");
		}
	} else {
		Alerts::setFlash("<strong>Les champs ne doivent pas être vide !</strong>", "warning");
	}
}

require('views/profil.php');

?>