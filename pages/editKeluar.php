<?php 
include "../koneksi.php";

if (isset($_POST['updateKeluar'])) {
    $idb = $_POST['idb1'];
    $idk = $_POST['idk1'];
    $penerima = $_POST['penerima1'];
    $qty = $_POST['qty1']; //Qty baru inputan saat ini

    // Mengambil stock barnag saat ini
    $cekstock = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang='$idb'");
    $stocknya = mysqli_fetch_array($cekstock);
    $stocknow = $stocknya['stock'];

    // quantity barang keluar saat ini
    $qtyskrng = mysqli_query($koneksi, "SELECT * FROM keluar WHERE idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrng);
    $qtynow = $qtynya['qty'];

    // lakukan if sebagai logikanya
    if ($qty>$qtynow) {
        // hitung selisihnya
        $selisih = $qty-$qtynow;
        $kurangin = $stocknow - $selisih;

        // membuat notifikasi jika QTY sudah mendekati barang habis
        if ($selisih <= $qtynow) {
             // operasinya
        $kuranginstock = mysqli_query($koneksi, "UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb'");
        $updatestock = mysqli_query($koneksi, "UPDATE keluar SET qty='$qty', penerima='$penerima' WHERE idkeluar='$idk'");

        // jika logika diatas benar maka kembalikan ke halaman keluar.php
        if ($kuranginstock&&$updatestock) {
            header("location:keluar.php?pesan=updatekeluarberhasil");
        } else {
            header("location:keluar.php?pesan=gagalupdatekeluar");
        }
        } else {
            echo '<script>
            alert ("Stock barang tidak mencukupi");
            window.location.href="keluar.php";
            </script>';
        }

       
    } else {
        $selisih = $qtynow-$qty;
        // operasinya
        $tambahkan = $stocknow + $selisih;
        $tambahkanstock = mysqli_query($koneksi, "UPDATE stock SET stock='$tambahkan' WHERE idbarang='$idb'");
        $updatestock = mysqli_query($koneksi, "UPDATE keluar SET qty='$qty', penerima='$penerima' WHERE idkeluar='$idk'");

        // jika logika diatas benar maka kembalikan ke halaman keluar.php
        if ($tambahkanstock&&$updatestock) {
            header("location:keluar.php?pesan=updatekeluarberhasil");
        } else {
            header("location:keluar.php?pesan=gagalupdatekeluar");
        }
        
    }
}

?>