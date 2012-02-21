<?php
include 'inc-header.php';
?>

<div class="container first">
	<div class="row">
		<div class="span3 wall">
			<ul class="nav nav-list">
				<li><a href="index2.php"><i class="icon-home"></i>Home</a></li>

				<li class="nav-header">Outils</li>
				<li><a href="podcasts.php"><i
						class="icon-th-list"></i> Tous les podcasts</a></li>
				<li class="active"><a href="episodes.php"><i class="icon-music icon-white"></i> Tous les
						&eacute;pisodes</a></li>
				<li><a href="#"><i class="icon-plus"></i> Ajout d'un podcast</a></li>
				<li><a href="#"><i class="icon-signal"></i> Statistiques</a></li>
			</ul>
		</div>
		<div class="span9">
			<div class="page-header">
				<h1>Tous les &eacute;pisodes</h1>
			</div>
			<ul class="breadcrumb">
				<li><a href="index2.php">Home</a> <span class="divider">/</span></li>
				<li class="active"><a href="episodes.php">Tous les &eacute;pisodes</a></li>
			</ul>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<!-- <th>Podcast</th> -->
						<th>Nom</th>
						<th>Date</th>
						<th>Image</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include ('bdd_connect.php');
					connexion ( 'webserv' );
					
					$query = "SELECT e.id, e.id_podcast, e.title, e.url, e.type, e.description, e.pubDate, e.author, e.explicite, e.duration, e.image, e.keywords, p.nom FROM episodes AS e, podcasts AS p WHERE e.id_podcast = p.id ORDER BY pubdate DESC";
					$result = mysql_query ( $query );
					
					while ( $row = mysql_fetch_row ( $result ) ) {
						echo "<tr><td rowspan=\"3\">" . $row [0] . "</td>";
						echo "<td><a href=\"podcast.php?id=" . $row[1] . "\">" . htmlspecialchars_decode($row [12]) . "</a><br/>" . $row [2] . "</td>";
						echo "<td>" . $row [6] . "</td>";
						echo "<td rowspan=\"3\"><img src=\"" . $row [10] . "\" class=\"span2\" /></td></tr>";
						echo "<tr><td rowspan=\"2\">" . $row [3] . "</td>";
						echo "<td>" . $row [9] . "</td></tr>";
						if ($row[8] == "yes" || $row[8] == "Yes") {
							echo "<tr><td><span class=\"label label-important\">Explicit</span></td></tr>";
						} elseif ($row[8] == "no" || $row[8] == "No") {
							echo "<tr><td><span class=\"label label-success\">Clean</span></td></tr>";
						} else {
							echo "<tr><td><span class=\"label label-warning\">" . $row[8] . "</span></td></tr>";
						}
					}
					?>
				</tbody>
			</table>

		</div>
	</div>
</div>
</body>
</html>