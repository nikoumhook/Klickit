<!DOCTYPE html>
	<html lang="fr">
		<head>
			<meta charset="UTF-8">
			<title><?= $this->e($title) ?></title>

			<link href="https://fonts.googleapis.com/css?family=Advent+Pro|Roboto:400,700" rel="stylesheet">

			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
			<link rel="stylesheet" href="<?= $this->assetUrl('css/styleback.css') ?>">
		</head>

		<body>
			<div class="cont">
				<header>

					<nav class="navbar navbar-default">
					      <div class="container">
					        <!-- Brand and toggle get grouped for better mobile display -->
					        <div class="navbar-header">
					          <a class="navbar-brand" href="#">Klick it</a>
					        </div>
					        <div class="navbar-right">
						        <ul>
						        	<li>Bonjour <?php  ?></li>
						        	<li><a href="">Se déconnecter</a></li>
						        </ul>
					        </div>
					      </div><!-- /.container -->
					    </nav><!-- /.navbar -->
					  

				<!-- MENU NAVIGATION -->
					<div class="container-fluid">
					    <!-- Second navbar for categories -->
					    <nav class="navbar navbar-default">
					      <div class="container">		     
					    	
					        <!-- Collect the nav links, forms, and other content for toggling -->
					        <div class="collapse navbar-collapse" id="navbar-collapse-1">
					          <ul class="nav navbar-nav navbar-right">

					            <li><a href="#">Accueil</a></li>
					            <li><a href="#">Admin</a></li>
					            <li><a href="#">Utilisateur</a></li>
					            <li><a href="#">Message</a></li>
					            <li><a href="#">Evènement</a></li>
					            <li><a href="#">Slide</a></li>
					            <li><a href="#">Article</a></li>
					            <li><a href="#">Commande</a></li>
					            <li><a href="#">Option d'envoi</a></li>
					            <li><a href="#">Livre d'Or</a></li>
					          </ul>
					        </div><!-- /.navbar-collapse -->
					      </div><!-- /.container -->
					    </nav><!-- /.navbar -->
					</div><!-- /.container-fluid -->

					
				</header>

				<div class="container">

					<section>
						<?= $this->section('main_content') ?>
					</section>
				</div>

				<footer>
				</footer>
			</div>
		</body>
	</html>