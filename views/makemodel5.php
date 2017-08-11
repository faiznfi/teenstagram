<?php
include( 'views/header2.php' );
    $modeling = shell_exec('python model_5_30_stem.py');
    echo $modeling; 
?>