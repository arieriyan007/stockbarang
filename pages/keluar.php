<?php 
include "../layouts/header.php";
?>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Barang Keluar</h1>
            <ol class="breadcrumb mb-4">
              <marquee behavior="" direction=""><li class="breadcrumb-item active">Informasi semua barang keluar</li></marquee>
            </ol>
            <!-- table -->
            <div class="card mb-4">
              <div class="card-header">
                <!-- button modal bootstrap 5 -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myKeluar">
                <i class="fas fa-plus"></i> Stock keluar
              </button>
              
              <!-- button export -->
                <a href="exportKeluar.php" class="btn btn-info" title="Export data barang keluar" target="_blank">
                  <i class="fas fa-file"></i> Export Laporan</a>
              <!-- akhir button export -->

              <!-- The Modal -->
              <div class="modal fade" id="myKeluar">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Input barang keluar</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <form action="barang_keluar.php" method="post">
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

                      <input type="number" name="qty" class="form-control my-2">
                      <input type="text" name="penerima" class="form-control">
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="addKeluar">Save</button>
                    </div>
                    </form>

                  </div>
                </div>
              </div>
              <!-- akhir botton modal -->

              </div>
              <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Qty</th>
                      <th>Tanggal</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                    <!-- menampilkan data keluar di database -->
                    <?php 
                    $no = 1;
                    $datakeluar = mysqli_query($koneksi,"SELECT * FROM keluar k, stock s WHERE s.idbarang=k.idbarang");
                    while ($dk = mysqli_fetch_array($datakeluar)) {
                      $idk = $dk['idkeluar'];
                      $idb = $dk['idbarang'];
                      $nmbarang = $dk['namabarang'];
                      $qty = $dk['qty'];
                      $tanggal = $dk['tanggal'];
                      $penerima = $dk['penerima'];
                    
                    ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $nmbarang; ?></td>
                      <td><?= $qty; ?></td>
                      <td><?= $tanggal; ?></td>
                      <td><?= $penerima; ?></td>
                      <td>
                        <!-- membuat button modal Edit -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#myEdit<?= $idk; ?>" title="Edit barang">
                         <i class="fas fa-edit"></i> Edit
                        </button>     
                        <!-- The Modal -->
                        <div class="modal fade" id="myEdit<?= $idk; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <form action="editKeluar.php" method="post">
                              <div class="modal-header">
                                <h4 class="modal-title">Edit data Barang keluar</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                                <input type="hidden" name="idk1" value="<?= $idk; ?>">
                                <input type="hidden" name="idb1" value="<?= $idb; ?>">

                                <input type="text" name="nmbarang1" class="form-control" value="<?= $nmbarang; ?>" disabled>
                                <input type="number" name="qty1" class="form-control my-1" value="<?= $qty; ?>">
                                <input type="text" name="penerima1" class="form-control" value="<?= $penerima; ?>">
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="updateKeluar" data-bs-dismiss="modal">Save</button>
                              </div>
                              </form>

                            </div>
                          </div>
                        </div>
                        <!-- akhir button modal edit -->

                        <!-- button hapus modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#myHapus<?= $idk; ?>" title="Delete/hapus barang">
                         <i class="fas fa-trash"></i> Hapus
                        </button>  
                        
                        <!-- The Modal -->
                          <div class="modal fade" id="myHapus<?= $idk; ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Modal Heading</h4>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <form action="deleteKeluar.php" method="post">
                                <div class="modal-body">
                                  Apakah yakin ingin mengahapus barang ini : <b><?= $nmbarang; ?></b> ?
                                  <input type="hidden" name="idk" value="<?= $idk; ?>">
                                  <input type="hidden" name="qty" value="<?= $qty; ?>">
                                    <input type="hidden" name="idb" value="<?= $idb; ?>">
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary btn-sm" data-bs-dismiss="modal" name="delKeluar">hapus</button>
                                </div>
                                </form>

                              </div>
                            </div>
                          </div>
                        <!-- akhir hapus modal -->
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