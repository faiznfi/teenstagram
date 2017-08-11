<?php
/*
function top_word( $input ) {
	global $db;
	$words = preg_split( "/[^\w]*([\s]+[^\w]*|$)/", $input, -1, PREG_SPLIT_NO_EMPTY );
	$j = 0;
	foreach ( $words as $word ) {
		$f = $db->f( 'topword_bot', 'keyword', 'WHERE keyword=?', $word );
		if ( $f ) $db->u( 'topword_bot', 'SET n=n+1 WHERE keyword=?', $word );
		else $db->i( 'topword_bot', 'keyword,n', array( $word, 1 ) );

		// $jk = Jumlah Kata
		$jk = substr_count( $input, $word );
		//echo $word . ' = ' . $jk . '<br>';
		if ( $jm >= $j ) {
			$w = $word;
			$j = $jm;
		}
	}
	return $w;
} 

$x = 0;
$start = microtime( true );
$f = $db->r( 'tweet_filter_1', 'id,pesan', 'WHERE fetched<1 ORDER BY rand() LIMIT 1000' );
foreach ( $f as $r ) {
	$f1 = $db->f( 'tweet_filter_1', 'fetched', 'WHERE id=?', $r['id'] );
	if ( $f1->fetched < 1 ) {
		top_word( $r['pesan'] );
		$db->u( 'tweet_filter_1', 'SET fetched=1 WHERE id=?', $r['id'] );
		$x++;
	}
	echo $x . '<br>';
}

$f = $db->f( 'tweet_filter_1', 'COUNT(id) as n', 'WHERE fetched<1' );
echo 'Successfully fetched ' . $x . ' rows in ' . ( microtime( true ) - $start ) . ' seconds.<br>';
echo 'There is ' . $f->n . ' more rows to be fetched. Refresh this page to fetch again.';*/

/*
$f = $db->r( 'topword_bot', '*', 'ORDER BY n DESC LIMIT 1000' );
foreach ( $f as $r ) {
	$len = strlen( $r['keyword'] );
	if ( $len < 4 ) $db->u( 'topword_bot', 'SET outlier=1 WHERE keyword=?', $r['keyword'] );
}*/

if ( $_POST ) {
	foreach ( $_POST['k'] as $k => $v ) {
		$o = $_POST['o'][$k] ? 1 : 0;
		$v = $v == 3 ? 0 : $v;
		$db->u( 'topword_bot', 'SET outlier=?,klas=? WHERE id=?', array( $o, $v, $k ) );
	}
}

$_div = new stdClass;
$_div->head = '
	<link rel="stylesheet" href="http://mistic100.github.io/jQCloud/dist/jqcloud2/dist/jqcloud.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="http://mistic100.github.io/jQCloud/dist/jqcloud2/dist/jqcloud.min.js"></script>
';
include( 'views/header.php' );
$_page = (int) substr( $_csc->uri[2], 1 );
$_page = $_page < 1 ? 1 : $_page;

$limit = 30;
$_limit = ( $_page * $limit ) - $limit;
$f = $db->r( 'topword_bot', '*', 'ORDER BY n DESC LIMIT ' . $_limit . ',' . $limit );
?>
<style>
	.demo {
		margin:0 auto;
		width:100%;
		height:400px;
	}
</style>

<div class="panel panel-primary">
	<?php
	$count = $db->f( 'tweet_filter_1', 'count(id) AS n' );
	$since = $db->f( 'tweet_filter_1', 'waktu', 'ORDER BY waktu' );
	?>
	<div class="panel-heading">Top Words</div>
	<div class="panel-body demo">
	</div>
	<div style="width: 50%; margin: 0 auto;">
		<div>
			<select name="klas" class="klas">
				<option value="3">Semua</option>
				<option value="0">Netral</option>
				<option value="1">Positive</option>
				<option value="2">Negative</option>
			</select>
		</div>
		<div>
			Minimum Frequency: <span class="min-text">20</span>
			<input type="range" class="minimum" max="626" min="20" value="20">
		</div>
		<div>
			Maximum Number of Words: <span class="max-text">1000</span>
			<input type="range" class="maximum" max="626" min="100" value="626">
		</div>
	</div>
	<div class="text-right" style="padding: 11px;">of <?= number_format( $count->n ) ?> tweets since <?= date( 'Y-m-d', $since->waktu ) ?></div>
</div>

<div class="text-right" class="panel-body text-center" style="height: 50px;">
	<a href="/fetch/?t=kategori" class="btn btn-danger">LAUNCH</a>
</div>

<form method="post">
	<table class="table table-striped table-hover table-bordered">
		<tr>
			<th>No</th>
			<th>Keyword</th>
			<th>N</th>
			<th>Outlier?</th>
			<th>Klasifikasi</th>
		</tr>
		<?php $x=1; foreach ( $f as $r ) { ?>
		<tr>
			<td><?= $_limit+$x ?></td>
			<td><?= $r['keyword'] ?></td>
			<td><?= $r['n'] ?></td>
			<td><input type="checkbox" name="o[<?= $r['id'] ?>]"<?= $r['outlier'] ? ' checked' : '' ?>></td>
			<td>
				<select name="k[<?= $r['id'] ?>]">
					<option value="3"<?= $r['klas'] < 1 ? ' selected' : '' ?>>Netral</option>
					<option value="1"<?= $r['klas'] == 1 ? ' selected' : '' ?>>Positive</option>
					<option value="2"<?= $r['klas'] == 2 ? ' selected' : '' ?>>Negative</option>
				</select>
			</td>
		</tr>
		<?php $x++; } ?>
	</table>

	<div class="text-right" style="height: 50px; padding: 6px;">
		<button type="submit" class="btn btn-primary">
			Simpan
		</button>
	</div>
</form>

<div class="text-center"><?php $brrr = floor( ( $_page - 1 ) / 10 ) * 10;  ?>
	<ul class="pagination">
		<li<?= $_page == 1 ? ' class="disabled"' : '' ?>><a href="+<?= $_page-1 ?>">«</a></li>
		<?php for ( $x=1+$brrr; $x<=10+$brrr; $x++ ) { ?>
		<li<?= $_page == $x ? ' class="active"' : '' ?>><a href="+<?= $x ?>"><?= $x ?></a></li>
		<?php } ?>
		<li><a href="+<?= $_page+1 ?>">»</a></li>
	</ul>
</div>
<script>
	<?php $topword = $db->r( 'topword_bot', '*', 'WHERE outlier<1 ORDER BY n DESC LIMIT 1000' ); ?>
	var words = [
		<?php foreach ( $topword as $r ) { ?>{ text: "<?= $r['keyword'] ?>", weight: <?= $r['n'] ?>, klas: <?= (int) $r['klas'] ?>  }, <?php } ?>
	];

	$( '.demo' ).jQCloud( words, {
		autoResize: true
	} );

	$( '.minimum,.maximum,.klas' ).change( function() {
		var nilaimin = $( '.minimum' ).val();
		var nilaimax = $( '.maximum' ).val();
		var klas = $( '.klas' ).val();
		var wordx = new Array;
		words.forEach( function( entry ) {
			if ( klas == 3 || entry.klas == klas ) {
				if ( entry.weight >= nilaimin && entry.weight <= nilaimax) wordx.push( entry );
			}
		} );
		console.log( klas ); 
		$( '.demo' ).jQCloud( 'update', wordx );
		$( '.min-text' ).text( nilaimin );
		$( '.max-text' ).text( nilaimax );
	} );

</script>
<?php
$_div->nojquery = true;
include( 'views/footer.php' );