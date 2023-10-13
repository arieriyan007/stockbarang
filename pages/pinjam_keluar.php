<?php 
include "../koneksi.php";

if (isset($_POST['addPinjam'])) {
    $idbarang   = $_POST['nmbarang'];
    $qty        = $_POST['qty'];
    $peminjam   = $_POST['penerima'];
    // cekstock sekarang
    $cekstock = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang='$idbarang'");
    $stocknya = mysqli_fetch_array($cekstock);

    // periksa stok barang sekarang
    $stocksekarang = $stocknya['stock'];
        // kurangkan stock
        if ($stocksekarang >= $qty) {
            $stockkurang = $stocksekarang-$qty;

            // masukkan kedalam database
            $datapinjam = mysqli_query($koneksi, "INSERT INTO peminjaman (idbarang, qty, peminjam) VALUES ('$idbarang', '$qty', '$peminjam')");

            // update stock
            $updatestock = mysqli_query($koneksi, "UPDATE stock SET stock='$stockkurang' WHERE idbarang='$idbarang'");
        
            if ($datapinjam&&$updatestock) {
                // berhasil pinjam
                header("location:peminjaman.php?pesan=berhasilpinjam");
            } else {
                // jika gagal pinjam
                echo '<script>
                alert("Gagal melakukan peminjaman barang !");
                window.location.href="peminjaman.php";    
                </script>';
            }
        } else {
            // jika barang di pinjam tidak mencukupi di stock
            echo '<script>
            alert("Maaf barang stock saat ini tidak mencukupi !");
            window.location.href="peminjaman.php";    
            </script>';
        }

}
?>