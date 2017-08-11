<?php
include 'header2.php'
?>
<div class =container>
<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="../proses">Data Caption</a></li>
  <li role="presentation"><a href="../proses2">Data Caption Topic 2</a></li>
  <li role="presentation"><a href="../proses3">Data Caption Topic 3</a></li>
  <li role="presentation"><a href="../proses4">Data Caption Topic 4</a></li>
  <li role="presentation"><a href="../proses5">Data Caption Topic 5</a></li>
  <li role="presentation"><a href="../preprocessing">Modeling Data</a></li>

  </ul>


  <br>
    <div class="col-xs-12 col-md-12">
        <div class="panel panel-primary">   
            <div  class="panel-heading"> Data Caption User
                <a href="../crawl1" class="btn btn-default btn-xs" style="margin-left: 650px;">Tambah Caption</a>
                <a href="../cetak" class="btn btn-default btn-xs" style="margin-left: 5px;">Download Data</a>
                <a href="../akun" class="btn btn-default btn-xs" style="margin-left: 5px;">Tambah Akun</a>
            <br>    

            </table></div>
            <table id="myScrollTable" class="table table-hover" style="margin-bottom: 3px;">
                <style>#myScrollTable tbody {
                    clear: both;
                    height: 400px;
                    overflow:auto;
                    float:left;
                    width:1108px;
                    }</style>

               <?php 
                $db->pfx="";
                $f = $db->r( 'caption_bot', 'count(id) as n'); ?>
          
                <?php foreach ( $f as $r ) {
        
                $x++; }?>
                <div><h3 style ="margin-left: 10px;">Total Data Caption<span style ="margin-left: 10px" class="label label-primary"><?= $r ["n"] ?></span></h3>

                <?php 
                $db->pfx="";
                $f = $db->r( 'caption_bot c, username u, periode p, cluster_2 t', 'id,pesan,gender,waktu, month, year,topik', 'where u.username = c.oleh and c.id = p.id_timepost and c.id=t.id_caption' ); ?>
          
                <tr>
                    <th>ID</th>
                    <th>GENDER</th>
                    <th>PERIODE</th>
                    <th>YEAR</th>
                    <th>CAPTION</th>
                    <!-- <th>foto</th> -->

                </tr>
                <?php $x=1; foreach ( $f as $r ) { ?>
                <tr>
                    <!-- <td><?php echo $x ?></td> -->
                    <td><?php echo $r ["id"]?></td>
                    <td><?php echo $r ["gender"]?></td>
                    <td><?php echo $r ["month"]?></td>
                    <td><?php echo $r ["year"]?></td>
                    <td><?php echo $r ["pesan"]?></td>
                    <!-- <td><?php echo $r ["foto"]?></td> -->
                </tr>
                
                <?php $x++; }?>
            </table></div></div>
    <!-- <div class="col-xs-6">
        <div class="panel panel-primary">   
            <div class="panel-heading"> Data Caption Region 2
                <a href="/crawl2" class="btn btn-danger btn-xs" style="margin-left: 135px;">Tambah Caption</a>
                <a href="/cetak2" class="btn btn-success btn-xs" style="margin-left: 10px;">Download Data</a></div>
            <br>    
            <table id="myScrollTable" class="table table-hover" style="margin-bottom: 3px;">
                <style>#myScrollTable tbody {
                    clear: both;
                    height: 200px;
                    overflow:auto;
                    float:left;
                    width:538px;
                    }</style>
                <?php $f = $db->r( 'caption_bot2', 'waktu,oleh,pesan' ); ?>
                <tr>
                    <th>id</th>

                    <th>username</th>
                    <th>pesan</th>
                </tr>
                <?php $x=1; foreach ( $f as $r ) { ?>
                <tr>
                    <td><?php echo $x ?></td>

                    <td><?php echo $r ["oleh"]?></td>
                    <td><?php echo $r ["pesan"]?></td>
                </tr>
                <?php $x++; }?>
            </table></div></div>
    <div class="col-xs-6">
        <div class="panel panel-primary">   
            <div class="panel-heading"> Data Caption Region 3
                <a href="/crawl3" class="btn btn-danger btn-xs" style="margin-left: 135px;">Tambah Caption</a>
                <a href="/cetak3" class="btn btn-success btn-xs" style="margin-left: 10px;">Download Data</a></div>
            <br>    
            <table id="myScrollTable" class="table table-hover" style="margin-bottom: 3px;">
                <style>#myScrollTable tbody {
                    clear: both;
                    height: 200px;
                    overflow:auto;
                    float:left;
                    width:538px;
                    }</style>
                <?php $f = $db->r( 'caption_bot3', 'waktu,oleh,pesan' ); ?>
                <tr>
                    <th>id</th>

                    <th>username</th>
                    <th>pesan</th>
                </tr>
                <?php $x=1; foreach ( $f as $r ) { ?>
                <tr>
                    <td><?php echo $x ?></td>

                    <td><?php echo $r ["oleh"]?></td>
                    <td><?php echo $r ["pesan"]?></td>
                </tr>
                <?php $x++; }?>
            </table></div></div>
    <div class="col-xs-6">
        <div class="panel panel-primary">   
            <div class="panel-heading"> Data Caption Region 4
                <a href="/crawl4" class="btn btn-danger btn-xs" style="margin-left: 135px;">Tambah Caption</a>
                <a href="/cetak4" class="btn btn-success btn-xs" style="margin-left: 10px;">Download Data</a></div>
            <br>    
            <table id="myScrollTable" class="table table-hover" style="margin-bottom: 3px;">
                <style>#myScrollTable tbody {
                    clear: both;
                    height: 200px;
                    overflow:auto;
                    float:left;
                    width:538px;
                    }</style>
                <?php $f = $db->r( 'caption_bot4', 'waktu,oleh,pesan' ); ?>
                <tr>
                    <th>id</th>

                    <th>username</th>
                    <th>pesan</th>
                </tr>
                <?php $x=1; foreach ( $f as $r ) { ?>
                <tr>
                    <td><?php echo $x ?></td>

                    <td><?php echo $r ["oleh"]?></td>
                    <td><?php echo $r ["pesan"]?></td>
                </tr>
                <?php $x++; }?>
            </table></div></div>
    <div class="col-xs-6">
        <div class="panel panel-primary">   
            <div class="panel-heading"> Data Caption Region 5
                <a href="/crawl5" class="btn btn-danger btn-xs" style="margin-left: 135px;">Tambah Caption</a>
                <a href="/cetak5" class="btn btn-success btn-xs" style="margin-left: 10px;">Download Data</a></div>
            <br>    
            <table id="myScrollTable" class="table table-hover" style="margin-bottom: 3px;">
                <style>#myScrollTable tbody {
                    clear: both;
                    height: 200px;
                    overflow:auto;
                    float:left;
                    width:538px;
                    }</style>
                <?php $f = $db->r( 'caption_bot5', 'waktu,oleh,pesan' ); ?>
                <tr>
                    <th>id</th>

                    <th>username</th>
                    <th>pesan</th>
                </tr>
                <?php $x=1; foreach ( $f as $r ) { ?>
                <tr>
                    <td><?php echo $x ?></td>

                    <td><?php echo $r ["oleh"]?></td>
                    <td><?php echo $r ["pesan"]?></td>
                </tr>
                <?php $x++; }?>
            </table></div></div> -->
    <?php

    include( 'views/footer.php' );
    ?>