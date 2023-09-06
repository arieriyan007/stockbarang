<?php 
include "../koneksi.php";

if (isset($_POST['delKeluar'])) {
    $idk = $_POST['idk'];
    $qty = $_POST['qty'];
    $idb = $_POST['idb'];

    // cek stock terlebih dahulu sebelum melakukan delete
    $getstock = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang='$idb'");
    $data = mysqli_fetch_array($getstock);
    $stock = $data['stock'];

    // hitung selisih stocknya 
    $selisih = $stock+$qty;

    // selanjutnya lakukan update
    $update = mysqli_query($koneksi, "UPDATE stock SET stock='$selisih' WHERE idbarang='$idb'");
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