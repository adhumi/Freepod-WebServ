<?php
include 'includes/header.php';

include ('includes/bdd_connect.php');
connexion ( 'webserv' );

require_once ($_SERVER ['DOCUMENT_ROOT'] . "/class/Podcast.php");

$podcastsList = Podcast::getPodcasts();
?>

<div class="container first">
	<div class="row">
		<?php include 'includes/menu.php'; ?>
		<div class="span9">
			<?php if (isset($_GET['success_sync'])) { ?>
			<div class="alert alert-success alert-block">
				<a class="close" data-dismiss="alert">×</a>
				<h4 class="alert-heading">Terminé</h4>
				La synchronisation a été effectuée correctement. Inutile de
				reproduire l'opération.
			</div>
			<?php } ?>
			<div class="page-header">
				<h1>Tous les podcasts</h1>
			</div>
			<ul class="breadcrumb">
				<li><a href="index2.php">Home</a> <span class="divider">/</span></li>
				<li class="active"><a href="podcasts.php">Tous les podcasts</a></li>
			</ul>
			<div class="btn-toolbar">
				<a href="http://webserv.freepod.net/sync.php" class="btn btn-large"><i class="icon-repeat"></i> Tout
					synchroniser</a>
				<a href="http://webserv.freepod.net/podcast-new.php" class="btn btn-large"><i class="icon-plus"></i> Ajouter un podcast</a>
			</div>
	
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Nom</th>
						<th>URL Podcast</th>
						<th>Dernière MAJ</th>
						<th>Outils</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($podcastsList as $podcast) {
						echo "<tr><td>" . $podcast ['id'] . "</td>";
						echo "<td><a href=\"podcast.php?id=" . $podcast ['id'] . "\">" .$podcast ['nom'] . "</a></td>";
						echo "<td>" . $podcast ['url_flux'] . "</td>";
						echo "<td>" . $podcast ['lastUpdate'] . "</td>";
						echo "<td><center><a href=\"podcast-edit.php?id=" . $podcast ['id'] . "\" class=\"btn btn-mini\"><i class=\"icon-cog\"></i></a>";
						echo " <a href=\"sync.php?id=" . $podcast ['id'] . "\" class=\"btn btn-mini\"><i class=\"icon-repeat\"></i></a></center></td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php
include 'includes/footer.php';
?>