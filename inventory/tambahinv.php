<?php 
include "../koneksi.php";

if (isset($_POST['addinv'])) {
    $noinv      = $_POST['nobar'];
    $nmbarang   = $_POST['namabar'];
    $merk       = $_POST['merk'];
    $tglP       = $_POST['tglpem'];

    // memasukkan file extension gambar saja yg boleh di upload
    $allow_extension = array('jpg', 'png');
    $nama = $_FILES['file']['name']; 
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot));

    // ukuran gambar
    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // penamaan file ditambah dengan enksripsi menggunakan md5
    $image = md5(uniqid($nama,true) . time()). '.'.$ekstensi;

    if (in_array($ekstensi, $allow_extension) === true) {
        //validasi ukuran filenya
        if ($ukuran < 2000000) {
            move_uploaded_file($file_tmp, '../assets/img/'.$image);

            $addinventory = mysqli_query($koneksi, "INSERT INTO inventory (no_barang, namabarang, merk, tgl_pembelian, image) VALUES ('$noinv', '$nmbarang', '$merk', '$tglP', '$image' )");
            if ($addinventory) {
                header("location:inventory.php?pesan=berhasilditambah");
            } else {
                echo "<div class='alert alert-warning text-center'>Inventory gagal ditambahkan !</div>"; 
                echo "<meta http-equiv=refresh content=2;URL='inventory.php'>";
            }
        } else {
            echo '<script>
            alert("Ukuran file terlalu besar melebihi 2 Mb");
            window.location.href="inventory.php";
            </script>';
        }
    } else {
        echo '<script>
            alert("File bukan jpg/png, pastikan yg diupload adalah image/gambar");
            window.location.href="inventory.php";
            </script>';
    }

}
?>