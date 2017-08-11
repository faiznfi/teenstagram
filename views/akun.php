<?php
$db->pfx="";
if ( $_POST ) {
  // var_dump( $_POST );
  $arr = [$_POST['username'], $_POST['id_sekolah'],$_POST['gender'] ];
  var_dump( $arr );
  $res = $db->i( 'username', 'username, kode_sekolah, gender', $arr );
  var_dump( $res );
  die();
}

include 'header2.php'
?>
<div class =container>
<ul class="nav nav-tabs">
 <li role="presentation"><a href="../coba">Data Caption</a></li>
  <li role="presentation"><a href="../chartt">Dashboard Perbincangan</a></li>
  <li role="presentation"><a href="../wordcloud">Word Cloud</a></li>
  <li role="presentation"><a href="../mapping">Pembagian Wilayah</a></li>
  <li role="presentation" class="active"><a href="../akun">Tambah Akun</a></li>
  </ul>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h4><b>Tambah Data Akun</h4>
  <br>
  <form action="" method="POST">
    <div class="form-group">
      <label for="username"><b>Username:</label>
      <input type="username" class="form-control" id="email" placeholder="Masukkan data username Instagram" name="username">
    </div>
    <div class="form-group">
      <label for="pwd"><b>Sekolah (optional):</label>
      <input type="Sekolah" class="form-control" id="pwd" placeholder="Masukkan Kode Sekolah" name="id_sekolah">
    </div>
    <div class="form-group">
      <label for="gender"><b>Gender:</label>
  <div class="gender">
    <label><input type="radio" name="gender" value="L"> Laki-laki</label><br>
    <label><input type="radio" name="gender" value="P"> Perempuan</label>
    </div>
    <br>
    <button type="submit" class="btn btn-success">Submit</button>
  </form>
</div>