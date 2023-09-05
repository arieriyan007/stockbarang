<?php 
include "../koneksi.php";

if (isset($_POST['updateKeluar'])) {
    $idb = $_POST['idb1'];
    $idk = $_POST['idk1'];
    $qty = $_POST['qty1'];
    $penerima = $_POST['penerima1'];

    // cek stock terlebih dahulu
    $cekstock = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang='$idb'");
    $stocknya = mysqli_fetch_array($cekstock);
    $stocknow = $stocknya['stock'];

    // quantity sekarang juga dicek
    $qtyskrng = mysqli_query($koneksi, "SELECT * FROM keluar WHERE idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrng);
    $qtynow = $qtynya['qty'];

    // lakukan if sebagai pelogikaannya
    if ($qty>$qtynow) {
        // hitung selisihnya
        $selisih = $qty-$qtynow;
        // operasinya
        $kurangin = $stocknow - $selisih;
        $kuranginstock = mysqli_query($koneksi, "UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb'");
        $updatestock = mysqli_query($koneksi, "UPDATE keluar SET qty='$qty', penerima='$penerima' WHERE idkeluar='$idk'");

        // jika logika diatas benar maka kembalikan ke halaman keluar.php
        if ($kuranginstock&&$updatestock) {
            header("location:kerluar.php?pesan=updatekeluarberhasil");
        } else {
            header("location:keluar.php?pesan=gagalupdatekeluar");
        }
    } else {
        $selisih = $qtynow-$qty;
        // operasinya
        $tambahkan = $stocknow + $selisih;
        $tambahkanstock = mysqli_query($koneksi, "UPDATE stock SET stock='$tambahkan' WHERE idbarang='$idb'");
        $updatestock = mysqli_query($koneksi, "UPDATE keluar SET qty='$qty', penerima='$penerima' WHERE idkeluar='$idk'");

        // jika logika diatas benar maka kembalikan ke halaman keluar.php
        if ($tambahkanstock&&$updatestock) {
            header("location:kerluar.php?pesan=updatekeluarberhasil");
        } else {
            header("location:keluar.php?pesan=gagalupdatekeluar");
        }
        
    }
}

?>