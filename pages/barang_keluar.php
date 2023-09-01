<?php 
include "../koneksi.php";

if (isset($_POST['addKeluar'])) {
    $barang = $_POST['nmbarang'];
    $qty    = $_POST['qty'];
    $penerima = $_POST['penerima'];

    // cekstock barang
    $cekstock = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang = '$barang'");
    $keepstock = mysqli_fetch_array($cekstock);

    // periksa stok barang sekarang
    $stocksekarang = $keepstock['stock'];
    // pengurangan stock
    $stockkurang = $stocksekarang-$qty;

    // data inputan disimpan kedatabase data yg dikurangin
    $datastocksekarang = mysqli_query($koneksi, "INSERT INTO keluar (idbarang, qty, penerima) VALUES
    ('$barang','$qty','$penerima')");
    
    // logika saat barang di update setelah dikurangkan
    $updatestock = mysqli_query($koneksi, "UPDATE stock SET stock='$stockkurang' WHERE idbarang='$barang' ");

    // kembalikan halaman
    if ($datastocksekarang&&$updatestock) {
        header("location:keluar.php?pesan=berhasil");
    } else {
        header("location:keluar.php?pesan=gagalupdate");
    }
}
?>