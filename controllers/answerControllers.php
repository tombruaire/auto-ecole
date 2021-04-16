<?php

if (!isset($_SESSION['id_u'])) {
	header('Location: http://localhost/auto-ecole/');
	exit();
}

require('models/answerModels.php');

if (isset($_POST['send'])) {
	$contenu = $_POST['contenu'];
	if ($contenu != "") {
		$insertion = insertMessage($contenu);
		header('Location: messages');
	} else {
		Alerts::setFlash("Le message ne peut pas être vide !", "warning");
	}
}

require('views/answer.php');

?>