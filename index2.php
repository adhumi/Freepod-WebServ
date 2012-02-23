<?php
include 'includes/header.php';
?>
<div class="container first">
	<div class="row">
		<?php include 'includes/menu.php'; ?>
		<div class="span9">
			<?php if (isset($_GET['feedback_success'])) { ?>
			<div class="alert alert-success alert-block">
				<a class="close" data-dismiss="alert">×</a>
				<h4 class="alert-heading">Terminé</h4>
				Votre message a été correctement envoyé.
			</div>
			<?php } ?>
			
			<div class="hero-unit">
				<h1>Admin Freepod</h1>
				<p>Bienvenue dans l'espace d'administration des applications
					Freepod.</p>
			</div>
			<div class="row">
				<div class="span3">
					<div class="thumbnail">
							<a href="podcasts.php"> <img src="img/podcasts.jpg" alt="" />
							</a>
							<div class="caption">
						<a href="podcasts.php" class="btn btn-large">Gérer
							les podcasts</a>
						</div>
					</div>
				</div>
				<div class="span3">
					<div class="thumbnail">
							<a href="#"> <img src="img/notif.jpg" alt="" />
							</a>
						<div class="caption">
						<a href="#" class="btn btn-large disabled" onclick="return false;">Envoyer une
							notification</a></div>
					</div>
				</div>
				<div class="span3">
					<div class="thumbnail">
							<a href="stats.php"> <img src="img/stats.jpg" alt="" />
							</a>
						<div class="caption">
						<a href="stats.php" class="btn btn-large">Voir les
							statistiques</a></div>
					</div>
				</div>
				<?php //echo json_last_error (); ?>
			</div>
		</div>
	</div>
</div>
<?php
include 'includes/footer.php';
?>