<?php 
include "../koneksi.php";

if (isset($_POST['deleteUser'])) {
    $idu    = $_POST['idu'];
    $email  = $_POST['email'];
    $pwd    = $_POST['pwd'];

    // delete file di database
    $delete = mysqli_query($koneksi, "DELETE FROM login WHERE iduser='$idu' ");

    if ($delete) {
        header("location:admin.php?pesan=berhasilhapususer");
    } else {
        header("location:admin.php?pesan=gagalhapususer");
    }
 }
?>