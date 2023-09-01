<?php 
include "../koneksi.php";

if (isset($_POST['updateStock'])) {
    $idbarang = $_POST['idb'];
    $nmbarang = $_POST['nbarang'];
    $deskripsi = $_POST['deskripsi'];

    $updatestock = mysqli_query($koneksi, "UPDATE stock SET namabarang='$nmbarang', deskripsi='$deskripsi' WHERE idbarang='$idbarang' ");

    // cek update apakah berhasil atau tidak
    if ($updatestock) {
        header('location:index.php?pesan=berhasilUpdate');
    } else {
        header('location:index.php?pesan=gagalUpdate');
    }
}
?>