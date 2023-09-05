<?php 
include "../koneksi.php";

if (isset($_POST['delMasuk'])) {
    $idm = $_POST['idm'];
    $idb = $_POST['idbarang'];
    $qty = $_POST['quantity'];

    // ambil data dari stock barang
    $getbarang = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang='$idb'");
    $gb = mysqli_fetch_array($getbarang);
    $stock = $gb['stock'];

    // hitung selisih seblum melakukan penghapusan data
    $selisih = $stock-$qty;

    // kemudian lakukan update pada database
    $update = mysqli_query($koneksi, "UPDATE stock SET stock='$selisih' WHERE idbarang='$idb'");

    // salanjutnya lakukan penghapusan data
    $delete = mysqli_query($koneksi, "DELETE FROM masuk WHERE idmasuk='$idm'");

    // buat if untuk pengkondisian kembali kehalaman jika terjadi delete data
    if ($update&&$delete) {
        header('location:masuk.php?pesan=datadihapus');
    } else {
        header('location:masuk.php?pesan=gagaldihapus');
    }

}

?>