<?php

function getAllMessages() {
    global $bdd;
    $messages = $bdd->query("SELECT * FROM vMessages");
    $messages->execute();
    return $messages->fetchAll(); 
}

function insertMessage($id_dest, $contenu) {
	global $bdd;
	$insertion = $bdd->prepare("INSERT INTO messages (id_exp, id_dest, date_envoi, contenu, lu) VALUES (:id_exp, :id_dest, NOW(), :contenu, 0)");
    $insertion->bindValue(':id_exp', $_SESSION['id_u'], PDO::PARAM_INT);
    $insertion->bindValue(':id_dest', $id_dest, PDO::PARAM_INT);
	$insertion->bindValue(':contenu', $contenu, PDO::PARAM_STR);
	return $insertion->execute();
}

function deleteMessage($id_exp) {
    global $bdd;
    $delete = $bdd->prepare("DELETE FROM messages WHERE id_exp = :id_exp");
    $delete->bindValue('id_exp', $id_exp, PDO::PARAM_INT);
    return $delete->execute();
}

function deleteAllMessages() {
    global $bdd;
    $delete_all = $bdd->prepare("DELETE FROM messages");
    return $delete_all->execute();
}

?>