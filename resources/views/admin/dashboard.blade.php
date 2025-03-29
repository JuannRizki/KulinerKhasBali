<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 15px;
            display: block;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center text-white">Dashboard Admin</h4>
        <a href="#">Dashboard</a>
        <a href="#">Kelola Pengguna</a>
        <a href="#">Laporan</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="content">
     <h3>Selamat Datang, <?php  ?>!</h3>
        <p>Ini adalah halaman dashboard admin.</p>
        <div class="row">
            
        
        <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Pengguna</h5>
                        <p class="card-text">100</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Baru</h5>
                        <p class="card-text">25</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Permintaan Pending</h5>
                        <p class="card-text">10</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
