<?php
include 'inc-header.php';

include ('bdd_connect.php');
connexion ( 'webserv' );

$totalEpisodes = 0;
$episodesAudio = 0;

$query = "SELECT COUNT(*) FROM episodes";
$rez = mysql_query ( $query );
while ( $row = mysql_fetch_row ( $rez ) ) {
	$totalEpisodes = $row [0];
}

$query = "SELECT COUNT(*) FROM episodes WHERE type LIKE 'audio%'";
$rez = mysql_query ( $query );
while ( $row = mysql_fetch_row ( $rez ) ) {
	$episodesAudio = $row [0];
}

$episodesVideo = $totalEpisodes - $episodesAudio;
?>

<div class="container first">
	<div class="row">
		<?php include 'inc-menu.php'; ?>
		<div class="span9">
			<div class="page-header">
				<h1>Statistiques (en test)</h1>
			</div>
			<ul class="breadcrumb">
				<li><a href="index2.php">Home</a> <span class="divider">/</span></li>
				<li class="active"><a href="stats.php">Statistiques</a></li>
			</ul>
			
			<h6>API à utiliser pour les graphs</h6>
			<pre>http://code.google.com/apis/chart/interactive/docs/gallery/columnchart.html</pre>

			<h6>Quelques tests de statistiques "basiques"</h6>
			<pre>Total : <?php echo $totalEpisodes; ?></pre>
			<pre>Audio : <?php echo $episodesAudio; ?></pre>
			<pre>Vidéo : <?php echo $episodesVideo; ?></pre>

			<h6>Tests de récupérations d'infos du client</h6>
			<?php
				require_once ($_SERVER ['DOCUMENT_ROOT'] . "/class/Statistiques.php");
				Statistiques::printClientStats($_SERVER ['HTTP_ACCEPT_LANGUAGE'], $_SERVER ['HTTP_CONNECTION'], $_SERVER ['HTTP_REFERER'], $_SERVER ['HTTP_USER_AGENT'], $_SERVER ['REMOTE_ADDR'], $_SERVER ['SCRIPT_NAME'])
			?>
			<pre>Documentation : http://alexandre.alapetite.fr/doc-alex/php-local-browscap/index.fr.html</pre>
		</div>
	</div>
</div>
<?php
include 'inc-footer.php';
?>
