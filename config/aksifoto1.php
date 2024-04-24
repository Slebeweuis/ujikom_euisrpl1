<?php
session_start();
include 'koneksi.php';
if (isset($_POST['tambah'])) {
    $judulfoto = $_POST['judulfoto'];
    $deskripsifoto = $_POST['deskripsifoto'];
    $tanggalunggah = date('Y-m-d');
    $userid = $_SESSION['userid'];
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasi = '../assets/img/';
    $namafoto = rand().'-'.$foto;

    move_uploaded_file($tmp, $lokasi.$namafoto);

$sql = mysqli_query($koneksi, "INSERT INTO foto VALUES('','$judulfoto', '$deskripsifoto', '$tanggalunggah', '$namafoto', '$userid')");

echo "<script>
alert ('Data berhasil disimpan!');
location.href='../admin/foto.php';
</script>";
}
if (isset($_POST['edit'])) {
    $fotoid = $_POST['fotoid'];
    $judulfoto = $_POST['judulfoto'];
    $deskripsifoto = $_POST['deskripsifoto'];
    $tanggalunggah = date('Y-m-d');
    $userid = $_SESSION['userid'];

    // Memeriksa apakah ada file gambar yang diunggah
    if(isset($_FILES['lokasifile']) && $_FILES['lokasifile']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['lokasifile']['name'];
        $tmp = $_FILES['lokasifile']['tmp_name'];
        $lokasi = '../assets/img/';
        $namafoto = uniqid().'-'.$foto; // Changed to uniqid() for better uniqueness

        // Hapus file lama jika ada
        $stmt = $koneksi->prepare("SELECT lokasifile FROM foto WHERE fotoid=?");
        $stmt->bind_param("i", $fotoid);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0) {
            $stmt->bind_result($oldFileName);
            $stmt->fetch();
            if (is_file('../assets/img/'.$oldFileName)) {
                unlink('../assets/img/'.$oldFileName);
            }
        }
        $stmt->close();

        // Pindahkan file baru
        move_uploaded_file($tmp, $lokasi.$namafoto);
    }

    // Perbarui data, termasuk lokasi file baru jika ada
    $stmt = $koneksi->prepare("UPDATE foto SET judulfoto=?, deskripsifoto=?, tanggalunggah=?, lokasifile=? WHERE fotoid=?");
    $stmt->bind_param("ssssi", $judulfoto, $deskripsifoto, $tanggalunggah, $namafoto, $fotoid);
    if ($stmt->execute()) {
        // Success
    } else {
        // Error handling
    }
    $stmt->close();
}

    echo "<script>
    alert ('Data berhasil diperbarui!');
    location.href='../admin/foto.php';
    </script>";


if (isset($_POST['hapus'])) {
    $fotoid = $_POST['fotoid'];
    $query = mysqli_query($koneksi, "SELECT lokasifile FROM foto WHERE fotoid='$fotoid'");
    $data = mysqli_fetch_array($query);
    if (is_file('../assets/img/'.$data['lokasifile'])) {
        unlink('../assets/img/'.$data['lokasifile']);
    }

    $sql = mysqli_query($koneksi, "DELETE FROM foto WHERE fotoid='$fotoid'");
    echo "<script>
    alert ('Data berhasil dihapus!');
    location.href='../admin/foto.php';
    </script>";
}
