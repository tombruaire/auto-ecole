<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Bienvenue sur votre tableau de bord, <?= $_SESSION['prenom'] ?> <?= $_SESSION['nom'] ?> !</h1>
		<?= Alerts::getFlash(); ?>
		<div class="row">
			<div class="col-md-3 col-xl-2">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0">Dashboard</h5>
					</div>
					<div class="list-group list-group-flush" role="tablist">
						<a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
          					Informations
        				</a>
						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#edit-nom" role="tab">
          					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
  								<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  								<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
							</svg>
							Nom
        				</a>
						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#edit-prenom" role="tab">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
  								<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  								<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
							</svg>
          					Prénom
        				</a>
						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#edit-tel" role="tab">
          					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
  								<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  								<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
							</svg>
							Téléphone
        				</a>
						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#edit-adresse" role="tab">
          					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
  								<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  								<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
							</svg>
							Adresse
        				</a>
						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#edit-cp" role="tab">
          					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
  								<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  								<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
							</svg>
							Code postal
        				</a>
						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#edit-email" role="tab">
          					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
  								<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  								<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
							</svg>
							Adresse email
        				</a>
						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#edit-mdp" role="tab">
          					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-1" viewBox="0 0 16 16">
  								<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  								<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
							</svg>
							Mot de passe
        				</a>
        				<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#delete-account" role="tab">
          					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x-fill me-1" viewBox="0 0 16 16">
  								<path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
							</svg>
							Supprimer le compte
        				</a>
					</div>
				</div>
			</div>

			<div class="col-md-9 col-xl-10">
				<div class="tab-content">
					
					<div class="tab-pane fade show active" id="account" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0">Vos informations</h5>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-12">
										<div class="table-responsive">
											<table class="table mb-0">
												<thead>
													<tr>
														<th scope="col">
															<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  																<path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
															</svg>
														</th>
														<th scope="col">Informations</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Nom</td>
														<td><?= $_SESSION['nom']; ?></td>
													</tr>
													<tr>
														<td>Prénom</td>
														<td><?= $_SESSION['prenom']; ?></td>
													</tr>
													<tr>
														<td>Téléphone</td>
														<td><?= $_SESSION['tel']; ?></td>
													</tr>
													<tr>
														<td>Adresse</td>
														<td><?= $_SESSION['adresse']; ?></td>
													</tr>
													<tr>
														<td>Code postal</td>
														<td><?= $_SESSION['cp']; ?></td>
													</tr>
													<tr>
														<td>Adresse email</td>
														<td><?= $_SESSION['email']; ?></td>
													</tr>
													<tr>
														<td>Mot de passe</td>
														<td></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="tab-pane fade" id="edit-nom" role="tabpanel">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Modification du nom</h5>
								<form method="post" action="">
									<div class="mb-3">
										<input type="text" name="nom" class="form-control" value="<?= $_SESSION['nom']; ?>" style="max-width: 20rem;">
									</div>
									<div class="alert alert-warning" role="alert">
										<div class="alert-message">
											<strong>Vous serez déconnecté après la modification</strong>
										</div>
									</div>
									<button type="submit" name="subname" class="btn btn-primary">Modifier mon nom</button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="edit-prenom" role="tabpanel">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Modification du prénom</h5>
								<form method="post" action="">
									<div class="mb-3">
										<input type="text" name="prenom" class="form-control" value="<?= $_SESSION['prenom']; ?>" style="max-width: 20rem;">
									</div>
									<div class="alert alert-warning" role="alert">
										<div class="alert-message">
											<strong>Vous serez déconnecté après la modification</strong>
										</div>
									</div>
									<button type="submit" name="subprenom" class="btn btn-primary">Modifier mon prénom</button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="edit-tel" role="tabpanel">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Modification du numéro de téléphone</h5>
								<form method="post" action="">
									<div class="mb-3">
										<input type="tel" name="tel" class="form-control" value="<?= $_SESSION['tel']; ?>" style="max-width: 20rem;">
									</div>
									<div class="alert alert-warning" role="alert">
										<div class="alert-message">
											<strong>Vous serez déconnecté après la modification</strong>
										</div>
									</div>
									<button type="submit" name="subtel" class="btn btn-primary">Modifier mon numéro de téléphone</button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="edit-adresse" role="tabpanel">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Modification de l'adresse</h5>
								<form method="post" action="">
									<div class="mb-3">
										<textarea name="adresse" class="form-control"><?= $_SESSION['adresse']; ?></textarea>
									</div>
									<div class="alert alert-warning" role="alert">
										<div class="alert-message">
											<strong>Vous serez déconnecté après la modification</strong>
										</div>
									</div>
									<button type="submit" name="subadresse" class="btn btn-primary">Modifier mon adresse</button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="edit-cp" role="tabpanel">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Modification du code postal</h5>
								<form method="post" action="">
									<div class="mb-3">
										<input type="text" name="cp" class="form-control" value="<?= $_SESSION['cp']; ?>" style="max-width: 20rem;">
									</div>
									<div class="alert alert-warning" role="alert">
										<div class="alert-message">
											<strong>Vous serez déconnecté après la modification</strong>
										</div>
									</div>
									<button type="submit" name="subcp" class="btn btn-primary">Modifier mon code postal</button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="edit-email" role="tabpanel">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Modification de l'adresse email</h5>
								<form method="post" action="">
									<div class="mb-3">
										<input type="email" name="email" class="form-control" value="<?= $_SESSION['email']; ?>" style="max-width: 20rem;">
									</div>
									<div class="alert alert-warning" role="alert">
										<div class="alert-message">
											<strong>Vous serez déconnecté après la modification</strong>
										</div>
									</div>
									<button type="submit" name="subemail" class="btn btn-primary">Modifier mon adresse email</button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="edit-mdp" role="tabpanel">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Modification du mot de passe</h5>
								<form method="post" action="">
									<div class="mb-3">
										<label for="mdp" class="form-label">Mot de passe actuelle</label>
										<input type="password" name="mdp" id="mdp" class="form-control" style="max-width: 20rem;">
									</div>
									<div class="mb-3">
										<label for="newmdp" class="form-label">Nouveau mot de passe</label>
										<input type="password" name="newmdp" id="newmdp" class="form-control" style="max-width: 20rem;">
									</div>
									<div class="mb-3">
										<label for="newmdp2" class="form-label">Confirmation du nouveau mot de passe</label>
										<input type="password" name="newmdp2" id="newmdp2" class="form-control" style="max-width: 20rem;">
									</div>
									<div class="alert alert-warning" role="alert">
										<div class="alert-message">
											<strong>Vous serez déconnecté après la modification</strong>
										</div>
									</div>
									<button type="submit" name="submdp" class="btn btn-primary">Modifier mon mot de passe</button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="delete-account" role="tabpanel">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Suppression du compte</h5>
								<form method="post" action="">
									<div class="mb-3">
										<label for="email" class="form-label">Adresse email</label>
										<input type="email" name="email" id="email" class="form-control" style="max-width: 20rem;">
									</div>
									<div class="mb-3">
										<label for="mdp" class="form-label">Mot de passe</label>
										<input type="password" name="mdp" id="mdp" class="form-control" style="max-width: 20rem;">
									</div>
									<div class="alert alert-warning" role="alert">
										<div class="alert-message">
											<strong>Vous serez déconnecté après la suppression</strong>
										</div>
									</div>
									<button type="submit" name="subaccount" class="btn btn-danger">Supprimer mon compte</button>
								</form>
							</div>
						</div>
					</div>
				
				</div>
			</div>
		
		</div>
	</div>
</main>