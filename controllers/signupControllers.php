<?php

if (isset($_SESSION['id_u'])) {
	header('Location: http://localhost/auto-ecole/');
	exit();
}

require('models/signupModels.php');

if (isset($_POST['register'])) {
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$tel = $_POST['tel'];
	$adresse = $_POST['adresse'];
	$cp = $_POST['cp'];
	$email = $_POST['email'];
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);
	if ($nom != "" && $prenom != "" && $tel != "" && $adresse != "" && $cp != "" && $email != "" && $mdp != "" && $mdp2 != "") {
		if (preg_match("#^[0-9]{2}([. -]?[0-9]{2}){4}$#", $tel)) {
			if (preg_match("#^[0-9]{5}|2[A-B][0-9]{3}$#", $cp)) {
				if (preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,6}$#", $email)) {
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$tel_lenght = strlen($tel);
						if ($tel_lenght <= 10) {
							$check_tel_exist = checkTel($tel);
							if (!$check_tel_exist) {
								$check_email_exist = checkEmail($email);
								if (!$check_email_exist) {
									if ($mdp == $mdp2) {
										$insertion = insertUser($nom, $prenom, $tel, $adresse, $cp, $email, $mdp);
										Session::destroy();
									} else {
										Alerts::setFlash("Les mots de passes ne correspondent pas !", "danger");
									}
								} else {
									Alerts::setFlash("Cette adresse email a déjà été enregistrée !", "danger");
								}
							} else {
								Alerts::setFlash("Ce numéro de téléphone est déjà enregistré !", "danger");
							}
						} else {
							Alerts::setFlash("Le numéro de téléphone ne doit pas dépasser 10 caractères !", "danger");
						}
					} else {
						Alerts::setFlash("Format de l'adresse email invalide !", "danger");
					}
				} else {
					Alerts::setFlash("Format de l'adresse email invalide !", "danger");
				}
			} else {
				Alerts::setFlash("Format du code postal invalide !", "danger");
			}
		} else {
			Alerts::setFlash("Format du numéro de téléphone invalide !", "danger");
		}
	} else {
		Alerts::setFlash("Veuillez compléter tous les champs !", "warning");
	}
}

require('views/signup.php');

?>