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
              <div class="card-body">
                <table id="datatablesSimple">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Tanggal</th>
                      <th>Qty</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <!-- menampilkan database dengan php -->
                    <?php 
                    $no = 1;
                    $datamasuk = mysqli_query($koneksi, "SELECT * FROM masuk m, stock s WHERE s.idbarang = m.idbarang");

                    while ($dm = mysqli_fetch_array($datamasuk)) {
                      $nmbarang = $dm['namabarang'];
                      $qty = $dm['qty'];
                      $tanggal = $dm['tanggal'];
                      $ket = $dm['keterangan'];

                    ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $nmbarang; ?></td>
                      <td><?= $tanggal; ?></td>
                      <td><?= $qty; ?></td>
                      <td><?= $ket; ?></td>
                      <td>
                        <button class="btn btn-warning btn-sm my-1">Edit</button>
                        <button class="btn btn-danger btn-sm">Hapus</button>
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