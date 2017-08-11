<?php
include( 'views/header2.php' );
$db->pfx='';
?>
<div class =container>
<ul class="nav nav-tabs">
  <li role="presentation"><a href="../coba">Data Caption</a></li>
  <li role="presentation"><a href="../chartt">Topic by Gender</a></li>
  <li role="presentation"><a href="../region">Topic by Region</a></li>
  <li role="presentation" class="active"><a href="../periode2">Topic by Period</a></li>
  <li role="presentation"><a href="../wordcloud">Word Cloud</a></li>
  <li role="presentation"><a href="../mapping">Pembagian Wilayah</a></li>
   </ul>
  <br>
<html>
				<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<title>Highcharts Example</title>

					<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
					<style type="text/css">
						${demo.css}
					</style>
					<?php
					$c1 = $db->r( 'topik', '*' );
					foreach( $c1 as $r1 ) {
						$cat_name[] = "'" . $r1['kategori_topik'] . "'";
					}
					?>
					<div class = 'container'>
					<div class="btn-group" role="group" aria-label="...">
					  <button type="button" class="btn btn-default"><a href="../periode2">Topik 2</button></a>
					  <button type="button" class="btn btn-default"><a href="../periode3">Topik 3</button></a>
					  <button type="button" class="btn btn-default"><a href="../periode4">Topik 4</button></a>
					  <button type="button" class="btn btn-default"><a href="../periode5">Topik 5</button></a>
					</div></button></button></button></button></div></div>
					<script type="text/javascript">
						$(function () {
							$('#container').highcharts({
								chart: {
									type: 'column'
								},
								title: {
									text: 'Jumlah caption'
								},
								xAxis: {
									categories: [<?= implode( ',', $cat_name ) ?>] 
								},
								yAxis: {
									min: 0,
									title: {
										text: 'Analisa Hasil Tweet'
									},
									stackLabels: {
										enabled: true,
										style: {
											fontWeight: 'bold',
											color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
										}
									}
								},
								legend: {
									align: 'right',
									x: -30,
									verticalAlign: 'top',
									y: 25,
									floating: true,
									backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
									borderColor: '#CCC',
									borderWidth: 1,
									shadow: false
								},
								tooltip: {
									headerFormat: '<b>{point.x}</b><br/>',
									pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
								},
								plotOptions: {
									column: {
										stacking: 'normal',
										depth: 400
									}
								},
								<?php
									$db->pfx='';	
									$Jan = [0];	
									$Feb = [0];	
									$Mar = [0];	
									$Apr = [0];	
									$May = [0];	
									$Jun = [0];	
									$Jul = [0];	
									$Aug = [0];	
									$Sep = [0];	
									$Oct = [0];	
									$Nov = [0];	
									$Dec = [0];	
										
									$f2 = $db->r( 'caption_bot c, username u, cluster_5 l, periode p', 'count(id) as n, month, year,topik', 'where year = 17 and c.oleh = u.username and c.id = l.id_caption and p.id_timepost=c.id group by topik, year, month');
									foreach ($f2 as $r2) {
										if ( $r2['month'] == 'Jan' ) $Jan[$r2['topik']] = $r2['n'];
										if ( $r2['month'] == 'Feb' ) $Feb[$r2['topik']] = $r2['n'];
										if ( $r2['month'] == 'Mar' ) $Mar[$r2['topik']] = $r2['n'];
										if ( $r2['month'] == 'Apr' ) $Apr[$r2['topik']] = $r2['n'];
										if ( $r2['month'] == 'May' ) $May[$r2['topik']] = $r2['n'];
										if ( $r2['month'] == 'Jun' ) $Jun[$r2['topik']] = $r2['n'];
										if ( $r2['month'] == 'Jul' ) $Jul[$r2['topik']] = $r2['n'];
										if ( $r2['month'] == 'Aug' ) $Aug[$r2['topik']] = $r2['n'];
										if ( $r2['month'] == 'Sep' ) $Sep[$r2['topik']] = $r2['n'];
										if ( $r2['month'] == 'Oct' ) $Oct[$r2['topik']] = $r2['n'];
										if ( $r2['month'] == 'Nov' ) $Nov[$r2['topik']] = $r2['n'];
										if ( $r2['month'] == 'Dec' ) $Dec[$r2['topik']] = $r2['n'];
										
										}		
										//		echo implode( '|', $keys );
								?> 
						
								series: [{
									name: 'Jan',
									data: [<?= implode(',',$Jan)?>],
									stack: 'tweet'
						
								},
								{
									name: 'Feb',
									data: [<?= implode(',',$Feb)?>],
									stack: 'tweet'
						
								},
								{
									name: 'Mar',
									data: [<?= implode(',',$Mar)?>],
									stack: 'tweet'
								},
								{
									name: 'Apr',
									data: [<?= implode(',',$Apr)?>],
									stack: 'tweet'
								},
								{
									name: 'May',
									data: [<?= implode(',',$May)?>],
									stack: 'tweet'
								},
								{
									name: 'Jun',
									data: [<?= implode(',',$Jun)?>],
									stack: 'tweet'
								},
								{
									name: 'Jul',
									data: [<?= implode(',',$Jul)?>],
									stack: 'tweet'
								},
								{
									name: 'Aug',
									data: [<?= implode(',',$Aug)?>],
									stack: 'tweet'
								},
								{
									name: 'Sep',
									data: [<?= implode(',',$Sep)?>],
									stack: 'tweet'
								},
								{
									name: 'Oct',
									data: [<?= implode(',',$Oct)?>],
									stack: 'tweet'
								},
								{
									name: 'Nov',
									data: [<?= implode(',',$Nov)?>],
									stack: 'tweet'
								},
								{
									name: 'Dec',
									data: [<?= implode(',',$Dec)?>],
									stack: 'tweet'
								}]
							});
						});


					</script>
				</head>
				<body>


					<script src="https://code.highcharts.com/highcharts.js"></script>
					<script src="https://code.highcharts.com/highcharts-3d.js"></script>
					<script src="https://code.highcharts.com/modules/exporting.js"></script>

					<div id="container" style="height: 500px"></div>
						<div class="panel-body text-left">
						
					</div>
				
	

 