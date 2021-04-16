<main class="content d-flex p-0">
	<div class="container d-flex flex-column">
		<div class="row h-100">
			<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
				<div class="d-table-cell align-middle mt-4">
					<div class="mt-4">
						<?= Alerts::getFlash(); ?>
					</div>
					<div class="card animate__animated animate__flipInY">
						<div class="card-body">
							<h3 class="text-center">
								<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
  									<path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
								</svg>
							</h3>
							<div class="m-sm-4">
								<form method="post" action="">
									<?= $helper->input('prenom', 'Prénom', 'text'); ?>
									<?= $helper->input('sujet', 'Sujet du message', 'text'); ?>
									<?= $helper->textarea('message', 'Message'); ?>
									<div class="text-center mt-3">
										<button type="submit" name="submit" class="btn btn-lg btn-primary">Envoyer</button>
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
