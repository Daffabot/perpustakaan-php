<?php
include("header.php");

$user_check = $_SESSION['login_user'];

$sql = "select id_p_role as role, id_t_account from t_account where username = '$user_check' ";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

$sql_pj = "select count(*) as JUM from t_peminjaman where create_date = curdate() ";
$result_pj = mysqli_query($db,$sql_pj);
$row_pj = mysqli_fetch_array($result_pj,MYSQLI_ASSOC);

$sql_ag = "select count(*) as JUM from t_anggota where create_date = curdate() ";
$result_ag = mysqli_query($db,$sql_ag);
$row_ag = mysqli_fetch_array($result_ag,MYSQLI_ASSOC);

$sql_bk = "select count(*) as JUM from t_buku where create_date = curdate() ";
$result_bk = mysqli_query($db,$sql_bk);
$row_bk = mysqli_fetch_array($result_bk,MYSQLI_ASSOC);

$sql_jb = "SELECT SUM(jum) AS JUMLAH, ID FROM v_peminjaman";
$result_jb = mysqli_query($db,$sql_jb);
$row_jb = mysqli_fetch_array($result_jb,MYSQLI_ASSOC);

$id_account = $row['id_t_account'];

$sql_sh = "SELECT nama FROM t_anggota WHERE id_t_account = '$id_account'";
$result_sh = mysqli_query($db,$sql_sh);
$row_sh = mysqli_fetch_array($result_sh,MYSQLI_ASSOC);

if ($row['role']==1 || $row['role']==2){
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div>
    
    <div class="row">
        <!-- Card 1 -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-bg-success mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3">
                            <!-- Optional Icon -->
                        </div>
                        <div class="col-9 text-end">
                            <div class="display-4"><?php echo $row_pj['JUM']; ?></div>
                            <div>Peminjaman Hari ini</div>
                        </div>
                    </div>
                </div>
                <a href="data_peminjaman.php" class="text-decoration-none text-white">
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <span>Lihat Detail</span>
                        <span>&rarr;</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-bg-primary mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3">
                            <!-- Optional Icon -->
                        </div>
                        <div class="col-9 text-end">
                            <div class="display-4"><?php echo $row_ag['JUM']; ?></div>
                            <div>Anggota Baru</div>
                        </div>
                    </div>
                </div>
                <a href="data_anggota.php" class="text-decoration-none text-white">
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <span>Lihat Detail</span>
                        <span>&rarr;</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-bg-warning mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3">
                            <!-- Optional Icon -->
                        </div>
                        <div class="col-9 text-end">
                            <div class="display-4"><?php echo $row_bk['JUM']; ?></div>
                            <div>Buku Baru</div>
                        </div>
                    </div>
                </div>
                <a href="data_buku.php" class="text-decoration-none text-black">
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <span>Lihat Detail</span>
                        <span>&rarr;</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php if (isset($row_jb)) { ?>
    <div class="row">
        <!-- Additional Card -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-bg-primary mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3">
                            <!-- Optional Icon -->
                        </div>
                        <div class="col-9 text-end">
                            <div class="display-4"><?php echo $row_jb['JUMLAH']; ?></div>
                            <div>Total Peminjaman</div>
                        </div>
                    </div>
                </div>
                <!-- <a href="history_peminjaman.php?id=<?php echo $row_jb['ID']; ?>" class="text-decoration-none text-white">
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <span>Lihat Detail</span>
                        <span>&rarr;</span>
                    </div>
                </a> -->
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php
	} else {
?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-12">
      <p>Haloo <?php 
      if (isset($row_sh['nama'])) {
        echo $row_sh['nama'];
      }
      ?> semoga selalu sehat :)</p>
    </div>
  </div>
</div>
<?php
    }
?>

<?php 
include "footer.php";
?>