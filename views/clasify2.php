<?php
include( 'views/header2.php' );
$db->pfx='';
ini_set('max_execution_time', 0);
$f2 = $db->r('caption_bot', 'id, pesan', 'WHERE caption_bot.id NOT IN (SELECT id_caption FROM cluster_2)');
	foreach ($f2 as $r2) {
		$id=$r2['id'];
		$pesan=$r2['pesan'];
		$result = shell_exec('python clasify2.py "' .$pesan.'"'); 
	$db->i( 'cluster_2', 'id_caption, topik',  array ($id, $result));

}
