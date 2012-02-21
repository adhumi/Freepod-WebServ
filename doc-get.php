<?php
include 'inc-header.php';
?>
<div class="container first">
	<div class="row">
		<?php include 'inc-menu.php'; ?>
		<div class="span9">
			<div class="page-header">
				<h1>Méthodes GET</h1>
			</div>
			<div class="row">
				<div class="span9">
					<h3>Principes de fonctionnement</h3>
					<p>Permet de récupérer un json avec la liste des podcasts et leurs
						caractéristiques. Triés et identifiés par un id unique.</p>
						
					<h3>Méthodes</h3>
				</div>
			</div>
			<div class="row">
				<div class="span3">
					<h6>/get.php?podcasts&key=API_KEY</h6>
					<p>Permet de récupérer un json avec la liste des podcasts et leurs
						caractéristiques. Triés et identifiés par un id unique.</p>
				</div>
				<div class="span3">
					<h6>/get.php?episodes=ID_PODCAST&key=API_KEY</h6>
					<p>Permet de récupérer un json avec la liste des épisodes du
						podcasts (ID donné dans l'URL) et leurs caractéristiques. Triés et
						identifiés par un id unique.</p>
				</div>
				<div class="span3">
					
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php
include 'inc-footer.php';
?>
