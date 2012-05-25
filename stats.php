<?php
include 'includes/header.php';

include ('includes/bdd_connect.php');
connexion ( 'webserv' );

require_once ($_SERVER ['DOCUMENT_ROOT'] . "/class/Statistiques.php");

if (isset ( $_GET ['days'] )) {
	$days = $_GET ['days'];
} else {
	$days = 30;
}
?>

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
		$browserStats = Statistiques::getBrowserStats ( $days );
		echo "['" . $browserStats [0] ['browser'] . "', " . $browserStats [0] ['nbVisites'] . "]";
		for($i = 1; $i < count ( $browserStats ); $i ++) {
			echo ",['" . $browserStats [$i] ['browser'] . "', " . $browserStats [$i] ['nbVisites'] . "]";
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
        data.addColumn('string', 'Plateforme');
        data.addColumn('number', 'Nombre de visites');
        data.addRows([
		<?php
		$platformStats = Statistiques::getPlatformStats ( $days );
		echo "['" . $platformStats [0] ['platform'] . "', " . $platformStats [0] ['nbVisites'] . "]";
		for($i = 1; $i < count ( $platformStats ); $i ++) {
			echo ",['" . $platformStats [$i] ['platform'] . "', " . $platformStats [$i] ['nbVisites'] . "]";
		}
		?>
        ]);

        var options = {
        	legend:{position:'none'}, height:250
        };

        var chart = new google.visualization.PieChart(document.getElementById('camenbert_OS'));
        chart.draw(data, options);
    } 
</script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', 'Nombre de requêtes');
        data.addRows([
        <?php
								$requestStats = Statistiques::getRequestStats ( $days );
								echo "['" . $requestStats [0] ['day'] . "/" . $requestStats [0] ['month'] . "/" . $requestStats [0] ['year'] . "', " . $requestStats [0] ['nbVisites'] . "]";
								for($i = 1; $i < count ( $requestStats ); $i ++) {
									echo ",['" . $requestStats [$i] ['day'] . "/" . $requestStats [$i] ['month'] . "/" . $requestStats [$i] ['year'] . "', " . $requestStats [$i] ['nbVisites'] . "]";
								}
								?>
        ]);

        var options = {
        		width: 570, height: 250, legend:{position:'none'},
                hAxis: {title: 'Date', showTextEvery:1}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_get_monthly'));
        chart.draw(data, options);
    } 

</script>

<div class="container first">
	<div class="row">
		<?php include 'includes/menu.php'; ?>
		<div class="span9">
			<div class="page-header">
				<h1>Statistiques d'utilisation</h1>
			</div>
			<ul class="breadcrumb">
				<li><a href="index2.php">Home</a> <span class="divider">/</span></li>
				<li class="active"><a href="stats.php">Statistiques</a></li>
			</ul>

			<div class="row">
				<div class="span4 pull-right">
					<div class="well">
						<p>Voir ces informations pour :</p>
						<p>
							<a href="stats.php?days=1" class="btn">Aujourd'hui</a> <a
								href="stats.php?days=7" class="btn">7 derniers jours</a> <a
								href="stats.php?days=30" class="btn">30 derniers jours</a>
						</p>
						<p>Ou choisir une durée personalisée (en jours) :</p>
						<form class="" method="get" action="stats.php">
							<input type="text" name="days" class="input-mini" /> <input
								type="submit" class="btn" />
						</form>
					</div>

				</div>
				<div class="span3">
					<h6>Répartition sytèmes d'exploitation</h6>
					<div id="camenbert_OS"></div>

				</div>
			</div>

			<div class="row">
				<div class="span6">
					<h6>Nombre de requêtes de type GET par jour</h6>
					<div id="chart_get_monthly"></div>
				</div>
				<div class="span3">
					<h6>Répartition navigateurs</h6>
					<div id="camenbert_navigateur"></div>
				</div>

			</div>

			<pre>Ouech</pre>

		</div>
	</div>
</div>
<?php
include 'includes/footer.php';
?>
