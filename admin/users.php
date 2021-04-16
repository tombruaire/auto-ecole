<?php auth(3); 

$users = $bdd->query("SELECT * FROM users ORDER BY id_u DESC");

if (isset($_POST['add-user'])) {
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$tel = $_POST['tel'];
	$adresse = $_POST['adresse'];
	$cp = $_POST['cp'];
	$email = $_POST['email'];
	$mdp = sha1($_POST['mdp']);
	$lvl = $_POST['lvl'];
	if ($nom != "" && $prenom != "" && $tel != "" && $adresse != "" && $cp != "" && $email != "" && $mdp != "") {
		if (preg_match("#^[0-9]{2}([. -]?[0-9]{2}){4}$#", $tel)) {
			if (preg_match("#^[0-9]{5}|2[A-B][0-9]{3}$#", $cp)) {
				if (preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,6}$#", $email)) {
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$tel_lenght = strlen($tel);
						if ($tel_lenght <= 10) {
							$check_tel_exist = $bdd->prepare("SELECT tel FROM users WHERE tel = :tel");
							$check_tel_exist->bindValue(':tel', $tel, PDO::PARAM_STR);
							$check_tel_exist->execute();
							$check_tel_exist =  $check_tel_exist->fetch();
							if (!$check_tel_exist) {
								$check_email_exist = $bdd->prepare("SELECT email FROM users WHERE email = :email");
								$check_email_exist->bindValue(':email', $email, PDO::PARAM_STR);
								$check_email_exist->execute();
								$check_email_exist = $check_email_exist->fetch();
								if (!$check_email_exist) {
									$insertion = $bdd->prepare("INSERT INTO users (nom, prenom, tel, adresse, cp, email, mdp, lvl) VALUES (:nom, :prenom, :tel, :adresse, :cp, :email, :mdp, :lvl)");
									$insertion->bindValue(':nom', $nom, PDO::PARAM_STR);
									$insertion->bindValue(':prenom', $prenom, PDO::PARAM_STR);
									$insertion->bindValue(':tel', $tel, PDO::PARAM_STR);
									$insertion->bindValue(':adresse', $adresse, PDO::PARAM_STR);
									$insertion->bindValue(':cp', $cp, PDO::PARAM_STR);
									$insertion->bindValue(':email', $email, PDO::PARAM_STR);
									$insertion->bindValue(':mdp', $mdp, PDO::PARAM_STR);
									$insertion->bindValue(':lvl', $lvl, PDO::PARAM_STR);
									$insertion->execute();
									header('Location: users');
								} else {
									Alerts::setFlash("Cette adresse email a déjà été enregistrée !", "danger");
								}
							} else {
								Alerts::setFlash("Ce numéro de téléphone est déjà enregistré !", "danger");
							}
						} else {
							Alerts::setFlash("Le numéro de téléphone ne doit pas dépasser 10 caractères !", "danger");
						}
					} else {
						Alerts::setFlash("Format de l'adresse email invalide !", "danger");
					}
				} else {
					Alerts::setFlash("Format de l'adresse email invalide !", "danger");
				}
			} else {
				Alerts::setFlash("Format du code postal invalide !", "danger");
			}
		} else {
			Alerts::setFlash("Format du numéro de téléphone invalide !", "danger");
		}
	} else {
		Alerts::setFlash("Veuillez compléter tous les champs !", "warning");
	}
}

if (isset($_POST['retour'])) {
	header('Location: users');
}

