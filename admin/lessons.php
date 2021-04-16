<?php auth(3); 

$lessons = $bdd->query("SELECT * FROM vLessons ORDER BY id_l DESC");

if (isset($_POST['add-lessons'])) {
	$titre = $_POST['titre'];
	$description = $_POST['description'];
	$date_debut = $_POST['date_debut'];
	$date_fin = $_POST['date_fin'];
	$id_e = $_POST['id_e'];
	$id_m = $_POST['id_m'];
	if ($titre != "" && $description != "" && $date_debut != "" && $date_fin != "") {
		echo "ok";
		$check_titre_exist = $bdd->prepare("SELECT titre FROM lessons WHERE titre = :titre");
		$check_titre_exist->bindValue(':titre', $titre, PDO::PARAM_STR);
		$check_titre_exist->execute();
		$check_titre_exist =  $check_titre_exist->fetch();
		if (!$check_titre_exist) {
			$insertion = $bdd->prepare("INSERT INTO lessons (titre, description, date_debut, date_fin, id_e, id_m) VALUES (:titre, :description, :date_debut, :date_fin, :id_e, :id_m)");
			$insertion->bindValue(':titre', $titre, PDO::PARAM_STR);
			$insertion->bindValue(':description', $description, PDO::PARAM_STR);
			$insertion->bindValue(':date_debut', $date_debut, PDO::PARAM_STR);
			$insertion->bindValue(':date_fin', $date_fin, PDO::PARAM_STR);
			$insertion->bindValue(':id_e', $id_e, PDO::PARAM_INT);
			$insertion->bindValue(':id_m', $id_m, PDO::PARAM_INT);
			$insertion->execute();
			header('Location: lessons');
		} else {
			Alerts::setFlash("Ce titre a déjà été enregistré !", "danger");
		}
	} else {
		Alerts::setFlash("Veuillez compléter tous les champs !", "warning");
	}
}

if (isset($_POST['retour'])) {
	header('Location: lessons');
}

if (isset($_POST['modifier'])) {
	$id_l = $_GET['edit'];
	$titre = $_POST['titre'];
	$description = $_POST['description'];
	$date_debut = $_POST['date_debut'];
	$date_fin = $_POST['date_fin'];
	$id_e = $_POST['id_e'];
	$id_m = $_POST['id_m'];
	if ($titre != "" && $titre != "" && $description != "" && $date_debut != "" && $date_fin) {
		$update = $bdd->prepare("UPDATE lessons SET titre = :titre, description = :description, date_debut = :date_debut, date_fin = :date_fin, id_e = :id_e, id_m = :id_m WHERE id_l = :id_l");
		$update->bindValue(':titre', $titre, PDO::PARAM_STR);
		$update->bindValue(':description', $description, PDO::PARAM_STR);
		$update->bindValue(':date_debut', $date_debut, PDO::PARAM_STR);
		$update->bindValue(':date_fin', $date_fin, PDO::PARAM_STR);
		$update->bindValue(':id_e', $id_e, PDO::PARAM_STR);
		$update->bindValue(':id_m', $id_m, PDO::PARAM_INT);
		$update->bindValue(':id_l', $id_l, PDO::PARAM_INT);
		$update->execute();
		header('Location: lessons');
	} else {
		Alerts::setFlash("<strong>Les champs ne doivent pas être vide !</strong>", "warning");
	}
}

if (isset($_GET['id_l'])) {
	$id_l = $_GET['id_l'];
	$delete = $bdd->prepare("DELETE FROM lessons WHERE id_l = :id_l");
	$delete->bindValue('id_l', $id_l, PDO::PARAM_INT);
	$delete->execute();
	header('Location: lessons');
}

