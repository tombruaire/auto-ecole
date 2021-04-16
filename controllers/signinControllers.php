<?php

if (isset($_SESSION['id_u'])) {
	header('Location: http://localhost/auto-ecole/');
	exit();
}

require('models/signinModels.php');

if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$mdp = sha1($_POST['mdp']);
	if ($email != "" && $mdp != "") {
		$user = getUsers($email, $mdp);
		if ($user) {
			$session->setVar('id_u', $user['id_u']);
			$session->setVar('nom', $user['nom']);
            $session->setVar('prenom', $user['prenom']);
            $session->setVar('tel', $user['tel']);
            $session->setVar('adresse', $user['adresse']);
            $session->setVar('cp', $user['cp']);
            $session->setVar('email', $user['email']);
           	$session->setVar('lvl', $user['lvl']);
           	header('Location: home');
		} else {
			Alerts::setFlash("Identifiants incorrect !", "danger");
		}
	} else {
		Alerts::setFlash("Veuillez compléter tous les champs !", "warning");
	}
}

require('views/signin.php');

?>