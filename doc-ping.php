<?php
include 'inc-header.php';
?>
<div class="container first">
	<div class="row">
		<?php include 'inc-menu.php'; ?>
		<div class="span9">
			<div class="page-header">
				<h1>Méthodes Ping</h1>
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
					<h6>/sync.php?id=ID_PODCAST</h6>
					<p>Permet la synchronisation de la base de données avec les flux
						RSS des podcasts. Cette action n'est pas autorisée par une clé API
						standard.</p>
				</div>
				<div class="span3">
					
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
