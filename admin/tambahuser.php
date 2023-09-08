<?php 
include "../koneksi.php";

if (isset($_POST['addusers'])) {
    $email  = $_POST['email'];
    $pwd    = $_POST['pwd'];

    // masukkan data user baru
    $tambahuser = mysqli_query($koneksi, "INSERT INTO login(email, password) VALUES ('$email', '$pwd')");

    // masukkan if kembali
    if ($tambahuser) {
        header("location:admin.php?pesan=berhasilmenambahkanuser");
    } else {
        header("location:admin.php?pesan=gagalmenambahkanuser");
    }
}
?>