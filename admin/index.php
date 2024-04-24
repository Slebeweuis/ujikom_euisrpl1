<?php
session_start();
$user_id = $_SESSION['userid'];
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda belum login!');
    location.href='../index.php';
    </script>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
   
</head>
<body><hr> <style>

   
</style>
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-secondary-subtle">
  <div class="container">
    <a class="navbar-brand" href="index.php">Website Galeri Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNav">
        <div class="navbar-nav me-auto">
            <a href="home.php" class="nav-link">Home</a>
            
            <a href="foto.php" class="nav-link">Foto</a>
        </div>
        
        <a href="../config/aksilogout.php" class="btn btn-outline-danger m-1">Keluar</a>
    </div>
  </div>
</nav><hr>

<div class="container" mt-2>
  <div class="row">
    <?php 
  $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid");
while($data = mysqli_fetch_array($query)){
    ?>
    <div class="col-md-3">
    <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">

            <div class="card mb-2">
                <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>" style="height: 12rem;">
                <div class="card-footer text-center">                   
                    <?php
                    $foto_id = $data['fotoid'];
                    $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$foto_id' AND userid='$user_id'");
                    if (mysqli_num_rows($ceksuka) == 1) { ?>
                        <a href="../config/proseslike.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                    <?php }else{ ?>
                        <a href="../config/proseslike.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                    <?php }
                    $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$foto_id'");
                    echo mysqli_num_rows($like). ' Suka';
                    ?>

                    <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-comment"></i></a>
                    <?php
                    $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$foto_id'");
                    echo mysqli_num_rows($jmlkomen).' komentar';
                    ?>
                </div>
            </div>
            </a>
            
            <!-- Modal -->
<div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
          <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
          </div>
          <div class="col-md-4">
            <div class="m-2">
              <div class="overflow-auto">
                <div class="sticky-top">
                  <strong><?php echo $data['judulfoto'] ?></strong><br>
                  <span class="badge bg-secondary"><?php echo $data['namalengkap'] ?></span>
                  <span class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span>
                 
                </div>
                <hr>
                <p align="left">
                  <?php echo $data['deskripsifoto'] ?>
                </p>
                <hr>
                <?php
                $foto_id = $data['fotoid'];
                $komentar_foto = mysqli_query($koneksi,"SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$foto_id'");
                while($row = mysqli_fetch_array($komentar_foto)){
                ?>
                <p align="left">
                  <strong><?php echo $row['namalengkap'] ?></strong>
                  <?php echo $row['isikomentar'] ?>
                </p>
                <?php } ?>
                <hr>
                <div class="sticky-bottom">
                  <form action="../config/proseskomentar.php" method="POST">
                    <div class="input-group">
                      <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                      <input type="text" name="isikomentar" class="form-control" placeholder="isi">
                      <div class="input-ground-prepend">
                        <button type="submit" name="kirimkomentar" class="btn btn-outline-primary">Kirim</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

        </div>
        <?php } ?>
  </div>
</div>




    

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>