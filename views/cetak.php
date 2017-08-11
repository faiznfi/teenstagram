<?php
$db->pfx="";
$f = $db->r2( 'cluster_2 c, caption_bot u', 'id_caption, pesan', 'WHERE c.id_caption = u.id' );
// var_dump( $f );
// die();	
$csv = fopen('php://output', 'w');
$filename = "data_for_preprocess.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename); 

foreach ( $f as $k => $v ) {
	$v['pesan'] = '' . $v['pesan'] . '';
	// var_dump( $v['pesan'] );
   fputcsv( $csv, $v );
}




fclose( $csv );