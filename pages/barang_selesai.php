<?php 
include "../koneksi.php";

// disini fungsinya jika barang telah selesai dipinjam dan dikembalikan nilai stocknya sesuai yg di pinjam
if (isset($_POST['barangSelesai'])) {
    $idp = $_POST['idpinjam'];
    $idb = $_POST['idbarang'];

    $updatestatus = mysqli_query($koneksi, "UPDATE peminjaman SET status='Kembali' WHERE idpeminjaman='$idp' ");
    
    // cekstock
    $stocksaatini = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang='$idb' ");
    $stocknya = mysqli_fetch_array($stocksaatini);
    $stock = $stocknya['stock'];
    
    // ambil qty/jumlah dari database peminjaman
    $datapinjam = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE idpeminjaman='$idp' ");
    $qtypinjam = mysqli_fetch_array($datapinjam);
    $datapeminjaman = $qtypinjam['qty'];

    // kembalikan stocknya
    $stockkembali = $datapeminjaman+$stock;


    // sebelum selesai jgn lupa kembalikan stocknya
    $kembalikan_stock = mysqli_query($koneksi, "UPDATE stock SET stock='$stockkembali' WHERE idbarang='$idb' ");

    if ($updatestatus&&$kembalikan_stock) {
        // jika berhasil/selesai
        header("location:peminjaman.php?pesan=selesaipinjam");
    } else {
        // jika gagal
        echo '<script>
        alert("Gagal melakukan Update selesai peminjaman barang !");
        window.location.href="peminjaman.php";    
        </script>';
    }
}
?>