?>
<link rel="stylesheet" type="text/css" href="../assets/css/dark.css">
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3 text-center">Liste des cours</h1>
		<div class="d-flex justify-content-center mb-3">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-lessons">
				Ajouter un cours
			</button>
		</div>
		<?= Alerts::getFlash(); ?>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="datatables-reponsive" class="table mb-0">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Titre</th>
										<th scope="col">Description</th>
										<th scope="col">Début</th>
										<th scope="col">Fin</th>
										<th scope="col">Élève</th>
										<th scope="col">Moniteur</th>
										<th scope="col">Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($lessons as $lesson) { ?>
	                                <?php if (isset($_GET['edit'])) { ?>
									<tr>
										<form method="post" action="">
											<td><?= $lesson['id_l']; ?></td>
											<td>
												<input type="text" name="titre" class="form-control" value="<?= $lesson['titre']; ?>">
											</td>
											<td>
												<textarea name="description" class="form-control"><?= $lesson['description']; ?></textarea>
											</td>
											<td>
												<input type="datetime-local" name="date_debut" class="form-control" value="<?= $lesson['date_debut']; ?>">
											</td>
											<td>
												<input type="datetime-local" name="date_fin" class="form-control" value="<?= $lesson['date_fin']; ?>">
											</td>
											<td>
												<select name="id_e" class="form-select">
						                            <?php $requete = $bdd->query("SELECT * FROM users WHERE lvl = 1");
						                            $lesEleves = $requete->fetchAll();
						                            foreach ($lesEleves as $unEleve) { ?>
						                            <option value="<?= $unEleve['id_u']; ?>"><?= $unEleve['nom']; ?></option>
						                            <?php } ?>
						                        </select>
											</td>
											<td>
												<select name="id_m" class="form-select">
						                            <?php $requete = $bdd->query("SELECT * FROM users WHERE lvl = 2");
						                            $lesMoniteurs = $requete->fetchAll();
						                            foreach ($lesMoniteurs as $unMoniteur) { ?>
						                            <option value="<?= $unMoniteur['id_u']; ?>"><?= $unMoniteur['nom']; ?></option>
						                            <?php } ?>
						                        </select>
											</td>
											<td>
												<button type="submit" name="modifier" class="btn btn-primary me-2">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
	  													<path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
													</svg>
												</button>
												<button type="submit" name="retour" class="btn btn-danger">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
	  													<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
													</svg>
												</button>
											</td>
										</form>
									</tr>
									<?php } else { ?>
									<tr>
										<td><?= $lesson['id_l']; ?></td>
										<td><?= $lesson['titre']; ?></td>
										<td><?= $lesson['description']; ?></td>
										<td><?= $lesson['date_debut']; ?></td>
										<td><?= $lesson['date_fin']; ?></td>
										<td><?= $lesson['id_e']; ?></td>
										<td><?= $lesson['id_m']; ?></td>
										<td>
											<a class="btn btn-primary font-weight-bolder me-2" href="lessons&edit=<?= $lesson['id_l']; ?>">
	                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
	  												<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
	  												<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
												</svg>
	                                        </a>
	                                        <a class="btn btn-danger font-weight-bolder" href="lessons&id_l=<?= $lesson['id_l']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer ce cours ?'));">
	                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
	  												<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
												</svg>
	                                        </a>
										</td>
									</tr>
									<?php } ?>
	                                <?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-center">
					<a class="btn btn-lg btn-primary" href="users">Voir les utilisateurs</a>
				</div>
			</div>
		</div>
	</div>
</main>

<div class="modal fade" id="modal-lessons" tabindex="-1" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Ajouter un cours</h5>
        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      		</div>
      		<div class="modal-body">
        		<form method="post" action="">
        			<?= $helper->input('titre', 'Titre du cours', 'text'); ?>
                    <?= $helper->textarea('description', 'Description du cours'); ?>
                    <?= $helper->input('date_debut', 'Date de début', 'datetime-local'); ?>
                    <?= $helper->input('date_fin', 'Date de fin', 'datetime-local'); ?>
                    <div class="mb-3">
                        <label for="eleve" class="form-label">Élève</label>
                        <select name="id_e" id="eleve" class="form-select">
                            <?php $requete = $bdd->query("SELECT * FROM users WHERE lvl = 1");
                            $lesEleves = $requete->fetchAll();
                            foreach ($lesEleves as $unEleve) { ?>
                            <option value="<?= $unEleve['id_u']; ?>"><?= $unEleve['nom']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="moniteur" class="form-label">Moniteur</label>
                        <select name="id_m" id="moniteur" class="form-select">
                            <?php $requete = $bdd->query("SELECT * FROM users WHERE lvl = 2");
                            $lesMoniteurs = $requete->fetchAll();
                            foreach ($lesMoniteurs as $unMoniteur) { ?>
                            <option value="<?= $unMoniteur['id_u']; ?>"><?= $unMoniteur['nom']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" name="add-lessons" class="btn btn-primary btn-lg">Ajouter le cours</button>
                    </div>
        		</form>
      		</div>
    	</div>
  	</div>
</div>

<script src="../assets/js/app.js"></script>

<style type="text/css">
.page-item.active .page-link {
    background-color: #0d6efd!important;
    border: 1px solid #0d6efd!important;
}
.page-link {
    color: #f8f9fa!important;
}
</style>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
	$("#datatables-reponsive").DataTable({
		responsive: true, // Tableau responsive
		ordering: false, // Classement par ordre alphabétique
		iDisplayLength: 5, // Nombre d'affichage par défaut (au chargement de la page)
		language: {
			lengthMenu: 'Afficher <select class="form-select">'+
      		'<option value="1">1</option>'+ // Affichage de 1 cour
      		'<option value="5">5</option>'+ // Affichage de 5 cours, etc...
      		'<option value="10">10</option>'+
      		'<option value="25">25</option>'+
     		'<option value="50">50</option>'+
      		'<option value="-1">100</option>'+ // Affichage de tous les cours
      		'</select> cours',
            emptyTable: "Aucune donnée disponible dans le tableau",
    		info: "Affichage de _START_ à _END_ cours sur _TOTAL_ cours",
		    search: "Rechercher :",
		    zeroRecords: "Aucun cours trouvé",
		    paginate: {
		        previous: "Précédent",
		        next: "Suivant"
		    }
        }
	});
});
</script>
