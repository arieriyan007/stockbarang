<?php 
include "../koneksi.php";

if (isset($_POST['updateMasuk'])) {
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $qty = $_POST['qty'];
    $ket = $_POST['keterangan'];

    // cekstock
    $cekstock = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang='$idb' ");
    $stock = mysqli_fetch_array($cekstock);
    $stockskrg = $stock['stock'];

    // sebelum update jgn lupa simpan dl data saat di proses updatenya
    $qtyskrng = mysqli_query($koneksi, "SELECT * FROM masuk WHERE idmasuk='$idm' ");
    // jgn lupa mysqli_fetch_array
    $qtynya = mysqli_fetch_array($qtyskrng);
    $dataqty = $qtynya['qty'];
    
    // logica penjumlahannya menggunakan if
    if ($qty > $dataqty) {
        // hitung selisinya dikurangin
        $selisih = $qty-$dataqty;
        $kurangin = $stockskrg - $selisih;

        // masuk proses update kedalam database stock
        $stocknya = mysqli_query($koneksi, "UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb' ");
        $updatenya = mysqli_query($koneksi, "UPDATE masuk SET qty='$qty', keterangan='$ket' WHERE idmasuk='$idm' ");

        // membuat if lagi
        if ($updatenya&&$stocknya) {
            header('location:masuk.php?pesan=berhasilupdate');
        } else {
            header('location:masuk.php?pesan=gagalupdate');
        }
    } else {
        // hitung selisinya posisinya dibalik 
        $selisih = $dataqty-$qty;
        $tambahkan = $stockskrg + $selisih;

        // masuk proses update kedalam database stock
        $stocknya = mysqli_query($koneksi, "UPDATE stock SET stock='$tambahkan' WHERE idbarang='$idb' ");
        $updatenya = mysqli_query($koneksi, "UPDATE masuk SET qty='$qty', keterangan='$ket' WHERE idmasuk='$idm' ");

        // membuat if lagi
        if ($updatenya&&$stocknya) {
            header('location:masuk.php?pesan=berhasilupdate');
        } else {
            header('location:masuk.php?pesan=gagalupdate');
        }
    }

}
?>