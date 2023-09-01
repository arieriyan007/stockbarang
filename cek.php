<?php 
// jika belum login maka silakan login terlebih dahulu

if (isset($_SESSION['log'])) {
    
} else {
    header('location:../index.php');
}
?>