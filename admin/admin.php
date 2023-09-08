<?php 
include "../layouts/header.php";
?>

<div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Admin</h1>
            <ol class="breadcrumb mb-4">
              <marquee behavior="" direction=""><li class="breadcrumb-item active">Dashboard data akses akun</li></marquee>
            </ol>
            <!-- table -->
            <div class="card mb-4">
              <!-- membuat button modal bootstrap 5 -->
              <div class="card-header">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myUser">
              <i class="fas fa-user-plus"></i> Tambah user
            </button>
              </div>

              <!-- The Modal -->
            <div class="modal fade" id="myUser">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">User Baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <!-- Modal body -->
                  <form action="tambahuser.php" method="post">
                  <div class="modal-body">
                    <input type="email" name="email" placeholder="email@gmail.com" class="form-control my-2" autofocus required>
                    <input type="password" name="pwd" placeholder="Input Password" class="form-control my-2" required>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="addusers">Save</button>
                  </div>
                  </form>

                </div>
              </div>
            </div>
              <!-- akhir button modal -->
              <div class="card-body">                
              <!-- akhir notifikasi -->
                <table id="datatablesSimple" class="table table-bordered" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Email</th>
                      <th>Password</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
              
                  <tbody>
                  <!-- menampilkan isi dari database dengan php -->
                  <?php 
                  $no = 1;
                  $datauser = mysqli_query($koneksi, "SELECT * FROM login");

                  while ($l = mysqli_fetch_array($datauser)) {
                    $idu = $l['iduser'];
                    $email = $l['email'];
                    $pwd = $l['password'];
                  ?>

                    <tr class="d-flex justify-content-center text-center">
                      <td><?= $no++; ?></td>
                      <td><?= $email; ?></td>
                      <td><?= $pwd; ?></td>
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
                              <form action="editstock.php" method="post">
                                <div class="modal-body">
                                    <b><span class="text-muted d-flex justify-content-center"> Edit stock hanya bisa dirubah nama barang dan deskripsi saja</span></b>
                                <input type="text" name="nbarang" value="<?= $nmbarang; ?>" class="form-control my-2" autofocus>
                                <input type="text" name="deskripsi" value="<?= $deskripsi; ?>" class="form-control my-2" required>
                                <input type="number" name="stock" class="form-control" value="<?= $stock; ?>" required disabled>
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
include "../layouts/footer.php"
?>