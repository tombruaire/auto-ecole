<?php

if (isset($_SESSION['id_u'])) {
	header('Location: admin-panel/users');
	exit();
}

if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$mdp = sha1($_POST['mdp']);
	if ($email != "" && $mdp != "") {
		$user = $bdd->prepare("SELECT * FROM users WHERE email = :email AND mdp = :mdp");
		$user->bindValue(':email', $email, PDO::PARAM_STR);
		$user->bindValue(':mdp', $mdp, PDO::PARAM_STR);
		$user->execute();
		$user = $user->fetch();
		if ($user) {
			$session->setVar('id_u', $user['id_u']);
			$session->setVar('nom', $user['nom']);
            $session->setVar('prenom', $user['prenom']);
            $session->setVar('tel', $user['tel']);
            $session->setVar('adresse', $user['adresse']);
            $session->setVar('cp', $user['cp']);
            $session->setVar('email', $user['email']);
           	$session->setVar('lvl', $user['lvl']);
           	if ($user['lvl'] == 1) {
           		Alerts::setFlash("<strong>Vous n'avez pas la permission d'accéder !</strong>", "danger");
           	} elseif ($user['lvl'] == 2) {
           		Alerts::setFlash("<strong>Vous n'avez pas la permission d'accéder !</strong>", "danger");
           	} elseif ($user['lvl'] == 3) {
           		header('Location: admin-panel/users');
           	}
		} else {
			Alerts::setFlash("Identifiants incorrect !", "danger");
		}
	} else {
		Alerts::setFlash("Veuillez compléter tous les champs !", "warning");
	}
}

?>

<main class="content d-flex p-0">
	<div class="container d-flex flex-column">
		<div class="row h-100">
			<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
				<div class="d-table-cell align-middle mt-4">
					<div class="mt-4">
						<?= Alerts::getFlash(); ?>
					</div>
					<div class="card animate__animated animate__bounceInUp">
						<div class="card-body">
							<h3 class="text-center">
								<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  									<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  									<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
								</svg>
							</h3>
							<div class="m-sm-4">
								<form method="post" action="">
									<div class="mb-3">
										<label for="email" class="form-label">Adresse email</label>
										<input type="email" name="email" id="email" class="form-control">
									</div>
									<div class="mb-3">
										<label for="mdp" class="form-label">Mot de passe</label>
										<input type="password" name="mdp" id="mdp" class="form-control">
									</div>
									<div class="text-center mt-3">
										<button type="submit" name="login" class="btn btn-lg btn-primary">Connexion</button>
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
