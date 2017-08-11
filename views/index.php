<?php
include( 'views/header2.php' );

if ( $_POST) {
	$tbl = 'tweet_filter_1';
	$and = $_POST['tipe'] != 'all' ? ' AND dosen=' . $_POST['tipe'] . ' ' : '';
	$comma = explode( ',', $_POST['bla'] );
	for ( $x=1; $x<=count($comma); $x++ ) {
		$where[] = 'pesan LIKE "%'. str_replace( ' ', '%', $comma[$x-1] ) . '%" ';
		//		$keys[] = ' ' . $comma[$x-1] . ' ';
		//		$keyb[] = '<b> ' . $comma[$x-1] . ' </b>';
		$space = explode( ' ', $comma[$x-1] );
		for ( $y=1; $y<=count($space); $y++ ) {
			$keys[] = $space[$y-1];
			$keyb[] = '<b>' . $space[$y-1] . '</b>';
		}
		unset( $space );
	}

	$f1 = $db->f( $tbl, 'count(id) as n', 'WHERE (' . implode( ' OR ', $where ) . ')' . $and );
	$f = $db->r( $tbl, '*', 'WHERE (' . implode( ' OR ', $where ) . ')' . $and . ' ORDER BY RAND() LIMIT 100' );
}
?>
<div id="container" style="height: 0px"></div>
<div class="panel-body text-left">
	<a href="/fetch/?t=tw2" class="btn btn-danger">TAMBAH AKUN</a>
	<a href="/butet/?q=jalan" class="btn btn-primary">TAMBAH TWEET</a>
	<a href="/cobak" class="btn btn-success">LOKASI </a>

</div>
<font color="red">#NB:Tambah Akun akan membuat server BEKERJA KERAS!</font>
<br><br>

<html>
	<form method="post">
		<div class="col-lg-6">
			<input type="text" name="bla" value="<?= $_POST['bla'] ?>" class="form-control" placeholder="Enter Keyword & Find The Tweet" autofocus>
		</div>

		<div class="col-lg-3">
			<select name="tipe" class="form-control">
				<option value="all">All</option>
				<option value="0">Mahasiswa</option>
				<option value="1">Dosen</option>
			</select>
		</div>
		<div class="col-lg-3">
			<button type="submit" class="btn btn-default" style="left">
				Search!
			</button>
		</div>
	</form>

	<?php if ( $_POST ) { ?>
	<h1><br>Total Tweet : <?= $f1->n ?> ( <?= count( $comma ) ?> keyword )</h1>
	<div class="container">
		<div class="jumbotron">

			<table class="table">
				<?php foreach ( $f as $r ) { ?>
				<tr>
					<td>@<?= $r['oleh'] ?></td>
					<td><?= str_ireplace( $keys, $keyb, $r['pesan'] ) ?></td>
				</tr>
				<?php } ?>

			</table></div></div>
	<?php
	}
	
include( 'views/footer.php' );