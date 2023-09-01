<?php 
include "../koneksi.php";

// membuat if
if (isset($_POST['addMasuk'])) {
    $barang = $_POST['barangMasuk'];
    $qty = $_POST['qty'];
    $ket = $_POST['ket'];

    // cek stock barang di database stock
    $cekstock = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang = '$barang'");
    $databarang = mysqli_fetch_array($cekstock);
    $stocksekarang = $databarang['stock'];

    // tambahkan stock yg ada dari qty masuk ke stock barang
    $tambahstock = $stocksekarang+$qty;

    // proses tambah data di barang masuk
    $tambahdata = mysqli_query($koneksi, "INSERT INTO masuk (idbarang, qty, keterangan) VALUES ('$barang', '$qty', '$ket')");

    $updatestock = mysqli_query($koneksi, "UPDATE stock SET stock='$tambahstock' WHERE idbarang='$barang' ");
    if ($tambahdata&&$updatestock) {
        header("location:masuk.php?status=berhasil");
    } else {
        header("location:masuk.php?status=gagal");
    }

}
?>