<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CDN -->    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    body {
  font-family: 'Georgia', serif;
  background-color: #150c34;
  margin: 0;
  padding: 0;
  color: #ffffff;
}

/* SIDEBAR */
#sidebar-wrapper {
  background: linear-gradient(160deg, #1e0f3f, #3b1d72);
  width: 250px;
  height: 100vh;
  padding-top: 20px;
  box-shadow: 2px 0 20px rgba(0, 0, 0, 0.4);
}

.sidebar-heading {
  color: #ffe76d;
  font-size: 1.3rem;
  text-align: center;
  margin-bottom: 20px;
  font-weight: bold;
}

.list-group-item {
  background-color: transparent !important;
  color: #e0d3ff !important;
  border: none;
  font-size: 1rem;
  padding: 15px 25px;
  transition: all 0.2s ease-in-out;
}

.list-group-item:hover {
  background-color: rgba(255, 255, 255, 0.05) !important;
  color: #ffe76d !important;
  border-left: 5px solid #ffe76d;
}

/* PAGE CONTENT */
#page-content-wrapper {
  flex: 1;
  background-color: #1c1034;
  padding: 30px;
}

/* NAVBAR */
.navbar {
  background-color: #190c2e !important;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
}

.navbar h5,
.navbar span {
  color: #ffe76d;
  font-weight: bold;
}

/* TOGGLE BUTTON */
#menu-toggle {
  background-color: #5f27cd;
  border: none;
  color: white;
  padding: 8px 14px;
  border-radius: 6px;
  transition: 0.2s;
}

#menu-toggle:hover {
  background-color: #7744e6;
}

/* CARD CUSTOM */
.card {
  border: none;
  border-radius: 15px;
  padding: 20px;
  background: linear-gradient(to bottom right, #3e1d6f, #2c1552);
  color: #fff;
  box-shadow: 0 0 12px rgba(95, 39, 205, 0.5);
  transition: 0.3s ease;
}

.card:hover {
  transform: scale(1.03);
  box-shadow: 0 0 20px rgba(255, 231, 109, 0.4);
}

.card h5 {
  font-size: 1.1rem;
  color: #ffe76d;
}

.card .fs-4 {
  font-size: 1.8rem;
  font-weight: bold;
}

/* RESPONSIVE */
@media (max-width: 768px) {
  #wrapper {
    flex-direction: column;
  }

  #sidebar-wrapper {
    width: 100%;
    height: auto;
    position: relative;
  }

  #page-content-wrapper {
    margin-left: 0;
  }
}

</style>
<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-dark border-end" id="sidebar-wrapper">
        <div class="sidebar-heading text-white text-center py-4">
            <img src="assets/logo.png" width="40"> Admin Panel
        </div>
        <div class="list-group list-group-flush">
            <a href="dashboard.php" class="list-group-item list-group-item-action bg-dark text-white"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="user_show.php" class="list-group-item list-group-item-action bg-dark text-white"><i class="fas fa-users"></i> Kelola User</a>
            <a href="produk.php" class="list-group-item list-group-item-action bg-dark text-white"><i class="fas fa-box"></i> Produk</a>
            <a href="transaksi.php" class="list-group-item list-group-item-action bg-dark text-white"><i class="fas fa-receipt"></i> Transaksi</a>
            <a href="pelanggan.php" class="list-group-item list-group-item-action bg-dark text-white"><i class="fas fa-user-check"></i> Pelanggan</a>
            <a href="index.php" class="list-group-item list-group-item-action bg-dark text-white"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <!-- Page content -->
    <div id="page-content-wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <button class="btn btn-dark" id="menu-toggle"><i class="fas fa-bars"></i></button>
                <h5 class="ms-3 mb-0">Dashboard Admin</h5>
                <div class="ms-auto">
                    <span class="me-3">Halo, <?= $_SESSION['username']; ?></span>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container-fluid mt-4">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <h5><i class="fas fa-users"></i> Total User</h5>
                            <p class="fs-4">12</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success shadow">
                        <div class="card-body">
                            <h5><i class="fas fa-box"></i> Total Produk</h5>
                            <p class="fs-4">34</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning shadow">
                        <div class="card-body">
                            <h5><i class="fas fa-receipt"></i> Total Transaksi</h5>
                            <p class="fs-4">58</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-danger shadow">
                        <div class="card-body">
                            <h5><i class="fas fa-user-check"></i> Pelanggan Aktif</h5>
                            <p class="fs-4">21</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <h4>Selamat Datang di Halaman Admin</h4>
            <p>Silakan pilih menu di sidebar untuk mengelola data.</p>
        </div>
    </div>
</div>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle sidebar
    document.getElementById("menu-toggle").addEventListener("click", function () {
        document.getElementById("wrapper").classList.toggle("toggled");
    });
</script>
</body>
</html>
