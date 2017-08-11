<?php
include( 'views/header2.php' );
    $modeling = shell_exec('python model_3_30_stem.py');
    echo $modeling; 
?>