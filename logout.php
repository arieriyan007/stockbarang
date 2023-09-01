<?php 
session_start();

session_destroy();

//kembali kehalaman login 
header('location:index.php?status=logout');
?>