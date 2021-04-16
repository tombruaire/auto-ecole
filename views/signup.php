<main class="content d-flex p-0">
	<div class="container d-flex flex-column">
		<div class="row h-100">
			<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
				<div class="d-table-cell align-middle mt-4">
					<div class="mt-4">
						<?= Alerts::getFlash(); ?>
					</div>
					<div class="card animate__animated animate__fadeInUp">
						<div class="card-body">
							<h3 class="text-center">
								<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
  									<path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
  									<path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
								</svg>
							</h3>
							<div class="m-sm-4">
								<form method="post" action="">
									<?= $helper->input('nom', 'Nom', 'text'); ?>
									<?= $helper->input('prenom', 'Prénom', 'text'); ?>
									<?= $helper->input('tel', 'Téléphone', 'tel'); ?>
									<?= $helper->textarea('adresse', 'Adresse'); ?>
									<?= $helper->input('cp', 'Code postal', 'text'); ?>
									<?= $helper->input('email', 'Adresse email', 'email'); ?>
									<?= $helper->input('mdp', 'Mot de passe', 'password'); ?>
									<?= $helper->input('mdp2', 'Confirmation du mot de passe', 'password'); ?>
									<div class="text-center mt-3">
										<button type="submit" name="register" class="btn btn-lg btn-primary">Créer un compte</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
