<?php 
include "../koneksi.php";
include "../cek.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Inventory Ku</title>
  <!-- loader-->
  <link href="../asset/css/pace.min.css" rel="stylesheet"/>
  <script src="../asset/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="../asset/images/favicon.ico" type="image/x-icon">
  <!-- Vector CSS -->
  <link href="../asset/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="../asset/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="../asset/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="../asset/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="../asset/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="../asset/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="../asset/css/app-style.css" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme1">
 
<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.html">
       <img src="../asset/images/logo-icon.png" class="logo-icon" alt="logo icon">
       <h5 class="logo-text">Inventory IT</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">Menu</li>
      <li>
        <a href="">
          <i class="zmdi zmdi-labels"></i> <span>Inventory ruangan</span>
        </a>
      </li>

      <li>
        <a href="../pages/index.php">
          <i class="zmdi zmdi-storage"></i> <span>Inventory IT</span>
        </a>
      </li>

      <li>
        <a href="../pages/index.php">
          <i class="zmdi zmdi-archive"></i> <span>Stock barang</span>
        </a>
      </li>
      <li>
        <a href="../logout.php">
          <i class="zmdi zmdi-square-right"></i> <span>Logout</span>
        </a>
      </li>

    </ul>
   
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item">
      <form class="search-bar">
        <input type="text" class="form-control" placeholder="Enter keywords">
         <a href="javascript:void();"><i class="icon-magnifier"></i></a>
      </form>
    </li>
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
    
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

  <!--Start Dashboard Content-->

	<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            
        </div>
    </div>
 </div>  
	
	<div class="row">
	 <div class="col-12 col-lg-12">
	   <div class="card">
	     <div class="card-header">Inventory ruangan IT
		  <div class="card-action">
             <div class="dropdown">
             <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
              <i class="icon-options"></i>
             </a>
              <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="#">Tambah barang</a>
              
               </div>
              </div>
             </div>
		 </div>
	       <div class="table-responsive">
                 <table class="table align-items-center table-flush table-borderless">
                  <thead>
                   <tr>
                     <th>No</th>
                     <th>Gambar</th>
                     <th>Kode barang</th>
                     <th>Nama barang</th>
                     <th>Tanggal</th>
                     <th>Posisi</th>
                     <th>Aksi</th>
                   </tr>
                   </thead>
                   <tbody><tr>
                    <td>Iphone 5</td>
                    <td><img src="https://via.placeholder.com/110x110" class="product-img" alt="product img"></td>
                    <td>#9405822</td>
                    <td>$ 1250.00</td>
                    <td>03 Aug 2017</td>
					<td>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm"> Edit</button>
                        <button class="btn btn-danger btn-sm"> Hapus</button>
                    </td>
                   </tr>
                 </tbody>
                </table>
               </div>
	   </div>
	 </div>
	</div><!--End Row-->

      <!--End Dashboard Content-->
	  
	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->
		
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Support By Arieriyan IT RSMP
        </div>
      </div>
    </footer>
	<!--End footer-->
	
  <!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

      <p class="mb-0">Gaussion Texture</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme1"></li>
        <li id="theme2"></li>
        <li id="theme3"></li>
        <li id="theme4"></li>
        <li id="theme5"></li>
        <li id="theme6"></li>
      </ul>

      <p class="mb-0">Gradient Background</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme7"></li>
        <li id="theme8"></li>
        <li id="theme9"></li>
        <li id="theme10"></li>
        <li id="theme11"></li>
        <li id="theme12"></li>
		<li id="theme13"></li>
        <li id="theme14"></li>
        <li id="theme15"></li>
      </ul>
      
     </div>
   </div>
  <!--end color switcher-->
   
  </div><!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="../asset/js/jquery.min.js"></script>
  <script src="../asset/js/popper.min.js"></script>
  <script src="../asset/js/bootstrap.min.js"></script>
	
 <!-- simplebar js -->
  <script src="../asset/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="../asset/js/sidebar-menu.js"></script>
  <!-- loader scripts -->
  <script src="../asset/js/jquery.loading-indicator.js"></script>
  <!-- Custom scripts -->
  <script src="../asset/js/app-script.js"></script>
  <!-- Chart js -->
  
  <script src="../asset/plugins/Chart.js/Chart.min.js"></script>
 
  <!-- Index js -->
  <script src="../asset/js/index.js"></script>

  
</body>
</html>
