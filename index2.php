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
						<p>
							<a href="podcasts.php"> <img src="img/podcasts.jpg" alt="" />
							</a>
						</p>
						<a href="podcasts.php" class="btn btn-info btn-large span2">Gérer
							les podcasts</a>
						<div class="clear"></div>
					</div>
				</div>
				<div class="span3">
					<div class="thumbnail">
						<p>
							<a href="#"> <img src="img/notif.jpg" alt="" />
							</a>
						</p>
						<a href="#" class="btn btn-info btn-large span2">Envoyer une
							notification</a>
						<div class="clear"></div>
					</div>
				</div>
				<div class="span3">
					<div class="thumbnail">
						<p>
							<a href="#"> <img src="img/stats.jpg" alt="" />
							</a>
						</p>
						<a href="#" class="btn btn-info btn-large span2">Voir les
							statistiques</a>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include 'inc-footer.php';
?>