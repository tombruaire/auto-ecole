<?php 

if (!isset($_SESSION['id_u'])) {
	header('Location: http://localhost/auto-ecole/signin');
	exit();
}

require('models/lessonsModels.php');

if (isset($_POST['add-lessons'])) {
	$titre = $_POST['titre'];
	$description = $_POST['description'];
	$date_debut = $_POST['date_debut'];
	$date_fin = $_POST['date_fin'];
	$id_e = $_POST['id_e'];
	$id_m = $_POST['id_m'];
	if ($titre != "" && $description != "" && $date_debut != "" && $date_fin != "") {
		$requete_check_titre = checkTitre($titre);
		if (!$requete_check_titre) {
			$insertion = insertLessons($titre, $description, $date_debut, $date_fin, $id_e, $id_m);
			header('Location: lessons');
		} else {
			Alerts::setFlash("Ce titre existe déjà !", "danger");
		}
	} else {
		Alerts::setFlash("Veuillez compléter tous les champs !", "warning");
	}
}

require('views/lessons.php'); 

?>