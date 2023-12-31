<?php 
include "../layouts/header.php";
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
//$image = $fetch['image'];

// cek ada gambar atau tidak
$gambar = $fetch['image']; //ambil gambar
if ($gambar==null) {
  // jika tidak ada gambar
  $img = 'No Gambar';
} else {
  // jika ada gambar
  $img = '<img src="../assets/img/'.$gambar.'" class="zoomable">'; //zoomable disini saya membuat costume css dibagian header.php
}

// generate QR dari google dengan akses google qr api -> pilih yg developers.google.com
$urlview = 'http://stockbarang.test/pages/view.php?id='.$idbarang;  //jgn lupa buat jua url dari aplikasi kita dan jgn lupa ID nya kita sambungkan dengan idbarang kita
$qrcode = 'https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl='.$urlview.'&choe=UTF-8'; //hapus bagian Hello%20world dan di masukkan $urlview nya kedalam dengan menggunakan .$urlview.
?>

<div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Stock Detail Barang</h1>
            <ol class="breadcrumb mb-4">
              <marquee behavior="" direction=""><li class="breadcrumb-item active">Dashboard stock saat ini</li></marquee>
            </ol>
            <!-- table -->
            <div class="card mb-4">
              <div class="card-header">
                <div class="col-md-10 mt-2" style="text-align: center;">
                <?= $img; ?> &nbsp;
                <!-- dibagian ini kita panggil image qrnya -->
                <img src="<?= $qrcode; ?>" alt="QR by google api" class="zoomable">
                <h4 class="mt-2"><?= $namabarang; ?></h4>
                </div>
                <div class="card-body">
                  <hr>
                <div class="row">
                  <div class="col-md-2">Deskripsi</div>
                  <div class="col-md-10">: <?= $deskripsi; ?></div>
                </div>
                <div class="row">
                  <div class="col-md-2">Stock</div>
                  <div class="col-md-10">: <?= $stock; ?> <?= $satuan; ?></div>
                </div>
                <hr>

                <!-- Barang Masuk -->
                <h3 class="mt-3 text-start">Barang Masuk</h3>
              <div class="table-responsive">
                <table id="barangMasuk" class="table table-bordered table-striped table-hover" border="1" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Keterangan</th>
                      <th>Quantity</th>
                    </tr>
                  </thead>
              
                  <tbody>
                  <!-- menampilkan isi dari database dengan php -->
                  <?php 
                  $no = 1;
                  $datamasuk = mysqli_query($koneksi, "SELECT  * FROM masuk WHERE idbarang='$idbarang'");
                  while ($m = mysqli_fetch_array($datamasuk)) {
                    $tanggal = $m['tanggal'];
                    $keterangan = $m['keterangan'];
                    $qty = $m['qty'];
                  
                  ?>

                    <tr style="text-align:center"> 
                      <td><?= $no++; ?></td>
                      <td><?= $tanggal; ?></td>
                      <td><?= $keterangan; ?></td>
                      <td><?= $qty; ?></td>
                    </tr>
                  
                    <?php
                  }
                    ?>
                  </tbody>
                </table>
              </div>
                  
              <hr>
              <!-- Barang Keluar -->
              <h3 class="mt-3 text-start">Barang Keluar</h3>
              <div class="table-responsive">
                <table id="barangKeluar" class="table table-bordered table-striped table-hover" border="1" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Penerima</th>
                      <th>Quantity</th>
                    </tr>
                  </thead>
              
                  <tbody>
                  <!-- menampilkan isi dari database dengan php -->
                  <?php 
                  $no = 1;
                  $datakeluar = mysqli_query($koneksi, "SELECT  * FROM keluar WHERE idbarang='$idbarang'");
                  while ($k = mysqli_fetch_array($datakeluar)) {
                    $tanggal = $k['tanggal'];
                    $penerima = $k['penerima'];
                    $qty = $k['qty'];
                  
                  ?>

                    <tr style="text-align:center"> 
                      <td><?= $no++; ?></td>
                      <td><?= $tanggal; ?></td>
                      <td><?= $penerima; ?></td>
                      <td><?= $qty; ?></td>
                    </tr>
                  
                    <?php
                  }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- end table -->
          </div>
        </main>

<?php 
include "../layouts/footer.php ";  
?>