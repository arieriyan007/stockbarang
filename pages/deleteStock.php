<?php 
include "../koneksi.php";

if (isset($_POST['deleteStock'])) {
    $idb = $_POST['idb'];

    $delete = mysqli_query($koneksi, "DELETE FROM stock WHERE idbarang='$idb' ");

    // cek 
    if ($delete) {
        header('location:index.php?pesan=dihapus');
    } else {
        header('location:index.php?pesan=gagalHapus');
    }
}
?>