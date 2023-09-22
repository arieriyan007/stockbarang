<?php 
include "../layouts/header.php";
?>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Barang Masuk</h1>
            <ol class="breadcrumb mb-4">
              <marquee><li class="breadcrumb-item active">Informasi semua barang masuk</li></marquee>
            </ol>

            <!-- table -->
            <div class="card mb-4">
              <div class="card-header">
                <!-- tambah barang masuk -->
                  <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#myMasuk">
                    <i class="fas fa-plus"></i> Stock masuk
                  </button>
                  <!-- button laporan export -->
                  <a href="exportMasuk.php" class="btn btn-success" target="_blank" title="Laporan masuk export">
                        <i class="fas fa-file"></i> Export laporan</a>
                      <!-- akhir laporan -->
                  <!-- The Modal -->
                  <div class="modal fade" id="myMasuk">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Tambah barang masuk</h4>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <form action="barangMasuk.php" method="post">
                        <div class="modal-body">
                          <!-- membuat select data -->
                          <select name="barangMasuk" id="barangMasuk" class="form-control">
                            <?php 
                            $db_barang = mysqli_query($koneksi,"SELECT * FROM stock");
                            while ($b = mysqli_fetch_array($db_barang)) {
                              $nmbarang = $b['namabarang'];
                              $idbr = $b['idbarang'];

                            ?>
                            <option value="<?= $idbr; ?>"><?= $nmbarang; ?></option>

                            <?php 
                            }
                            ?>
                          </select>
                          <!-- akhir select data -->

                          <input type="number" name="qty" placeholder="Jumlah barang masuk" class="form-control my-2" required>
                          <input type="text" name="ket" placeholder="Keterangan Pembelian" class="form-control" required>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary" name="addMasuk">Save</button>
                        </div>
                        </form>

                      </div>
                    </div>
                  </div>
                                   
              <!-- akhir barang masuk -->
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
                <!-- notifikasi/alert  -->
                <?php 
                if (isset($_GET['pesan'])) {
                  if ($_GET['pesan']=="berhasil") {
                    echo "<div class='alert alert-info alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>Info !</strong> Barang masuk telah ditambahkan.
                  </div>";
                  } elseif ($_GET['pesan']=="gagal") {
                    echo "<div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>Warning !</strong> Barang masuk gagal ditambahkan.
                  </div>";
                  } elseif ($_GET['pesan']=="datadihapus") {
                    echo "<div class='alert alert-warning alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>Info !</strong> Barang masuk telah dihapus !
                  </div>";
                  } elseif ($_GET['pesan']=="gagaldihapus") {
                    echo "<div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>warning !</strong> Barang masuk gagal dihapus !.
                  </div>";
                  } elseif ($_GET['pesan']=="berhasilupdate") {
                    echo "<div class='alert alert-info alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>Info !</strong> Barang masuk berhasil diedit.
                  </div>";
                  } elseif ($_GET['pesan']=="gagalupdate") {
                    echo "<div class='alert alert-warning alert-dismissible'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    <strong>warning !</strong> Barang masuk gagal diedit.
                  </div>";
                  }
                }
                ?>
                <!-- akhir notifikasi -->
                <table id="datatablesSimple" class="table table-bordered table-hover table-responsive" border="1">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Gambar</th>
                      <th>Nama Barang</th>
                      <th>Tanggal</th>
                      <th>Qty</th>
                      <th>Satuan</th>
                      <th>Keterangan</th>
                      <th>User</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  <!-- menampilkan database dengan php -->
                    <?php 
                    
                    if (isset($_POST['filterTgl'])) {
                        $mulai = $_POST['tglMulai'];
                        $akhir = $_POST['tglAkhir'];
                        // disini khusus untuk memfilter berdasarkan tanggal maka kita bisa tambahkan between dan DATE_ADD(variabel, INTERVAL 1 DAY), agar kehitung 1 hari akhirnya 
                        $datamasuk = mysqli_query($koneksi, "SELECT * FROM masuk m, stock s, login l WHERE s.idbarang = m.idbarang AND m.iduser = l.iduser AND tanggal BETWEEN '$mulai' AND DATE_ADD('$akhir',INTERVAL 1 DAY) ORDER BY idmasuk DESC");
                    } else {
                      // jika tidak ada maka data dikembalikan secara berurutan
                        $datamasuk = mysqli_query($koneksi, "SELECT * FROM masuk m, stock s, login l WHERE s.idbarang = m.idbarang AND m.iduser = l.iduser ORDER BY idmasuk DESC");
                    }

                    $no = 1;
                    $datamasuk = mysqli_query($koneksi, "SELECT * FROM masuk m, stock s, login l WHERE s.idbarang = m.idbarang AND m.iduser = l.iduser ORDER BY idmasuk DESC");
                    
                    while ($dm = mysqli_fetch_array($datamasuk)) {
                      $idm = $dm['idmasuk'];
                      $idb = $dm['idbarang'];
                      $idu = $dm['email'];
                      $nmbarang = $dm['namabarang'];
                      $qty = $dm['qty'];
                      $satuan = $dm['satuan'];
                      $tanggal = $dm['tanggal'];
                      $ket = $dm['keterangan'];

                      // cek ada gambar atau tidak
                      $gambar = $dm['image']; //ambil gambar
                      if ($gambar==null) {
                        // jika tidak ada gambar
                        $img = 'No Gambar';
                      } else {
                        // jika ada gambar
                        $img = '<img src="../assets/img/'.$gambar.'" class="zoomable">'; //zoomable disini saya membuat costume css dibagian atas
                      }
                      
                      ?>
                    <tr>
                      <td style="text-align: center;"><?= $no++?></td>
                      <td><?= $img; ?></td>
                      <td><?= $nmbarang; ?></td>
                      <td><?= $tanggal; ?></td>
                      <td><?= $qty; ?></td>
                      <td><?= $satuan; ?></td>
                      <td><?= $ket; ?></td>
                      <td><?= $idu; ?></td>
                      <td>
                        <!-- button edit -->
                      <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $idm; ?>" title="Edit barang">
                          <i class="fas fa-edit"></i> Edit
                      </button>
                      
                      <!-- Edit Modal  -->
                      <div class="modal fade" id="edit<?= $idm; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Edit Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Stock</h4> <br>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              
                              <!-- Edit body -->
                              <form action="editMasuk.php" method="post">
                                <div class="modal-body">
                                <input type="text" name="nmbarang" class="form-control" value="<?= $nmbarang; ?>" disabled>
                                <input type="number" name="qty" class="form-control my-1" value="<?= $qty; ?>">
                                <input type="text" name="keterangan" class="form-control" value="<?= $ket; ?>">
                                <!-- lakukan parsing sebagai tanda pengeal di idbarang -->
                                <input type="hidden" name="idm" value="<?= $idm; ?>">
                                <input type="hidden" name="idb" value="<?= $idb; ?>">
                              </div>

                              <!-- Edit footer -->
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="updateMasuk">Update</button>
                              </div>
                              </form>

                            </div>
                          </div>
                        </div>
                        <!-- akhir button edit -->

                        <!-- button hapus/delete -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#del<?= $idm; ?>" title="Delete/hapus barang">
                          <i class="fas fa-trash"></i> Hapus
                      </button>

                      <!-- Hapus Modal  -->
                      <div class="modal fade" id="del<?= $idm; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Hapus Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Hapus Stock</h4> <br>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              
                              <!-- Hapus body -->
                              <form action="hapusMasuk.php" method="post">
                                <div class="modal-body">
                                Yakin ingin menghapus barang ini : <b><?= $nmbarang; ?></b> !
                                <!-- lakukan parsing sebagai tanda pengeal di idbarang -->
                                <input type="hidden" name="idm" value="<?= $idm; ?>">
                                <input type="hidden" name="idbarang" value="<?= $idb; ?>">
                                <input type="hidden" name="quantity" value="<?= $qty; ?>">
                              </div>

                              <!-- Hapus footer -->
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-danger" name="delMasuk">Hapus</button>
                              </div>
                              </form>

                            </div>
                          </div>
                        </div>
                        <!-- akhir button delete -->
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
include "../layouts/footer.php";
?>