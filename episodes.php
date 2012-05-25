<?php
include 'includes/header.php';

include ('includes/bdd_connect.php');
connexion ( 'webserv' );

include ($_SERVER ['DOCUMENT_ROOT'] . "/class/Episode.php");
echo "<br/><br/><br/>";
$episodes = Episode::getEpisodesByPodcasts(0, "pubDate", "DESC");
?>

<div class="container first">
	<div class="row">
		<?php include 'includes/menu.php'; ?>
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
					foreach ( $episodes as $episode ) {
						echo "<tr><td rowspan=\"3\">" . $episode ['id'] . "</td>";
						echo "<td><a href=\"podcast.php?id=" . $episode ['id_podcast'] . "\">" . htmlspecialchars_decode ( $episode ['nom'] ) . "</a><br/>" . $episode ['title'] . "</td>";
						echo "<td>" . $episode ['pubDate'] . "</td>";
						echo "<td rowspan=\"3\"><img src=\"" . $episode ['image'] . "\" class=\"span2\" /></td></tr>";
						echo "<tr><td rowspan=\"2\"><a href=\"" . $episode ['url'] . "\">" . $episode ['type'] . "</a></td>";
						echo "<td>" . $episode ['duration'] . "</td></tr>";
						if ($episode ['explicite'] == "yes" || $episode ['explicite'] == "Yes") {
							echo "<tr><td><span class=\"label label-important\">Explicit</span></td></tr>";
						} elseif ($episode ['explicite'] == "clean" || $episode ['explicite'] == "Clean") {
							echo "<tr><td><span class=\"label label-success\">Clean</span></td></tr>";
						} elseif ($episode ['explicite'] == "no" || $episode ['explicite'] == "No") {
							echo "<tr><td><span class=\"label label-normal\">" . $episode ['explicite'] . "</span></td></tr>";
						} else {
							echo "<tr><td></td></tr>";
						}
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