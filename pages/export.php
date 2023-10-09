<?php
include "../koneksi.php";
include "../cek.php";
?>

<html>
<head>
  <title>Stock Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>
<!-- zoomable -->
<style>
    .zoomable {
      width: 100px;
    }
    .zoomable:hover {
      transform: scale(2);
      transition: 0.8s ease;
    }
    </style>
<body>
<div class="container">
			<h2 class="text-center mt-4">Stock barang</h2>
			<h4 class="text-muted text-center">(Inventory)</h4>
				<div class="data-tables datatable-dark">
					
                <!-- table -->
                <table id="mauexport" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Gambar</th>
                      <th>Nama barang</th>
                      <th>Stock</th>
                      <th>Satuan</th>
                      <th>Dekripsi</th>
                    </tr>
                  </thead>
              
                  <tbody>
                  <!-- menampilkan isi dari database dengan php -->
                  <?php 
                  $no = 1;
                  $datastock = mysqli_query($koneksi, "SELECT * FROM stock");

                  while ($s = mysqli_fetch_array($datastock)) {
                    $idb        = $s['idbarang'];
                    $nmbarang   = $s['namabarang'];
                    $stock      = $s['stock'];
                    $deskripsi  = $s['deskripsi'];
                    $satuan     = $s['satuan'];
                    // menampilkan gambar
                    $gambar     = $s['image'];
                    if ($gambar==null) {
                      // jika tidak ada gambar
                      $img = 'No Gambar';
                    } else {
                      // jika ada gambar
                      $img = '<img src="../assets/img/'.$gambar.'" class="zoomable">'; //zoomable disini saya membuat costume css dibagian header.php
                    }
                  ?>

                    <tr>
                      <td class="text-center"><?= $no++; ?></td>
                      <td><?= $img; ?></td>
                      <td><?= $nmbarang; ?></td>
                      <td><?= $stock; ?></td>
                      <td><?= $satuan; ?></td>
                      <td><?= $deskripsi; ?></td>
                      
                    </tr>
                  
                    <?php 
                  }
                    ?>
                    <!-- akhir tampilan database stock -->
                  </tbody>
                </table>
					<!-- akhir table -->

				</div>
</div>
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>