<?php
include 'includes/header.php';

include ('includes/bdd_connect.php');
connexion ( 'webserv' );

require_once ($_SERVER ['DOCUMENT_ROOT'] . "/class/Podcast.php");

$podcastsList = Podcast::getPodcasts ();
?>

<div class="container first">
	<div class="row">
		<?php include 'includes/menu.php'; ?>
		<div class="span9">
			<?php if (isset($_GET['success_sync'])) { ?>
			<div class="alert alert-success alert-block">
				<a class="close" data-dismiss="alert">×</a>
				<h4 class="alert-heading">Terminé</h4>
				La synchronisation a été effectuée correctement. Inutile de reproduire l'opération.
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
				<a href="http://webserv.freepod.net/sync.php" class="btn btn-large">
					<i class="icon-repeat"></i> Tout synchroniser
				</a> 
				<a href="http://webserv.freepod.net/podcast-new.php" class="btn btn-large">
					<i class="icon-plus"></i> Ajouter un podcast
				</a>
				<div class="btn-group pull-right">
					<a href="podcasts.php" class="btn<?php if(!isset($_GET['grille'])) echo " disabled"; ?>">
						<i class="icon-list"></i>
					</a>
					<a href="podcasts.php?grille" class="btn<?php if(isset($_GET['grille'])) echo " disabled"; ?>">
						<i class="icon-th"></i>
					</a>
				</div>
			</div>
			<?php if(!isset($_GET['grille'])) { ?>
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
				foreach ( $podcastsList as $podcast ) {
					echo "<tr><td>" . $podcast ['id'] . "</td>";
					echo "<td><a href=\"podcast.php?id=" . $podcast ['id'] . "\">" . $podcast ['nom'] . "</a> ";
					if (isset($podcast ['new']) && $podcast ['new'] == "yes") {
						echo "<span class=\"label label-success\">new</span>";
					}
					echo "</td>";
					echo "<td>" . $podcast ['url_flux'] . "</td>";
					echo "<td>" . $podcast ['lastUpdate'] . "</td>";
					echo "<td><center><a href=\"podcast-edit.php?id=" . $podcast ['id'] . "\" class=\"btn btn-mini\"><i class=\"icon-cog\"></i></a>";
					echo " <a href=\"sync.php?id=" . $podcast ['id'] . "\" class=\"btn btn-mini\"><i class=\"icon-repeat\"></i></a></center></td></tr>";
				}
				?>
				</tbody>
			</table>
			<?php } else { ?>
			<div class="alert alert-info">
				<a class="close" data-dismiss="alert">×</a>
				Cliquez sur un podcast pour afficher des informations détaillées.    
   			</div>
			<ul class="thumbnails">
				<?php
				foreach ( $podcastsList as $podcast ) {
					echo "<li class=\"span3\">";
					echo "<a href=\"podcast.php?id=" . $podcast ['id'] . "\" class=\"thumbnail\" ><img src=\"" . $podcast ['logo_normal'] . "\" alt=\"". $podcast ['nom'] ."\"></a>";
					echo " </li>";
				}
				?>
			</ul>
			<?php } ?>
		</div>
	</div>
</div>
<?php include 'includes/footer.php'; ?>