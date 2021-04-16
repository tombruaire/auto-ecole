<?php

function getUsers($email, $mdp) {
	global $bdd;
	$user = $bdd->prepare("SELECT * FROM users WHERE email = :email AND mdp = :mdp");
	$user->bindValue(':email', $email, PDO::PARAM_STR);
	$user->bindValue(':mdp', $mdp, PDO::PARAM_STR);
	$user->execute();
	return $user->fetch();
}

?>