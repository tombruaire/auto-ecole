<?php

function checkTel($tel) {
	global $bdd;
	$check_tel_exist = $bdd->prepare("SELECT tel FROM users WHERE tel = :tel");
	$check_tel_exist->bindValue(':tel', $tel, PDO::PARAM_STR);
	$check_tel_exist->execute();
	return $check_tel_exist->fetch();
}

function checkEmail($email) {
	global $bdd;
	$check_email_exist = $bdd->prepare("SELECT email FROM users WHERE email = :email");
	$check_email_exist->bindValue(':email', $email, PDO::PARAM_STR);
	$check_email_exist->execute();
	return $check_email_exist->fetch();
}

function insertUser($nom, $prenom, $tel, $adresse, $cp, $email, $mdp) {
	global $bdd;
	$insertion = $bdd->prepare("INSERT INTO users (nom, prenom, tel, adresse, cp, email, mdp, lvl) VALUES (:nom, :prenom, :tel, :adresse, :cp, :email, :mdp, 1)");
	$insertion->bindValue(':nom', $nom, PDO::PARAM_STR);
	$insertion->bindValue(':prenom', $prenom, PDO::PARAM_STR);
	$insertion->bindValue(':tel', $tel, PDO::PARAM_STR);
	$insertion->bindValue(':adresse', $adresse, PDO::PARAM_STR);
	$insertion->bindValue(':cp', $cp, PDO::PARAM_STR);
	$insertion->bindValue(':email', $email, PDO::PARAM_STR);
	$insertion->bindValue(':mdp', $mdp, PDO::PARAM_STR);
	return $insertion->execute();
}

?>