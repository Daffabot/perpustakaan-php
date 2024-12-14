<html>
   <head>
      <title>Dashboard | Perpustakaan</title>
	    <link rel="stylesheet" type="text/css" href="../template/alert.css">
		<link href="../template/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../template/css/bootstrap-icons.css" rel="stylesheet" />
        <link href="../template/css/bootstrap-icons.min.css" rel="stylesheet" />
		<link href="../template/css/sb-admin-2.css" rel="stylesheet" />
		<link rel="stylesheet" href="../template/js/jquery-ui-1.14.1/jquery-ui.css" />
		<link rel="stylesheet" href="../template/js/jquery-ui-1.14.1/jquery-ui-smooth.css">
   </head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Perpustakaan Daffabot</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person-badge"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="ganti_password.php"><i class="bi bi-key"></i> Ganti Password</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar bg-light p-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php"><i class="bi bi-house"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#peminjamanMenu" role="button" aria-expanded="false" aria-controls="peminjamanMenu">
                        <i class="bi bi-list"></i> Peminjaman <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse" id="peminjamanMenu">
                        <ul class="list-unstyled ps-3">
                            <li><a class="nav-link" href="data_peminjaman.php">Data Peminjaman</a></li>
                            <li><a class="nav-link" href="input_peminjaman.php">Input Data Peminjaman</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#bukuMenu" role="button" aria-expanded="false" aria-controls="bukuMenu">
                        <i class="bi bi-list-ul"></i> Buku <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse" id="bukuMenu">
                        <ul class="list-unstyled ps-3">
                            <li><a class="nav-link" href="data_buku.php">Data Buku</a></li>
                            <li><a class="nav-link" href="input_buku.php">Input Data Buku</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#anggotaMenu" role="button" aria-expanded="false" aria-controls="anggotaMenu">
                        <i class="bi bi-people"></i> Anggota <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse" id="anggotaMenu">
                        <ul class="list-unstyled ps-3">
                            <li><a class="nav-link" href="data_anggota.php">Data Anggota</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#staffMenu" role="button" aria-expanded="false" aria-controls="staffMenu">
                        <i class="bi bi-person"></i> Staff <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse" id="staffMenu">
                        <ul class="list-unstyled ps-3">
                            <li><a class="nav-link" href="data_staff.php">Data Staff</a></li>
                            <li><a class="nav-link" href="input_staff.php">Input Data Staff</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
		  
		  <!-- <ul class="nav nav-sidebar">
            <li>
				<a href="#">
					<span class="glyphicon glyphicon-stats"></span>&nbsp;Laporan <span data-toggle="collapse" href="#sub-item-5" class="icon pull-right"><em class="glyphicon glyphicon-arrow-down"></em></span> 
				</a><a href="#">
				<ul class="children collapse" id="sub-item-5">
                    <li>
                        <a href="laporan_buku.php">Laporan Buku</a>
                    </li>
                    <li>
                        <a href="laporan_peminjaman.php">Laporan Peminjaman</a>
                    </li>
					<li>
                        <a href="laporan_anggota.php">Laporan Anggota</a>
                    </li>
					<li>
                        <a href="laporan_staff.php">Laporan Staff</a>
                    </li>
                </ul>
			</li>
          </ul> -->