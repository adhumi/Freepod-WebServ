<?php
include 'inc-header.php';
?>

<div class="container first">
	<div class="row">
		<?php include 'inc-menu.php'; ?>
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
				<a href="http://webserv.freepod.net/sync.php" class="btn btn-large">Tout
					synchroniser</a>
			</div>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Nom</th>
						<th>URL Podcast</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include ('bdd_connect.php');
					connexion ( 'webserv' );
					
					$query = "SELECT * FROM podcasts";
					$result = mysql_query ( $query );
					
					while ( $row = mysql_fetch_row ( $result ) ) {
						echo "<tr><td>" . $row [0] . "</td>";
						echo "<td><a href=\"podcast.php?id=" . $row [0] . "\">" . $row [1] . "</a></td>";
						echo "<td>" . $row [2] . "</td>";
						echo "<td><center><a href=\"podcast-edit.php?id=" . $row [0] . "\"><i class=\"icon-cog\"></i></a></center></td></tr>";
					}
					?>
				</tbody>
			</table>

		</div>
	</div>
</div>
<?php
include 'inc-footer.php';
?>