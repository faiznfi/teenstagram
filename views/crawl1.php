<?php
include( 'lib/csc_curl.php' );
ini_set('max_execution_time', 300);
function removeEmoji($text) {
	$clean_text = "";
	// Match Emoticons
	$regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
	$clean_text = preg_replace($regexEmoticons, '', $text);

	// Match Miscellaneous Symbols and Pictographs
	$regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
	$clean_text = preg_replace($regexSymbols, '', $clean_text);

	// Match Transport And Map Symbols
	$regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
	$clean_text = preg_replace($regexTransport, '', $clean_text);

	// Match Miscellaneous Symbols
	$regexMisc = '/[\x{2600}-\x{26FF}]/u';
	$clean_text = preg_replace($regexMisc, '', $clean_text);

	// Match Dingbats
	$regexDingbats = '/[\x{2700}-\x{27BF}]/u';
	$clean_text = preg_replace($regexDingbats, '', $clean_text);

	return $clean_text;
}

function masukkin ( $i, $username ) {
	global $db;
	$f = $db->f( 'caption_bot', 'id', 'WHERE id=?', $i->code );
	if ( ! $f && $i->caption) {
		// var_dump( $t);
		$arr = array( $i->code, $i->waktu, $username, removeEmoji($i->caption), $i->display_src);
		var_dump($arr);
			$db->i( 'caption_bot', 'id, waktu, oleh, pesan, foto', $arr );
	} else return true;
}
function ulangin( $i1, $username, $n=0 ) { 
	$j = apiJson( "http://kp.intip.in/api/instasearch/$username/?np=$i1" );
	if (is_array($j->photo)) foreach ( $j->photo as $t ) {
		$habis = masukkin( $t, $username );
		if ( $habis ) break;
	}
	if ( ! $habis && $j->next ) return ulangin( $j->beda, $username, $n+1 );
	else return $n;
}
$db->pfx="";
$f = $db->r( 'username', '*' ); 

foreach ( $f as $r ) {
	$username = $r['username'];
	//$username = 'tethavaliant';
	$j = apiJson( 'http://kp.intip.in/api/instasearch/' . $username );
	echo "data terambil". '<br>';
	if (is_array($j->photo))  foreach ( $j->photo as $t ) {
		$habis = masukkin( $t, $username );
		if ( $habis ) break;
	}

	if ( ! $habis ) $n = ulangin( $j->beda, $username );
	echo 'Done repeating ' . $n . ' times.';
}
?>