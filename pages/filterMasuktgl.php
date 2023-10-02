<?php 
include "../koneksi.php";

if (isset($_POST['filtertgl'])) {
    $mulai = $_POST['tglMulai'];
    $akhir = $_POST['tglAkhir'];
    // disini khusus untuk memfilter berdasarkan tanggal maka kita bisa tambahkan between dan DATE_ADD(variabel, INTERVAL 1 DAY), agar kehitung 1 hari akhirnya 
    $datamasuk = mysqli_query($koneksi, "SELECT * FROM masuk m, stock s, login l WHERE s.idbarang = m.idbarang  AND tanggal BETWEEN '$mulai' AND DATE_ADD($akhir,INTERVAL 1 DAY) ORDER BY idmasuk DESC");
} else {
    $datamasuk = mysqli_query($koneksi, "SELECT * FROM masuk m, stock s, login l WHERE s.idbarang = m.idbarang ORDER BY idmasuk DESC");
}
?>