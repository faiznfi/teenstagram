<?php
$db->pfx='';
$f2 = $db->r('caption_bot', 'id, waktu', 'where year = 17' );
    foreach ($f2 as $r2) {
        $id=$r2['id'];
        $waktu=$r2['waktu'];
$month = date('M', $waktu) ; // output as RFC 2822 date - returns local time
$year = date('y', $waktu) ; // output as RFC 2822 date - returns local time
$db->i( 'periode', 'id_timepost, month, year',  array ($id, $month, $year));

} ?>