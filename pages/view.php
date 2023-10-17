<?php 
include "../koneksi.php";
// ambil id barangnya, berikut cara mengGet id barangnya
$idbarang = $_GET['id'];

// selanjutnya Get informasi barang berdasarkan databasenya
$get = mysqli_query($koneksi, "SELECT * FROM stock WHERE idbarang='$idbarang'");
$fetch = mysqli_fetch_array($get);
// set variabelnya
$namabarang = $fetch['namabarang'];
$deskripsi = $fetch['deskripsi'];
$stock = $fetch['stock'];
$satuan = $fetch['satuan'];
$image = $fetch['image'];

// cek ada gambar atau tidak
$gambar = $fetch['image']; //ambil gambar
if ($gambar==null) {
  // jika tidak ada gambar
  $img = 'No Gambar';
} else {
  // jika ada gambar
  $img = '<img class="card-img-top" src="../assets/img/'.$gambar.'" alt="Card image" style="width:100%">'; //zoomable disini saya membuat costume css dibagian header.php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Menampilkan barang </title>
</head>
<body>
    <div class="container mt-4">  
            <h2 class="text-center">Detail Barang</h2>
              <!-- <p>Image at the top (card-img-top):</p> -->
              <div class="card mx-auto" style="width:400px">
              <!-- panggil gambarnya -->
                <?= $img; ?>
                <div class="card-body">
                  <h3 class="card-title text-center"><?= $namabarang; ?></h3>
                  <p class="card-text text-center"><?= $deskripsi; ?></p>
                  <h4 class="card-text text-center"><?= $stock; ?> : <?= $satuan; ?></h4>   
                </div>
              </div>
    </div>
</body>
</html>