<!DOCTYPE html>
<html lang="en">
<head>
	<title>auto-ecole.fr</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/dark.css"> -->
	<link rel="stylesheet" type="text/css" href="assets/css/light.css">
	<link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<script src="assets/js/main.js"></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-light landing-navbar">
	<div class="container">
		<a class="navbar-brand landing-brand" href="http://localhost/auto-ecole/">auto-ecole.fr</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      		<span class="navbar-toggler-icon"></span>
    	</button>
    	<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ms-auto">
				<li class="nav-item">
					<a class="nav-link text-lg px-lg-3" href="http://localhost/auto-ecole/home">Accueil</a>
				</li>
				<?php if (isset($_SESSION['id_u']) && $_SESSION['lvl'] == 2) { ?>
				<li class="nav-item">
					<a class="nav-link text-lg px-lg-3" href="http://localhost/auto-ecole/lessons">Cours</a>
				</li>
				<?php } ?>
				<li class="nav-item">
					<a class="nav-link text-lg px-lg-3" href="http://localhost/auto-ecole/contact">Contact</a>
				</li>
				<?php if (!isset($_SESSION['id_u'])) { ?>
				<li class="nav-item">
					<a class="nav-link btn btn-success text-light me-2" href="signup">Inscription</a>
				</li>
				<li class="nav-item">
					<a class="nav-link btn btn-primary text-light" href="signin">Connexion</a>
				</li>
				<?php } ?>
			</ul>
			<?php if (isset($_SESSION['id_u'])) { ?>
			<div class="flex-shrink-0 dropdown">
        		<a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
          			<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  						<path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
					</svg>
        		</a>
        		<ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
          			<li>
          				<a class="dropdown-item" href="profil">Profil</a>
          			</li>
          			<?php 
          			$show_msg = $bdd->query("SELECT COUNT(*) FROM messages WHERE lu = 0 AND id_dest = '".$_SESSION['id_u']."'");
					$nb_msg = $show_msg->rowCount();
					?>
          			<li>
          				<a class="dropdown-item" href="messages">Messages <span class="badge bg-primary"><?= $nb_msg; ?></span></a>
          			</li>
          			<li><hr class="dropdown-divider"></li>
          			<li>
          				<a class="dropdown-item" href="logout">Déconnexion</a>
          			</li>
        		</ul>
      		</div>
			<?php } elseif (isset($_SESSION['id_u']) && $_SESSION['lvl'] == 3) { ?>
      		<a class="btn btn-danger active" href="logout">DÉCONNEXION</a>
      		<?php } ?>
		</div>
	</div>
</nav>

<?= $contents; ?>

<section class="landing-footer py-6">
	<div class="container landing-footer-container text-center">
		<div class="row">
			<div class="col-12 col-md-9 col-lg-8 col-xl-6 mx-auto">
				<p class="text-center mb-3">Copyright &copy; 2021 - Tom, Lucas et Ruben</p>
			</div>
		</div>
	</div>
</section>
	
<script src="assets/js/app.js"></script>
<script>
ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
        console.error( error );
    } );
</script>

</body>
</html>