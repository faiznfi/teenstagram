<?php
include( 'views/header2.php' );
$db->pfx='';
?>
<div class =container>
<ul class="nav nav-tabs">
  <li role="presentation"><a href="../coba">Data Caption</a></li>
  <li role="presentation"><a href="../chartt">Topic by Gender</a></li>
  <li role="presentation" class="active"><a href="../region">Topic by Region</a></li>
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
					  <button type="button" class="btn btn-default"><a href="../region2">Topik 2</button></a>
					  <button type="button" class="btn btn-default"><a href="../region3">Topik 3</button></a>
					  <button type="button" class="btn btn-default"><a href="../region4">Topik 4</button></a>
					  <button type="button" class="btn btn-default"><a href="../region5">Topik 5</button></a>
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
									$ST = [0,1];	
									$SS = [0,1];	
									$SP = [0,1];	
									$SU = [0,1];	
									$f2 = $db->r( 'sekolah s, region r, caption_bot c, username u, cluster_2 l', 'count(id) as n, region, topik', 'where c.oleh = u.username and c.id = l.id_caption and u.kode_sekolah=s.id_sekolah and r.id_region=s.region group by topik, region');
									foreach ($f2 as $r2) {
										if ( $r2['region'] == '1' ) $ST[$r2['topik']] = $r2['n'];
										if ( $r2['region'] == '2' ) $SS[$r2['topik']] = $r2['n'];
										if ( $r2['region'] == '3' ) $SP[$r2['topik']] = $r2['n'];
										if ( $r2['region'] == '4' ) $SU[$r2['topik']] = $r2['n'];
											}		
										//		echo implode( '|', $keys );
								?> 
						
								series: [{
									name: 'S. Timur',
									data: [<?= implode(',',$ST)?>],
									stack: 'tweet'
						
								},
								{
									name: 'S. Selatan',
									data: [<?= implode(',',$SS)?>],
									stack: 'tweet'
						
								},
								{
									name: 'S. Pusat',
									data: [<?= implode(',',$SP)?>],
									stack: 'tweet'
								},
								{
									name: 'S. Utara',
									data: [<?= implode(',',$SU)?>],
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
				
	

 