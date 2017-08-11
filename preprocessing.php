<?php
include 'header2.php'
?>
<div class =container>
<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="../coba">Preprocessing</a></li>
  <li role="presentation"><a href="../process">Preprocessing</a></li>
  <li role="presentation"><a href="../region">Topic by Region</a></li>
  <li role="presentation"><a href="../wordcloud">Word Cloud</a></li>
  <li role="presentation"><a href="../mapping">Pembagian Wilayah</a></li>
  </ul>


  <br>
    <div class="col-xs-12 col-md-12">
        <div class="panel panel-primary">   
            <div  class="panel-heading"> Data Caption User
                <a href="../akun" class="btn btn-default btn-xs" style="margin-left: 640px;">Tambah Akun</a>
                <a href="../crawl1" class="btn btn-default btn-xs" style="margin-left: 10px;">Tambah Caption</a>
                <a href="../cetak" class="btn btn-default btn-xs" style="margin-left: 10px;">Download Data</a></div>
            <br>    

<!-- <?php
	$result = shell_exec('python prepocessing_with_stem.py');
	echo $result;
	?>
	<script language="JavaScript">
	//alert("Yes");
	//document.location='index.php';
	</script>
 -->