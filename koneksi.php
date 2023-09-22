<?php 
// session
session_start();

//menghilangkan error dan report pada php 
error_reporting(0);
// membuat koneksi ke database
$koneksi = mysqli_connect('localhost','root','','stokbarang');

// jika gagal koneksi
if (mysqli_connect_errno()) {
    echo "<div class='alert alert-danger text-center' role='alert'> Gagal koneksi ke database</div>"; 
}
?>