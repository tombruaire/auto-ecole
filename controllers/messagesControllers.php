<?php

if (!isset($_SESSION['id_u'])) {
	header('Location: http://localhost/auto-ecole/');
	exit();
}

require('models/messagesModels.php');

$messages = getAllMessages();

if (isset($_POST['subeleves'])) {
	$id_dest = $_POST['id_dest'];
	$contenu = $_POST['contenu'];
	if ($contenu != "") {
		$insertion = insertMessage($id_dest, $contenu);
		header('Location: messages');
	} else {
		Alerts::setFlash("Le message ne peut pas être vide !", "warning");
	}
}

if (isset($_GET['id_exp'])) { // NE FONCTIONNE PAS
	$id_exp = $_GET['id_exp'];
	$delete = deleteMessage($id_exp);
	header('Location: messages');
}

if (isset($_POST['delete'])) {
	$delete_all = deleteAllMessages();
	header('Location: messages');
}

require('views/messages.php');

?>