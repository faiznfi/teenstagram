<?php if ( ! isset( $_div ) ) $_div = new stdClass(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://bootswatch.com/lumen/bootstrap.min.css" type="text/css">
		<!-- <link rel="icon" href="http://imgh.us/icon-ta_1.png"> -->
		<link rel="icon" href="http://imgh.us/icon_ta.png">
		<title><?= $_div->title ?: 'TeenStagram' ?></title>
		<style>.navbar-header span { color: #0015ff } .img-depan img { width: 60px; height: 60px; } .redeem-point img { max-width: 250px; }</style>
		<?= "\n" . ( $_div->head ?: '' ) . "\n" ?>
	</head>
	<BODY>
		
  		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
					<ul class="nav nav-pills">
  					  <li role="presentation" ><a href="/kp/coba/" ><h4>TeenStagram</h4></a></li>
					  <li role="presentation" ><a href="/kp/coba/" ><h4>Caption Frame</h4></a></li>
					  <li role="presentation"><a href="/kp/coba/"><h4>Time Frame</h4></a></li>
					  <li role="presentation"><a href="/kp/proses"><h4>Processing Data Caption</h4></a></li>
					</ul>

						
          <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <li<?= $_csc->uri[1] == 'data' ? ' class="active"' : '' ?>><a href="/kp/coba/">Data Acuan</a></li>
            <li><a href="#">La La La</a></li>        
					</ul> -->
				</div>
			</div>
		</nav>
		<div class="container">