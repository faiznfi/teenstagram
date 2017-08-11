<?php
include( 'views/header2.php' );
    $modeling = shell_exec('python model_2_30_stem.py');
    echo $modeling; 
?>