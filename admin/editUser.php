<?php 
include "../koneksi.php";

if (isset($_POST['updateUser'])) {
    $idu    = $_POST['idu'];
    $email  = $_POST['email'];
    $pwd    = $_POST['inipwd'];

    // update ke dalam database
    $update = mysqli_query($koneksi, "UPDATE login SET email='$email', password='$pwd' WHERE iduser='$idu'");

    // kembali kehalaman admin
    if ($update) {
        header("location:admin.php?pesan=berhasilupdateuser");
    } else {
        header("location:admin.php?pesan=gagalupdateuser");
    }
}
?>