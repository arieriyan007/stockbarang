<?php 
include "../koneksi.php";

if (isset($_POST['delKeluar'])) {
    $idk = $_POST['idk'];

    // proses delete barang
    $delete = mysqli_query($koneksi, "DELETE FROM keluar WHERE idkeluar='$idk'");

    // kembalikan menu keluar
    if ($delete) {
        header("location:keluar.php?pesan=berhasilhapuskeluar");
    } else {
        header("location:keluar.php?pesan=gagalhapuskeluar");
    }
}
?>