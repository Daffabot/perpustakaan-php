<html>
   <head>
      <title>Dashboard | Perpustakaan</title>
	    <link rel="stylesheet" type="text/css" href="../template/alert.css">
		<link href="../template/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../template/css/sb-admin-2.css" rel="stylesheet" />
    <link href="../template/css/bootstrap-icons.css" rel="stylesheet" />
    <link href="../template/css/bootstrap-icons.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../template/js/jquery-ui-1.14.1/jquery-ui.css" />
		<link rel="stylesheet" href="../template/js/jquery-ui-1.14.1/jquery-ui-smooth.css">
   </head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
          <?php
          if (isset($id_account)) {
          ?>
            <li><a class="dropdown-item" href="profile.php"><i class="bi bi-person-badge"></i> Profile</a></li>
            <li><a class="dropdown-item" href="ganti_password.php"><i class="bi bi-shield-lock"></i> Ganti Password</a></li>
            <li><hr class="dropdown-divider"></li>
            <?php
            }
            ?>
            <li><a class="dropdown-item" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="dashboard.php">
            <i class="bi bi-house"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#bookMenu" role="button" aria-expanded="false" aria-controls="bookMenu">
            <i class="bi bi-book"></i> Buku <i class="bi bi-caret-down-fill ms-auto"></i>
          </a>
          <div class="collapse" id="bookMenu">
            <ul class="list-unstyled ps-3">
              <li><a class="nav-link" href="data_buku.php">Data Buku</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
  </div>
</div>