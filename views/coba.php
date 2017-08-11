<?php
include( 'views/header2.php' );
$db->pfx='';
if ( $_POST) {
    $tbl = 'caption_bot c, username u';
    // $and = $_POST['tipe'] != 'all' ? ' AND dosen=' . $_POST['tipe'] . ' ' : '';
    $comma = explode( ',', $_POST['bla'] );
    for ( $x=1; $x<=count($comma); $x++ ) {
        $where[] = 'pesan LIKE "%'. str_replace( ' ', '%', $comma[$x-1] ) . '%"  ';
        //      $keys[] = ' ' . $comma[$x-1] . ' ';
        //      $keyb[] = '<b> ' . $comma[$x-1] . ' </b>';
        $space = explode( ' ', $comma[$x-1] );
        for ( $y=1; $y<=count($space); $y++ ) {
            $keys[] = $space[$y-1];
            $keyb[] = '<b>' . $space[$y-1] . '</b>';
        }
        unset( $space );
    }

    // echo 'SELECT * FROM ' . $tbl . ' WHERE (' . implode( ' OR ', $where ) . ')' . $and ;
    $f1 = $db->f( $tbl, 'count(id) as n', 'WHERE c.oleh=u.username and (' . implode( ' OR ', $where ) . ')' . $and );
    $f = $db->r( $tbl, '*', 'WHERE c.oleh=u.username and (' . implode( ' OR ', $where ) . ')' . $and . ' ORDER BY RAND() LIMIT 20' );
}
?>

<div class =container>
<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="../coba">Data Caption</a></li>
  <li role="presentation"><a href="../topik2">Topic by Gender</a></li>
  <li role="presentation"><a href="../region">Topic by Region</a></li>
  <li role="presentation"><a href="../periode2">Topic by Period</a></li>
  <li role="presentation"><a href="../wordcloud">Word Cloud</a></li>
  <li role="presentation"><a href="../mapping">Pembagian Wilayah</a></li>
  </ul>
  <br>
    <div class="col-xs-12 col-md-12">
        <div class="panel panel-primary">   
            <div  class="panel-heading"> Data Caption User
            </div>    
            <br>

<!-- <div class="label label-success" style="margin-left: 900px;">Total Caption : <?= $f1->n ?> ( <?= count( $comma ) ?> keyword )</div></h3> -->
            <html>
    <form method="post">
        <div class="col-lg-6">
            <input type="text" name="bla" value="<?= $_POST['bla'] ?>" class="form-control" placeholder="Enter Keyword & Find The Caption" autofocus>
            <br>
        </div>
        <div class="col-lg-3">
            <button type="submit" class="btn btn-default" style="left">
                Search!
            </button>
    </form></div>
<div><h3>Total Kata <span class="label label-primary"><?= $f1->n ?> ( <?= count( $comma ) ?> keyword )</span></h3></div>

    <?php if ( $_POST ) { ?>
    
    <div class="container">
      <table id="myScrollTable" class="table table-hover" style="margin-bottom: 5px;">
                <style>#myScrollTable tbody {
                    clear: both;
                    height: 400px;
                    overflow:auto;
                    float:left;
                    width:1095px;
                    }</style>
                <tr>
                    <th>id</th>
                    <th>gender</th>
                    <!-- <th>oleh</th> -->
                    <th>pesan</th>
                    <!-- <th>foto</th> -->

                </tr></div>
                <?php foreach ( $f as $r ) { ?>
                
                <tr>
                    <td>[<?= $r['id'] ?>]</td>
                    <td>[<?= $r['gender'] ?>]</td>
                    <!-- <td>[<?= $r['oleh'] ?>]</td> -->
                    <td>"<?= str_ireplace( $keys, $keyb, $r['pesan'] ) ?>"</td>
                </tr>
                <?php } ?>

            </table></div></div>
    <?php
    }
include( 'views/footer.php' );