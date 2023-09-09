<?php 
include "../layouts/header.php";
?>
<script type="text/javascript" src="../js/jquery.js"></script>
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
                    <input type="password" name="pwd" id="pwd1" placeholder="Input Password" class="form-control my-2" required>
                    <input type="checkbox" class="form-checkbox" onclick="myFunction()"> show password
                  </div>

                  <!-- membuat javascript sebagai liat password  -->
                  <script>
                    function myFunction() {
                      var x = document.getElementById("pwd1");
                      if (x.type === "password") {
                        x.type = "text";
                      } else {
                        x.type = "password";
                      }
                    }
                  </script>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="addusers">Save</button>
                  </div>
                  </form>

                </div>
              </div>
            </div>
              <!-- akhir button modal -->
              <div class="card-body table-responsive">                
                <table id="datatablesSimple" class="table table-bordered table-striped" cellspacing="0" border="1" width="600px">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Email</th>
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

                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $email; ?></td>
                      <td>
                        <!-- hidden untuk id User -->
                        <input type="hidden" name="iduser" value="<?= $idu; ?>">

                        <!-- membuat button edit dengan modal boostrap 5 -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $idu; ?>" title="Edit user">
                          <i class="fas fa-user-edit"></i> Edit
                        </button>

                        <!-- Edit Modal  -->
                        <div class="modal fade" id="edit<?= $idu; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Edit Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Edit User</h4> <br>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              
                              <!-- Edit body -->
                              <form action="editUser.php" method="post">
                                <div class="modal-body">
                                    <!-- lakukan parsing sebagai tanda pengenal di iduser -->
                                    <input type="hidden" name="idu" value="<?= $idu; ?>">
                                <input type="email" name="email" value="<?= $email; ?>" class="form-control my-2" autofocus>
                                <input type="password" name="inipwd" id="pwdKlik" value="<?= $pwd; ?>" class="form-password form-control">
                                <input type="checkbox" class="form-checkbox"> show password
                                <!-- membuat script untuk cekbox ada 2 cara menggunakan javascript atau menggunakan jquery-->
                                <!-- dibawah ini menggunakan javascript -->
                                <!-- <script>
                                    function myFunction() {
                                        var x = document.getElementById("pwdKlik");
                                        if (x.type === "password") {
                                            x.type = "text";
                                        } else {
                                            x.type = "password";
                                        }
                                    }
                                </script> -->
                                <!-- sedangkan ini menggunakan jquery -->
                                <script type="text/javascript">
                                    $(document).ready(function(){		
                                        $('.form-checkbox').click(function(){
                                            if($(this).is(':checked')){
                                                $('.form-password').attr('type','text');
                                            }else{
                                                $('.form-password').attr('type','password');
                                            }
                                        });
                                    });
                                </script>
                                <!-- akhir script untuk melihat/show password -->
                                </div>
                              <!-- Edit footer -->
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="updateUser">Update</button>
                              </div>
                              </form>

                            </div>
                          </div>
                        </div>
                        <!-- akhir edit -->

                        <!-- button hapus -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $idu; ?>" title="Delete user">
                          <i class="fas fa-user-slash"></i> Delete
                        </button>

                        <!-- Delete Modal  -->
                        <div class="modal fade" id="delete<?= $idu; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Delete Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Hapus User</h4> <br>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              
                              <!-- Delete body -->
                              <form action="deleteUser.php" method="post">
                                <div class="modal-body">
                                  <h5 class="modal-title">Apakah yakin ingin mengapus <i><?= $email; ?></i> ini ?</h5>
                                  <input type="hidden" name="idu" value="<?= $idu; ?>">
                              </div> 

                              <!-- Delete footer -->
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="deleteUser">Delete</button>
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