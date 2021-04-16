<?php

function updateNom($nom) {
	global $bdd;
	$requete_update_nom = $bdd->prepare("UPDATE users SET nom = :nom WHERE id_u = ".$_SESSION['id_u']);
	$requete_update_nom->bindValue(':nom', $nom, PDO::PARAM_STR);
	return $requete_update_nom->execute();
}

function updatePrenom($prenom) {
	global $bdd;
	$requete_update_prenom = $bdd->prepare("UPDATE users SET prenom = :prenom WHERE id_u = ".$_SESSION['id_u']);
	$requete_update_prenom->bindValue(':prenom', $prenom, PDO::PARAM_STR);
	return $requete_update_prenom->execute();
}

function updateTel($tel) {
	global $bdd;
	$requete_update_tel = $bdd->prepare("UPDATE users SET tel = :tel WHERE id_u = ".$_SESSION['id_u']);
	$requete_update_tel->bindValue(':tel', $tel, PDO::PARAM_STR);
	return $requete_update_tel->execute();
}

function updateAdresse($adresse) {
	global $bdd;
	$requete_update_adresse = $bdd->prepare("UPDATE users SET adresse = :adresse WHERE id_u = ".$_SESSION['id_u']);
	$requete_update_adresse->bindValue(':adresse', $adresse, PDO::PARAM_STR);
	return $requete_update_adresse->execute();
}

function updateCp($cp) {
	global $bdd;
	$requete_update_cp = $bdd->prepare("UPDATE users SET cp = :cp WHERE id_u = ".$_SESSION['id_u']);
	$requete_update_cp->bindValue(':cp', $cp, PDO::PARAM_STR);
	return $requete_update_cp->execute();
}

function checkEmail($email) {
	global $bdd;
	$requete_email_exist = $bdd->prepare("SELECT * FROM users WHERE email = :email");
	$requete_email_exist->bindValue(':email', $email, PDO::PARAM_STR);
	$requete_email_exist->execute();
	return $requete_email_exist->fetchAll();
}

function updateEmail($email) {
	global $bdd;
	$requete_update_email = $bdd->prepare("UPDATE users SET email = :email WHERE id_u = ".$_SESSION['id_u']);
	$requete_update_email->bindValue(':email', $email, PDO::PARAM_STR);
	return $requete_update_email->execute();
}

function checkMdp($mdp) {
	global $bdd;
	$requete_mdp_user = $bdd->prepare("SELECT mdp FROM users WHERE mdp = :mdp");
	$requete_mdp_user->bindValue(':mdp', $mdp, PDO::PARAM_STR);
	$requete_mdp_user->execute();
	return $requete_mdp_user->fetch();
}

function updateMdp($newmdp) {
	global $bdd;
	$requete_update_mdp = $bdd->prepare("UPDATE users SET mdp = :mdp WHERE id_u = ".$_SESSION['id_u']);
	$requete_update_mdp->bindValue(':mdp', $newmdp, PDO::PARAM_STR);
	return $requete_update_mdp->execute();
}

function checkUser($email, $mdp) {
	global $bdd;
	$requete_check_user = $bdd->prepare("SELECT * FROM users WHERE email = :email AND mdp = :mdp");
	$requete_check_user->bindValue(':email', $email, PDO::PARAM_STR);
	$requete_check_user->bindValue(':mdp', $mdp, PDO::PARAM_STR);
	$requete_check_user->execute();
	return $requete_check_user->fetchAll();
}

function deleteUser() {
	global $bdd;
	$delete_account = $bdd->prepare("DELETE FROM users WHERE id_u = ".$_SESSION['id_u']);
	return $delete_account->execute();
}

?>