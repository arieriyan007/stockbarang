<?php 
include "../koneksi.php";

if (isset($_POST['deleteStock'])) {
    $idb = $_POST['idb']; //id barang

    // cari dulu gambarnya agar bisa di hapus biar tidak memenuhi memory/resource
    $gambar = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang='$idb'"); //masuk ke database
    $get = mysqli_fetch_array($gambar); 
    $img = '../assets/img/'.$get['image']; //ambil gambarnya
    // untuk menghapus gambarnya bisa menggunakan unlink
    unlink($img);

    // proses delete didatabase
    $delete = mysqli_query($koneksi, "DELETE FROM stock WHERE idbarang='$idb' ");

    // cek  prosenya jika sudahh dihapus maka bisa balik ke index.php
    if ($delete) {
        header('location:index.php?pesan=dihapus');
    } else {
        header('location:index.php?pesan=gagalHapus');
    }
}
?>