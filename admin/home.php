<?php
session_start();
$userid = $_SESSION['userid'];
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
    <style>
      
    </style>
</head>
<body>
    <hr>
<nav class="navbar navbar-expand-lg bg-body-primary">
  <div class="container">
    <a class="navbar-brand" href="index.php"> Galeri Foto</a>
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

<div class="container mt-3">
    <div class="row">
<?php
$query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
while($data = mysqli_fetch_array($query)){
    ?>
    <div class="col-md-3 mt-2">
            <div class="card">
                <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>" style="height: 12rem;">
                <div class="card-footer text-center">
                    
                    <?php
                    $fotoid = $data['fotoid'];
                    $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                    if (mysqli_num_rows($ceksuka) == 1) { ?>
                        <a href="../config/proseslike.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                    <?php }else{ ?>
                        <a href="../config/proseslike.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                    <?php }
                    $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows($like). ' Suka';
                    ?>
                    <a href=""><i class="fa-regular fa-comment"></i></a>3 komentar
                </div>
            </div>
        </div>
<?php } ?>
</div>
</div>

    

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>