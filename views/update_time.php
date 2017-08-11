<?php
$db->pfx='';
$f2 = $db->r('caption_bot', 'id, waktu');
    foreach ($f2 as $r2) {
        $id=$r2['id'];
        $waktu=$r2['waktu'];
$epoch = date('M/y', $waktu) ; // output as RFC 2822 date - returns local time
$db->i( 'periode', 'id_timepost, periode',  array ($id, $epoch));

} ?>