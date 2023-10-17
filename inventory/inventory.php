<?php 
include "../layouts/header.php";
?>

<div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Inventory IT</h1>
            <ol class="breadcrumb mb-4">
              <marquee behavior="" direction=""><li class="breadcrumb-item active">Dashboard inventory saat ini</li></marquee>
            </ol>
            <!-- table -->
            <div class="card mb-4">
              <!-- membuat button modal bootstrap 5 -->
              <div class="card-header">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myInv">
              <i class="fas fa-plus"></i> Inventory baru
            </button>

             <!-- button export/report --> 
             <a href="export.php" class="btn btn-success" target="_blank" title="export laporan stock">
              <i class="fas fa-print"></i> Export data
             </a>
              <!-- akhir button export -->
              </div>

              <!-- The Modal -->
            <div class="modal fade" id="myInv">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Barang inventory baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <!-- Modal body -->
                  <!-- membuat upload gambar/data bisa ditambahkan enctype="multipart/form-data" -->
                  <form action="tambahinv.php" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <input type="text" name="nobar" placeholder="No Inventory" class="form-control my-2" autofocus required>
                    <input type="text" name="namabar" placeholder="Nama Barang" class="form-control my-2" required>
                    <input type="text" name="merk" class="form-control" placeholder="Merk barang" required>
                    <input type="date" name="tglpem" class="form-control my-2" placeholder="Tanggal Pembelian" required>
                    <input type="file" name="file" class="form-control" aria-label="Upload gambar" required>
                    <div class="invalid-feedback">silahkan upload gambar</div>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="addinv">Save</button>
                  </div>
                  </form>

                </div>
              </div>
            </div>
              <!-- akhir button modal -->

              <div class="card-body">  
              
              <!-- notifikasi update dan dan delete -->
              <?php 
              if (isset($_GET['pesan'])) {
                if ($_GET['pesan']=="berhasil_ditambahkan") {
                  echo "<div class='alert alert-info alert-dismissible'>
                  <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                  <strong>Info !</strong> Stock baru telah ditambahkan.
                </div>";
                } elseif ($_GET['pesan']=="data_gagal") {
                  echo "<div class='alert alert-danger alert-dismissible'>
                  <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                  <strong>warning !</strong> Stock baru gagal ditambah.
                </div>";
                } elseif ($_GET['pesan']=="berhasilUpdate") {
                  echo "<div class='alert alert-success alert-dismissible'>
                  <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                  <strong>Info !</strong> Data barang berhasil dirubah/edit.
                </div>";
                } elseif ($_GET['pesan']=="gagalUpdate") {
                  echo "<div class='alert alert-danger alert-dismissible'>
                  <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                  <strong>Warning !</strong> Data barang gagal diupdate.
                </div>";
                } elseif ($_GET['pesan']=="dihapus") {
                  echo "<div class='alert alert-warning alert-dismissible'>
                  <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                  <strong>Warning !</strong> Data barang berhasil dihapus.
                </div>";
                }
              }
              ?>
              <!-- akhir notifikasi udpdate -->
                <!-- alert/ notifikasi jika barang stock 0 atau habis -->
                <?php 
                $datastock = mysqli_query($koneksi, "SELECT  * FROM stock WHERE stock < 5");
                // gunakan while sebagai looping dan perulangan data
                while ($s = mysqli_fetch_array($datastock)) {
                  // buat variabel baru untuk nama barangnya, variabel ambil datanya memalui database
                  $barang = $s['namabarang'];
                
                ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Info !</strong> Stock barang <b><?= $barang; ?></b> hampir habis !, segera lakukan pengorderan <?= $barang; ?>
              </div>
                <?php 
                }
                ?>
              <!-- akhir notifikasi -->
                <table id="datatablesSimple" class="table table-bordered table-striped table-hover" border="1" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No inventory</th>
                      <th>Gambar</th>
                      <th>Nama barang</th>
                      <th>Merk</th>
                      <th>Tgl Pembelian</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
              
                  <tbody>
                  <!-- menampilkan isi dari database dengan php -->
                  <?php 
                  $datainv = mysqli_query($koneksi, "SELECT * FROM inventory");

                  while ($s = mysqli_fetch_array($datainv)) {
                    $idi = $s['idinventory'];
                    $nobra = $s['no_barang'];
                    $nmbarang = $s['namabarang'];
                    $merk = $s['merk'];
                    $tglP = $s['tgl_pembelian'];

                    // cek ada gambar atau tidak
                    $image = $s['image']; //ambil gambar
                    if ($image==null) {
                      // jika tidak ada gambar
                      $img = 'No Gambar';
                    } else {
                      // jika ada gambar
                      $img = '<img src="../assets/img/'.$image.'" class="zoomable">'; //zoomable disini saya membuat costume css dibagian header.php
                    }
                  ?>

                    <tr style="text-align:center"> 
                      <td><?= $nobra; ?></td>
                      <td><?= $img; ?></td>
                      <td><?= $nmbarang; ?></td>
                      <td><?= $merk; ?></td>
                      <td><?= $tglP; ?></td>
                      <td>
                        <!-- hidden untuk id barang -->
                        <input type="hidden" name="idbarang" value="<?= $idb; ?>">

                        <!-- membuat button edit dengan modal boostrap 5 -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $idb; ?>" title="Edit barang">
                          <i class="fas fa-edit"></i> Edit
                        </button>

                        <!-- Edit Modal  -->
                        <div class="modal fade" id="edit<?= $idb; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Edit Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Stock</h4> <br>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              
                              <!-- Edit body -->
                              <!-- dibagian edit jangan lupa juga masukkan enctype="multipart/form-data" -->
                              <form action="editstock.php" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <b><span class="text-muted d-flex justify-content-center"> Edit stock hanya bisa dirubah nama barang dan deskripsi saja</span></b>
                                <input type="text" name="nbarang" value="<?= $nmbarang; ?>" class="form-control my-2" autofocus>
                                <input type="text" name="deskripsi" value="<?= $deskripsi; ?>" class="form-control my-2" required>
                                <input type="number" name="stock" class="form-control" value="<?= $stock; ?>" required disabled>
                                <input type="text" name="satuan" class="form-control my-2" value="<?= $satuan; ?>">
                                <input type="file" name="file" id="gambar" class="form-control">
                                <div class="invalid-feedback">silahkan upload gambar !</div>
                                <!-- lakukan parsing sebagai tanda pengeal di idbarang -->
                                <input type="hidden" name="idb" value="<?= $idb; ?>">
                              </div>

                              <!-- Edit footer -->
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="updateStock">Update</button>
                              </div>
                              </form>

                            </div>
                          </div>
                        </div>
                        <!-- akhir edit -->

                        <!-- button hapus -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $idb; ?>" title="Delete barang">
                          <i class="fas fa-trash"></i> Delete
                        </button>

                        <!-- Delete Modal  -->
                        <div class="modal fade" id="delete<?= $idb; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Delete Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Hapus stock</h4> <br>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              
                              <!-- Delete body -->
                              <form action="deleteStock.php" method="post">
                                <div class="modal-body">
                                  <h4 class="modal-title">Apakah yakin ingin mengapus <i><?= $nmbarang; ?></i> ini ?</h4>
                                  <!-- passing juga agar id barang saat di delete bisa dikenali -->
                                  <input type="hidden" name="idb" value="<?= $idb; ?>">
                              </div> 

                              <!-- Delete footer -->
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="deleteStock">Delete</button>
                              </div>
                              </form>

                            </div>
                          </div>
                        </div>
                        <!-- akhir hapus/delete -->
                      </td> 
                    </tr>
                  
                    <?php
                  }
                    ?>
                    <!-- akhir tampilan database stock -->
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