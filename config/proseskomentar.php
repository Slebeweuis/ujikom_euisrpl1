<?php
session_start();
include 'koneksi.php';

$foto_id = $_POST['fotoid'];
$user_id = $_SESSION ['userid'];
$isikomentar = $_POST['isikomentar'];
$tanggalkomentar = date('Y-m-d');

$query = mysqli_query($koneksi, "INSERT INTO komentarfoto VALUES('','$foto_id','$user_id','$isikomentar','$tanggalkomentar')");

echo "<script>
location.href='../admin/index.php';
</script>";

?>