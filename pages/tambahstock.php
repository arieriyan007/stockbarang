<?php 
include "../koneksi.php";

if (isset($_POST['addbarang'])) {
    $nbarang = $_POST['nbarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    // masukkan data ke dalam database
    $tamabahbarang = mysqli_query($koneksi, "INSERT INTO stock(namabarang, deskripsi, stock) VALUE 
    ('$nbarang', '$deskripsi', '$stock')");

    // jika data selesai input maka
    if ($tamabahbarang) {
        header("location:index.php?pesan=berhasil_ditambahkan");
    } else {
        header("location:index.php?pesan=data_gagal");
    }
}
?>