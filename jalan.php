<?php 

$command = escapeshellcmd('cd/"Tugas Kuliah"/"S1 SISFOR"/"SEMESTER VIII"/TA/"PASCA SIDANG PROPOSAL"/try');
$output = shell_exec($command);
echo $output;

?>