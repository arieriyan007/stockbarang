<?php 
include "../koneksi.php";

if (isset($_POST['addbarang'])) {
    $nbarang = $_POST['nbarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];
    $satuan = $_POST['satuan'];

    // hanya file gambar saja yg boleh di upload jadi bisa di masukkan dalam extensi dibawah ini
    $allow_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; // ngambil nama gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot)); //ini mengambil ekstensinya
    // buat ukuran gambar
    $ukuran = $_FILES['file']['size']; //ngambil size filenya
    $file_tmp = $_FILES['file']['tmp_name']; //ini untuk ngambil lokasi filenya
    
    // penamaan file -> enkripsi menggunakan MD5
    $image = md5(uniqid($nama,true) . time()). '.'.$ekstensi; //menggabungkan nama file yang di enkripsi dengan ektensinya

    // membuat validasi barang sudah ada atau belum
    $cek = mysqli_query($koneksi, "SELECT * FROM stock WHERE namabarang='$nbarang'");
    $hitung = mysqli_num_rows($cek);

    if ($hitung<1) {
        // proses upload gambar
        if (in_array($ekstensi, $allow_extension) === true) {
            // validasi ukuran filenya
            if ($ukuran < 15728640) { 
                move_uploaded_file($file_tmp, '../assets/img/'.$image);
                // jika belum ada barnag maka barang masuk ke dalam database
                $tamabahbarang = mysqli_query($koneksi, "INSERT INTO stock(namabarang, deskripsi, stock, satuan, image) VALUES 
                ('$nbarang', '$deskripsi', '$stock', '$satuan', '$image')");

                // jika data selesai input maka
                if ($tamabahbarang) {
                    header("location:index.php?pesan=berhasil_ditambahkan");
                } else {
                    header("location:index.php?pesan=data_gagal");
                }
            } else {
                // kalau filenya lebih dari 15Mb
                echo "<script>
                    alert ('Ukuran file terlalu besar melebihi 15Mb');
                    window.location.href='index.php';
                    </script>";
            }
            
        } else {
            // jika gambarnya/file tidak png/jpg
                echo "<script>
                    alert ('File bukan jpg/png !, pastikan yang di upload berupa gambar/foto');
                    window.location.href='index.php';
                    </script>";
            }

    } else {
        // jika sudah ada
        echo "<script>
        alert ('Nama barang sudah terdaftar !');
        window.location.href='index.php';
        </script>";
    }
}
?>