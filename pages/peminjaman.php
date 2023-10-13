<?php 
include "../layouts/header.php";
?>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Peminjaman Barang</h1>
            <ol class="breadcrumb mb-4">
              <marquee behavior="" direction=""><li class="breadcrumb-item active">Informasi peminjaman barang</li></marquee>
            </ol>
            <!-- table -->
            <div class="card mb-4">
              <div class="card-header">
                <!-- button modal bootstrap 5 -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myPinjam">
                <i class="fas fa-plus"></i> Peminjaman baru
              </button>
              
              <!-- button export -->
                <a href="#" class="btn btn-info" title="Export data barang keluar" target="_blank">
                  <i class="fas fa-file"></i> Export Laporan</a>
              <!-- akhir button export -->

              <!-- The Modal -->
              <div class="modal fade" id="myPinjam">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah data peminjaman</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <form action="pinjam_keluar.php" method="post">
                    <div class="modal-body">
                      <!-- select databarang stock -->
                      <select name="nmbarang" id="nmbarang" class="form-control">
                        <?php 
                        $db_barang = mysqli_query($koneksi, "SELECT * FROM stock");
                        while ($bk = mysqli_fetch_array($db_barang)) {
                          $nmb = $bk['namabarang'];
                          $idb = $bk['idbarang'];
                        ?>
                          <option value="<?= $idb; ?>"><?= $nmb; ?></option>  
                        <?php 
                        }
                        ?>
                      </select>
                      <!-- akhir select barang keluar -->

                      <input type="number" name="qty" class="form-control my-2" placeholder="jumlah barang dipinjam">
                      <input type="text" name="penerima" class="form-control" placeholder="Penerima barang">
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="addPinjam">Simpan</button>
                    </div>
                    </form>

                  </div>
                </div>
              </div>
              <!-- akhir botton modal -->
              </div>

              <!-- membuat filter tanggal  -->
              <div class="row mt-2">
                  <div class="col-md-6">
                  <b class="d-flex justify-content-center text-center mb-2">Filter tanggal mulai dan tanggal akhir</b>
                    <form method="POST" class="d-flex form-inline" style="align-items: space-between;">
                    &nbsp;&nbsp;&nbsp; <input type="date" name="tglMulai" class="form-control d-flex ml-3" title="Tanggal Mulai"> &nbsp;
                      <input type="date" name="tglAkhir" class="form-control" title="Tanggal Akhir">
                      &nbsp; <button name="filterTgl" type="submit" class="btn btn-info">Filter</button>
                    </form>
                  </div>
                </div>

              <div class="card-body">
                <!-- notifikasi/alert -->
                <?php 
                if (isset($_GET['pesan'])) {
                  if ($_GET['pesan']=="berhasil") {
                    echo "<div class='alert alert-info alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>Info !</strong> Barang keluar berhasil ditambahkan.
                  </div>";
                  } elseif ($_GET['pesan']=="gagalkeluar") {
                    echo "<div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>Warning !</strong> Barang gagal keluar !.
                  </div>";
                  } elseif ($_GET['pesan']=="updatekeluarberhasil") {
                    echo "<div class='alert alert-info alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>Info !</strong> Barang keluar berhasil di update.
                  </div>";
                  } elseif ($_GET['pesan']=="gagalupdatekeluar") {
                    echo "<div class='alert alert-warning alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>Warning !</strong> Barang keluar gagal diedit.
                  </div>";
                  } elseif ($_GET['pesan']=="berhasilhapuskeluar") {
                    echo "<div class='alert alert-info alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>Info !</strong> Barang keluar berhasil dihapus.
                  </div>";
                  } elseif ($_GET['pesan']=="gagalhapuskeluar") {
                    echo "<div class='alert alert-warning alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>Warning !</strong> Barang keluar gagal dihapus.
                  </div>";
                  }
                }
                ?>
                <!-- akhit notifikasi -->
                <table id="datatablesSimple" class="table table-bordered table-hover" border="1">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Gambar</th>
                      <th>Nama Barang</th>
                      <th>Qty</th>
                      <th>Satuan</th>
                      <th>Tanggal</th>
                      <th>Penerima</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                    <!-- menampilkan data keluar di database -->
                    <?php 
                    $no = 1;
                    if (isset($_POST['filterTgl'])) {
                      $mulai = $_POST['tglMulai'];
                      $akhir = $_POST['tglAkhir'];

                      if ($mulai!=null || $akhir!=null) { //if disini berfungsi, jika filter tidak memilih tanggal maka tampilkan semua data masuk. baru lanjut skrip dibawah
                        // disini khusus untuk memfilter berdasarkan tanggal maka kita bisa tambahkan between dan DATE_ADD(variabel, INTERVAL 1 DAY), agar kehitung 1 hari akhirnya 
                        $datakeluar = mysqli_query($koneksi, "SELECT * FROM peminjaman p, stock s WHERE s.idbarang = p.idbarang AND tgl_pinjam BETWEEN '$mulai' AND DATE_ADD('$akhir',INTERVAL 1 DAY) ORDER BY idpeminjaman DESC");
                      } else {
                        // jika tidak ada maka data dikembalikan secara berurutan
                      $datakeluar = mysqli_query($koneksi, "SELECT * FROM peminjaman p, stock s WHERE s.idbarang = p.idbarang ORDER BY idpeminjaman DESC");
                      }
                  } else {
                    // jika tidak ada maka data dikembalikan secara berurutan
                      $datakeluar = mysqli_query($koneksi, "SELECT * FROM peminjaman p, stock s WHERE s.idbarang = p.idbarang ORDER BY idpeminjaman DESC");
                  }
              
                    while ($dk = mysqli_fetch_array($datakeluar)) {
                      $idp = $dk['idpeminjaman'];
                      $idb = $dk['idbarang'];
                      $nmbarang = $dk['namabarang'];
                      $satuan = $dk['satuan'];
                      $tgl = $dk['tgl_pinjam'];
                      $qty = $dk['qty'];
                      $peminjam = $dk['peminjam'];
                      $status = $dk['status'];

                      // cek ada gambar atau tidak
                      $gambar = $dk['image']; //ambil gambar
                      if ($gambar==null) {
                        // jika tidak ada gambar
                        $img = 'No Gambar';
                      } else {
                        // jika ada gambar
                        $img = '<img src="../assets/img/'.$gambar.'" class="zoomable">'; //zoomable disini saya membuat costume css dibagian header.php
                      }
                    
                    ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $img; ?></td>
                      <td><?= $nmbarang; ?></td>
                      <td><?= $qty; ?></td>
                      <td><?= $satuan; ?></td>
                      <td><?= $tgl; ?></td>
                      <td><?= $peminjam; ?></td>
                      <td><?= $status; ?></td>
                      <td>
                        <?php 
                        if ($status=='Dipinjam') {
                            echo '<!-- membuat button modal Edit -->
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#myEdit'.$idk.'" title="Edit barang">
                             <i class="fas fa-stamp"></i> Selesai
                            </button>';
                        } else {
                            // jika statusnya kembali
                            echo '';
                        }
                        ?>
                        
                        <!-- The Modal -->
                        <div class="modal fade" id="myEdit<?= $idp; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <form action="barang_selesai.php" method="post">
                              <div class="modal-header">
                                <h4 class="modal-title">Peminjaman selesai</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                                Apakah barang ini sudah selesai dipinjam ? <b><?= $nmbarang; ?></b>
                                <input type="hidden" name="idpinjam" value="<?= $idp; ?>">
                                <input type="hidden" name="idbarang" value="<?= $idb; ?>">
    
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="barangSelesai" data-bs-dismiss="modal">Selesai</button>
                              </div>
                              </form>

                            </div>
                          </div>
                        </div>
                        <!-- akhir button modal edit -->
                      </td>
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
require "../layouts/footer.php";
?>