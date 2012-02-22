<?php
include 'inc-header.php';
?>
<div class="container first">
	<div class="row">
		<?php include 'inc-menu.php'; ?>
		<div class="span9">
			<div class="hero-unit">
				<h1>Freepod admin</h1>
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
						<a href="#" class="btn btn-large">Envoyer une
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
			</div>
		</div>
	</div>
</div>
<?php
include 'inc-footer.php';
?>