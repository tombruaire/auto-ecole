<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Bienvenue sur votre messagerie</h1>
		<?= Alerts::getFlash(); ?>
		<div class="d-flex justify-content-center mb-3">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#send-msg">
  				Envoyer un message
			</button>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<div class="table-responsive">
							<table class="table mb-0">
								<thead>
									<tr>
										<th scope="col">Message de</th>
										<th scope="col">Message</th>
										<th scope="col">Lu</th>
										<td scope="col"></td>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($messages as $message) { ?>
									<tr>
										<td>
											<?php if ($message['lu'] == 0) { ?>
											<b>M. <?= $message['id_exp']; ?></b>
											<?php } else { ?>
											M. <?= $message['id_exp']; ?>
											<?php } ?>
										</td>
										<td>
											<?php if ($message['lu'] == 0) { ?>
											<b><?= $message['contenu']; ?></b>
											<?php } else { ?>
											<?= $message['contenu']; ?>
											<?php } ?>
										</td>
										<td>
											<?php if ($message['lu'] == 0) { ?>
											<b>Non lu</b>
											<?php } else { ?>
											Lu
											<?php } ?>
										</td>
										<td>
											<?php if ($message['lu'] == 0) { ?>
											<a class="btn btn-primary me-2" href="answer">Répondre</a>
											<?php } else { ?>
											<a class="btn btn-secondary me-2" href="answer">Répondre</a>
											<?php } ?>
											<a class="btn btn-danger font-weight-bolder" href="messages&id_exp=<?= $message['id_exp']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer ce message ?'));">Supprimer</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			<form method="post" action="">
				<button type="submit" name="delete" class="btn btn-danger fs-lg mb-3" onclick="return(confirm('Voulez-vous vraiment supprimer tous les messages ?'));">
					Supprimer tous les messages
				</button>
			</form>
		</div>
	</div>
</main>

<div class="modal fade" id="send-msg" tabindex="-1" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Envoyer un message</h5>
        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      		</div>
      		<?php if (isset($_SESSION['id_u']) && $_SESSION['lvl'] == 1) { ?>
      		<form method="post" action="">
	      		<div class="modal-body">
	        		<div class="mb-3">
	        			<label for="destinataire" class="form-label">Moniteur</label>
                        <select name="id_dest" id="destinatairee" class="form-select">
                            <?php $requete = $bdd->query("SELECT * FROM users WHERE lvl = 2");
                            $lesMoniteurs = $requete->fetchAll();
                            foreach ($lesMoniteurs as $unMoniteur) { ?>
                            <option value="<?= $unMoniteur['id_u']; ?>">M. <?= $unMoniteur['nom']; ?></option>
                            <?php } ?>
                        </select>
	        		</div>
	        		<div class="mb-3">
	        			<label for="editor" class="form-label">Message</label>
	        			<textarea name="contenu" id="editor" rows="10" class="form-control"></textarea>
	        		</div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
	        		<button type="submit" name="subeleves" class="btn btn-primary">Envoyer</button>
	      		</div>
	      	</form>
	      	<?php } elseif (isset($_SESSION['id_u']) && $_SESSION['lvl'] == 2) { ?>
	      	<form method="post" action="">
	      		<div class="modal-body">
	        		<div class="mb-3">
	        			<label for="destinataire" class="form-label">Élève</label>
                        <select name="id_dest" id="destinatairee" class="form-select">
                            <?php $requete = $bdd->query("SELECT * FROM users WHERE lvl = 1");
                            $lesEleves = $requete->fetchAll();
                            foreach ($lesEleves as $unEleve) { ?>
                            <option value="<?= $unEleve['id_u']; ?>">M. <?= $unEleve['nom']; ?></option>
                            <?php } ?>
                        </select>
	        		</div>
	        		<div class="mb-3">
	        			<label for="editor" class="form-label">Message</label>
	        			<textarea name="contenu" id="editor" rows="10" class="form-control"></textarea>
	        		</div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
	        		<button type="submit" name="subeleves" class="btn btn-primary">Envoyer</button>
	      		</div>
	      	</form>
	      	<?php } ?>
    	</div>
  	</div>
</div>