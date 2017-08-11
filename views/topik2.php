<?php
include( 'views/header2.php' );

$db->pfx='';
?>
<div class =container>
<ul class="nav nav-tabs">
  <li role="presentation"><a href="../coba">Data Caption</a></li>
  <li role="presentation" class="active"><a href="../chartt">Topic by Gender</a></li>
  <li role="presentation"><a href="../region">Topic by Region</a></li>
  <li role="presentation"><a href="../periode2">Topic by Period</a></li>
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
					  <button type="button" class="btn btn-default"><a href="../topik2">2 Topik</button></a>
					  <button type="button" class="btn btn-default"><a href="../topik3">3 Topik</button></a>
					  <button type="button" class="btn btn-default"><a href="../topik4">4 Topik</button></a>
					  <button type="button" class="btn btn-default"><a href="../topik5">5 Topik</button></a>
					</div></button></button></button></button></div></div>
					<script type="text/javascript">
						$(function () {
							$('#container').highcharts({
								chart: {
									type: 'column'
								},
								title: {
									text: 'Analisa Topic Caption'
								},
								xAxis: {
									categories: [<?= implode( ',', $cat_name ) ?>] 
								},
								yAxis: {
									min: 0,
									title: {
										text: 'Jumlah caption'
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
									$cwo = [0,1];	
									$cwe = [0,1];	
									$f2 = $db->r( 'caption_bot c, username u, cluster_2 l', 'count(id) as n, gender, topik', 'where c.oleh = u.username and c.id = l.id_caption group by topik, gender');
									foreach ($f2 as $r2) {
										if ( $r2['gender'] == 'L' ) $cwo[$r2['topik']] = $r2['n'];
										if ( $r2['gender'] == 'P' ) $cwe[$r2['topik']] = $r2['n'];
											}		
										//		echo implode( '|', $keys );
								?> 

								series: [{
									name: 'Cowok',
									data: [<?= implode(',',$cwo)?>],
									stack: 'tweet'
						
								},
								{
									name: 'Cewek',
									data: [<?= implode(',',$cwe)?>],
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
					