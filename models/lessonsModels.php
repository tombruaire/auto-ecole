<?php

function checkTitre($titre) {
	global $bdd;
	$requete_check_titre = $bdd->prepare("SELECT titre FROM lessons WHERE titre = :titre");
	$requete_check_titre->bindValue(':titre', $titre, PDO::PARAM_STR);
	$requete_check_titre->execute();
	return $requete_check_titre->fetch();
}

function insertLessons($titre, $description, $date_debut, $date_fin, $id_e, $id_m) {
	global $bdd;
	$insertion = $bdd->prepare("INSERT INTO lessons (titre, description, date_debut, date_fin, id_e, id_m) VALUES (:titre, :description, :date_debut, :date_fin, :id_e, :id_m)");
	$insertion->bindValue(':titre', $titre, PDO::PARAM_STR);
	$insertion->bindValue(':description', $description, PDO::PARAM_STR);
	$insertion->bindValue(':date_debut', $date_debut, PDO::PARAM_STR);
	$insertion->bindValue(':date_fin', $date_fin, PDO::PARAM_STR);
	$insertion->bindValue(':id_e', $id_e, PDO::PARAM_STR);
	$insertion->bindValue(':id_m', $id_m, PDO::PARAM_STR);
	return $insertion->execute();
}

?>