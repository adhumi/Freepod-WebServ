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

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Task');
        data.addColumn('number', 'Hours per Day');
        data.addRows([
          ['Audio',    <?php echo $episodesAudio; ?>],
          ['Vidéo',    <?php echo $episodesVideo; ?>]
        ]);

        var options = {
        	legend:{position:'none'}, height:250
        };

        var chart = new google.visualization.PieChart(document.getElementById('camenbert_audio_video'));
        chart.draw(data, options);
    } 
</script>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Navigateur');
        data.addColumn('number', 'Nombre de visites');
        data.addRows([
		<?php
		$query = "SELECT COUNT(*), browser FROM statistiques GROUP BY browser";
		$rez = mysql_query ( $query );
		
		$row = mysql_fetch_row ( $rez );
		$row = mysql_fetch_row ( $rez );
		echo "['" . $row [1] . "', " . $row [0] . "]";
		while ( $row = mysql_fetch_row ( $rez ) ) {
			echo ",['" . $row [1] . "', " . $row [0] . "]";
		}
		?>
        ]);

        var options = {
        	legend:{position:'none'}, height:250
        };

        var chart = new google.visualization.PieChart(document.getElementById('camenbert_navigateur'));
        chart.draw(data, options);
    } 
</script>

<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Task');
        data.addColumn('number', 'Hours per Day');
        data.addRows([
        <?php
								$query = "SELECT COUNT(*), YEAR(pubDate), MONTH(pubDate) FROM episodes GROUP BY YEAR(PUBDATE), MONTH(pubDate)";
								$rez = mysql_query ( $query );
								
								$row = mysql_fetch_row ( $rez );
								$row = mysql_fetch_row ( $rez );
								echo "['" . $row [2] . "/" . $row [1] . "', " . $row [0] . "]";
								
								$pre_month = $row[2];
								$pre_year = $row[1];
								
								while ( $row = mysql_fetch_row ( $rez ) ) {	
									echo ",['" . $row [2] . "/" . $row [1] . "', " . $row [0] . "]";
									
									$pre_month = $row[2];
									$pre_year = $row[1]; 
								}
								?>
        ]);

        var options = {
        		width: 600, height: 250, legend:{position:'none'},
                hAxis: {title: 'Date', showTextEvery:12}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_historique'));
        chart.draw(data, options);
    } 
</script>

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

			<div class="row">
				<div class="span3">
					<h6>Répartition audio/vidéo</h6>
					<div id="camenbert_audio_video"></div>
				</div>
				<div class="span6">
					<h6>Quantité mensuelle d'émission</h6>
					<div id="chart_historique"></div>
				</div>
			</div>

			<div class="row">
				<div class="span3">
					<h6>Répartition navigateurs</h6>
					<div id="camenbert_navigateur"></div>
				</div>
			</div>
			
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
