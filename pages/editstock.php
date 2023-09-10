<?php 
include "../koneksi.php";

if (isset($_POST['updateStock'])) {
    $idbarang = $_POST['idb'];
    $nmbarang = $_POST['nbarang'];
    $deskripsi = $_POST['deskripsi'];
    $satuan = $_POST['satuan'];

    // cek data gambar di database
    $allow_extension = array ('png', 'jpg');
    $namafile = $_FILES['file']['name']; //ambil nama gambarnya
    $dot = explode('.', $namafile);
    $ekstensi = strtolower(end($dot)); //ambil ekstensinya
    // ukuran file dan membuat lokasi penyimpanan
    $ukuranfile = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    // penamaan file -> enkripsi dan menggabungkan nama file dengan ektensinya
    $image = md5(uniqid($namafile, true) . time()).'.'.$ekstensi; 

    //di sini kita melakukan validasi yang mana jika sudah ada gambar trs mau dimau diganti bisa diganti ynag baru
    // jika tidak ingin dinganti maka tidak adfa perubahan apa pun dengan gambarnya.
    if ($ukuranfile==0) {
        //jika tidak ingin di upload
        $updatestock = mysqli_query($koneksi, "UPDATE stock SET namabarang='$nmbarang', deskripsi='$deskripsi', satuan='$satuan' WHERE idbarang='$idbarang' ");

        // cek update apakah berhasil atau tidak
        if ($updatestock) {
                header('location:index.php?pesan=berhasilUpdate');
            } else {
                header('location:index.php?pesan=gagalUpdate');
            }

    } else {
         //jika ingin diganti
         move_uploaded_file($file_tmp, '../assets/img/'.$image);
         $updatestock = mysqli_query($koneksi, "UPDATE stock SET namabarang='$nmbarang', satuan='$satuan', image='$image',deskripsi='$deskripsi' WHERE idbarang='$idbarang' ");
        // cek update apakah berhasil atau tidak
        if ($updatestock) {
                header('location:index.php?pesan=berhasilUpdate');
            } else {
                header('location:index.php?pesan=gagalUpdate');
            }
        }
}
?>