<?php
include( 'views/header2.php' );
    $modeling = shell_exec('python model_4_30_stem.py');
    echo $modeling; 
?>