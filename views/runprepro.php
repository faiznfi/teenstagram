<?php
include( 'views/header2.php' );
    $preprocessing = shell_exec('python kp/prepocessing_with_stem.py');
    echo $preprocessing; 
?>