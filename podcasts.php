<?php
include 'inc-header.php';
?>

<div class="container first">
	<div class="row">
		<div class="span3 wall">
			<ul class="nav nav-list">
				<li><a href="index2.php"><i class="icon-home"></i>Home</a></li>

				<li class="nav-header">Outils</li>
				<li class="active"><a href="podcasts.php"><i
						class="icon-th-list icon-white"></i> Tous les podcasts</a></li>
				<li><a href="episodes.php"><i class="icon-music"></i> Tous les
						&eacute;pisodes</a></li>
				<li><a href="#"><i class="icon-plus"></i> Ajout d'un podcast</a></li>
				<li><a href="#"><i class="icon-signal"></i> Statistiques</a></li>
			</ul>
		</div>
		<div class="span9">
			<div class="page-header">
				<h1>Tous les podcasts</h1>
			</div>
			<ul class="breadcrumb">
				<li><a href="index2.php">Home</a> <span class="divider">/</span></li>
				<li class="active"><a href="podcasts.php">Tous les podcasts</a></li>
			</ul>
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
</body>
</html>