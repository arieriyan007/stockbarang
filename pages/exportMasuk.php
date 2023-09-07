<?php
//import koneksi ke database
include "../koneksi.php";
include "../cek.php";
?>
<html>
<head>
  <title>Stock masuk</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
			<h2 class="text-center mt-4">Laporan Barang Masuk</h2>
			<h4 class="text-center">(Stock masuk)</h4>
				<div class="data-tables datatable-dark">
					
					<!-- Masukkan table nya disini, dimulai dari tag TABLE -->
                    <table id="mauexport" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Tanggal</th>
                      <th>Qty</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  <!-- menampilkan database dengan php -->
                    <?php 
                    $no = 1;
                    $datamasuk = mysqli_query($koneksi, "SELECT * FROM masuk m, stock s WHERE s.idbarang = m.idbarang");
                    
                    while ($dm = mysqli_fetch_array($datamasuk)) {
                      $idm = $dm['idmasuk'];
                      $idb = $dm['idbarang'];
                      $nmbarang = $dm['namabarang'];
                      $qty = $dm['qty'];
                      $tanggal = $dm['tanggal'];
                      $ket = $dm['keterangan'];
                      
                      ?>
                    <tr>
                      <td><?= $no++?></td>
                      <td><?= $nmbarang; ?></td>
                      <td><?= $tanggal; ?></td>
                      <td><?= $qty; ?></td>
                      <td><?= $ket; ?></td>
                    </tr>

                      <?php 
                    }
                      ?>
                  </tbody>
                </table>
					
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