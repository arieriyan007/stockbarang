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
                <table id="datatablesSimple">
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
                      $idb = $dk['namabarang'];
                      $qty = $dk['qty'];
                      $tanggal = $dk['tanggal'];
                      $penerima = $dk['penerima'];
                    
                    ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $idb; ?></td>
                      <td><?= $qty; ?></td>
                      <td><?= $tanggal; ?></td>
                      <td><?= $penerima; ?></td>
                      <td>
                        <button class="btn btn-warning btn-sm my-1" title="edit barang">Edit</button>
                        <button class="btn btn-danger btn-sm" title="hapus barang">Hapus</button>
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