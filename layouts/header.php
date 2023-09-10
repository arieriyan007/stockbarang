<?php 
require "../koneksi.php";

// cek disini sebagai cek login
include "../cek.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gudang Ku</title>
    <link
      href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css"
      rel="stylesheet"
    />
    <!-- cdn bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet" />

    <!-- script bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script
      src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"
      crossorigin="anonymous"
    ></script>
  </head>

      <style>
    .zoomable {
      width: 100px;
    }
    .zoomable:hover {
      transform: scale(2);
      transition: 0.8s ease;
    }
    </style>

  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
      <!-- Navbar Brand-->
      <a class="navbar-brand ps-3" href="index.php">Stock & Inventori Ku</a>
      <!-- Sidebar Toggle-->
      <button
        class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
        id="sidebarToggle"
        href="#!"
      >
        <i class="fas fa-bars"></i>
      </button>
    </nav>

    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
            <div class="nav">
              <div class="sb-sidenav-menu-heading">Stock Ku</div>
              <a class="nav-link" href="index.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-cubes"></i>
                </div>
                Stock Barang
              </a>
              <a class="nav-link" href="../pages/masuk.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-truck-moving"></i>
                </div>
                Barang Masuk
              </a>
              <a class="nav-link" href="../pages/keluar.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-truck-moving fa-flip-horizontal"></i>
                </div>
                Barang Keluar
              </a>
              <a class="nav-link" href="../admin/admin.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-users"></i>
                </div>
                User Admin
              </a>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                  <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                    Inventory
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
                  <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="#"><i class="fas fa-home"></i>&nbsp; IT saja</a>
                    <a class="nav-link" href="#"><i class="fas fa-sitemap"></i>&nbsp; Seluruh Inventory IT</a>
                  </nav>
                  </div>
              <a class="nav-link" href="../logout.php">
                <div class="sb-nav-link-icon">
                  <i class="fas fa-close"></i>
                </div>
                Logout
              </a>
            </div>
          </div>
          <!-- <div class="sb-sidenav-footer">
            <div class="small">Support By</div> -->
            <?php 
            // session_start();
            // echo "hai," . $_SESSION['$email']; 
            ?>
          <!-- </div> -->
        </nav>
      </div>