if (isset($_POST['modifier'])) {
	$id_u = $_GET['edit'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$tel = $_POST['tel'];
	$adresse = $_POST['adresse'];
	$cp = $_POST['cp'];
	$email = $_POST['email'];
	if ($nom != "" && $prenom != "" && $tel != "" && $adresse != "" && $cp != "" && $email != "") {
		$update = $bdd->prepare("UPDATE users SET nom = :nom, prenom = :prenom, tel = :tel, adresse = :adresse, cp = :cp, email = :email WHERE id_u = :id_u");
		$update->bindValue(':nom', $nom, PDO::PARAM_STR);
		$update->bindValue(':prenom', $prenom, PDO::PARAM_STR);
		$update->bindValue(':tel', $tel, PDO::PARAM_STR);
		$update->bindValue(':adresse', $adresse, PDO::PARAM_STR);
		$update->bindValue(':cp', $cp, PDO::PARAM_STR);
		$update->bindValue(':email', $email, PDO::PARAM_STR);
		$update->bindValue(':id_u', $id_u, PDO::PARAM_INT);
		$update->execute();
		header('Location: users');
	} else {
		Alerts::setFlash("<strong>Les champs ne doivent pas être vide !</strong>", "warning");
	}
}

if (isset($_GET['id_u'])) {
	$id_u = $_GET['id_u'];
	$delete = $bdd->prepare("DELETE FROM users WHERE id_u = :id_u");
	$delete->bindValue('id_u', $id_u, PDO::PARAM_INT);
	$delete->execute();
	header('Location: users');
}

?>
<link rel="stylesheet" type="text/css" href="../assets/css/dark.css">
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3 text-center">Liste des utilisateurs</h1>
		<div class="d-flex justify-content-center mb-3">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-user">
				Ajouter un utilisateur
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
										<th scope="col">Nom</th>
										<th scope="col">Prénom</th>
										<th scope="col">Téléphone</th>
										<th scope="col">Adresse</th>
										<th scope="col">Code postal</th>
										<th scope="col">Adresse email</th>
										<th scope="col">Type</th>
										<th scope="col">Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($users as $user) { ?>
	                                <?php if (isset($_GET['edit'])) { ?>
									<tr>
										<form method="post" action="">
											<td><?= $user['id_u']; ?></td>
											<td>
												<input type="text" name="nom" class="form-control" value="<?= $user['nom']; ?>">
											</td>
											<td>
												<input type="text" name="prenom" class="form-control" value="<?= $user['prenom']; ?>">
											</td>
											<td>
												<input type="tel" name="tel" class="form-control" value="<?= $user['tel']; ?>">
											</td>
											<td>
												<textarea name="adresse" class="form-control"><?= $user['adresse']; ?></textarea>
											</td>
											<td>
												<input type="text" name="cp" class="form-control" value="<?= $user['cp']; ?>">
											</td>
											<td>
												<input type="email" name="email" class="form-control" value="<?= $user['email']; ?>">
											</td>
											<td>
												<?php if ($user['lvl'] == 1) { ?>
												<span class="badge rounded-pill bg-info text-dark text-lg">Élève</span>
												<?php } elseif ($user['lvl'] == 2) { ?>
												<span class="badge rounded-pill bg-primary text-lg">Moniteur</span>
												<?php } elseif($user['lvl'] == 3) { ?>
												<span class="badge rounded-pill bg-danger text-lg">Administrateur</span>
												<?php } ?>
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
										<td><?= $user['id_u']; ?></td>
										<td><?= $user['nom']; ?></td>
										<td><?= $user['prenom']; ?></td>
										<td><?= $user['tel']; ?></td>
										<td><?= $user['adresse']; ?></td>
										<td><?= $user['cp']; ?></td>
										<td><?= $user['email']; ?></td>
										<td>
											<?php if ($user['lvl'] == 1) { ?>
											<span class="badge rounded-pill bg-info text-dark text-lg">Élève</span>
											<?php } elseif ($user['lvl'] == 2) { ?>
											<span class="badge rounded-pill bg-primary text-lg">Moniteur</span>
											<?php } elseif($user['lvl'] == 3) { ?>
											<span class="badge rounded-pill bg-danger text-lg">Administrateur</span>
											<?php } ?>
										</td>
										<td>
											<?php if ($user['lvl'] == 1) { ?>
											<a class="btn btn-primary font-weight-bolder me-2" href="users&edit=<?= $user['id_u']; ?>">
	                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
	  												<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
	  												<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
												</svg>
	                                        </a>
	                                        <a class="btn btn-danger font-weight-bolder" href="users&id_u=<?= $user['id_u']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer cet utilisateur ?'));">
	                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
	  												<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
												</svg>
	                                        </a>
	                                    	<?php } ?>
	                                    	<?php if ($user['lvl'] == 2) { ?>
											<a class="btn btn-primary font-weight-bolder me-2" href="users&edit=<?= $user['id_u'] ?>">
	                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
	  												<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
	  												<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
												</svg>
	                                        </a>
	                                        <a class="btn btn-danger font-weight-bolder" href="users&id_u=<?= $user['id_u'] ?>" onclick="return(confirm('Voulez-vous vraiment supprimer cet utilisateur ?'));">
	                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
	  												<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
												</svg>
	                                        </a>
	                                    	<?php } ?>
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
					<a class="btn btn-lg btn-primary" href="lessons">Voir les cours</a>
				</div>
			</div>
		</div>
	</div>
</main>

<div class="modal fade" id="modal-user" tabindex="-1" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Ajouter un utilisateur</h5>
        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      		</div>
      		<div class="modal-body">
        		<form method="post" action="">
        			<?= $helper->input('nom', 'Nom', 'text'); ?>
					<?= $helper->input('prenom', 'Prénom', 'text'); ?>
					<?= $helper->input('tel', 'Téléphone', 'tel'); ?>
					<?= $helper->textarea('adresse', 'Adresse'); ?>
					<?= $helper->input('cp', 'Code postal', 'text'); ?>
					<?= $helper->input('email', 'Adresse email', 'email'); ?>
					<?= $helper->input('mdp', 'Mot de passe', 'password'); ?>
					<?= $helper->select('type', 'Type', 'lvl', array("1" => "Élève", "2" => "Moniteur")); ?>
					<div class="d-flex justify-content-center mt-4">
	        			<button type="submit" name="add-user" class="btn btn-primary btn-lg">Créer un utilisateur</button>
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
      		'<option value="1">1</option>'+ // Affichage de 1 utilisateur
      		'<option value="5">5</option>'+ // Affichage de 5 utilisateurs, etc...
      		'<option value="10">10</option>'+
      		'<option value="25">25</option>'+
     		'<option value="50">50</option>'+
      		'<option value="-1">100</option>'+ // Affichage de tous les utilisateurs
      		'</select> utilisateurs',
            emptyTable: "Aucune donnée disponible dans le tableau",
    		info: "Affichage de _START_ à _END_ utilisateurs sur _TOTAL_ utilisateurs",
		    search: "Rechercher :",
		    zeroRecords: "Aucun utilisateur trouvé",
		    paginate: {
		        previous: "Précédent",
		        next: "Suivant"
		    }
        }
	});
});
</script>
