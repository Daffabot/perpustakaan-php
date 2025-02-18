<?php
require_once '../setting/koneksi.php';
require_once '../setting/session.php';

$id_st = isset($_GET['id']) ? mysqli_real_escape_string($db, $_GET['id']) : null;

$usersession = $_SESSION['login_user'];

$sql_cek = "SELECT id_p_role, id_t_account FROM t_account WHERE username = '$usersession'";
$result_cek = mysqli_query($db, $sql_cek);
$row_cek = mysqli_fetch_array($result_cek, MYSQLI_ASSOC);
$id_akun = $row_cek['id_t_account'];

// Jika yang membuka adalah anggota, redirect ke dashboard
if ($row_cek['id_p_role'] == 3) {
    header('location:dashboard.php');
    exit;
}

if ($id_st) {
    $judul = "Edit Staff";

    if ($row_cek['id_p_role'] == 1) {
        $sql_data = "SELECT * FROM t_staff WHERE id_t_staff = $id_st";
    } elseif ($row_cek['id_p_role'] == 2) {
        $sql_data = "SELECT * FROM t_staff WHERE id_t_account = $id_akun";
    } else {
        header('location:dashboard.php');
        exit;
    }

    $result_data = mysqli_query($db, $sql_data);
    $tampil_data = mysqli_fetch_array($result_data, MYSQLI_ASSOC) ?? [];
} else {
    $judul = "Input Staff";
    $tampil_data = [];
}

if (isset($_POST['btnsubmit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $statusnya = $_POST['statusnya'];
    $nmuser = $_POST['user'] ?? null;
    $passnya = $_POST['pass'] ?? null;

    if ($passnya) {
        $hashed_password = md5($passnya);
    }

    if ($id_st) {
        if ($row_cek['id_p_role'] == 1) {
            $query = "UPDATE t_staff SET nama = '$nama', alamat = '$alamat', status = '$statusnya', update_date = CURDATE(), update_by = '$usersession' 
                      WHERE id_t_staff = $id_st";
        } elseif ($row_cek['id_p_role'] == 2) {
            $query = "UPDATE t_staff SET nama = '$nama', alamat = '$alamat', status = '$statusnya', update_date = CURDATE(), update_by = '$usersession' 
                      WHERE id_t_account = $id_akun";
        }
    } else {
        $sql_akun = "INSERT INTO t_account(id_p_role, username, password, create_date, create_by)
                     VALUES(2, '$nmuser', '$hashed_password', CURDATE(), 'adm')";
        $resultnya = mysqli_query($db, $sql_akun);

        $sql_id = "SELECT MAX(id_t_account) AS id FROM t_account";
        $result_id = mysqli_query($db, $sql_id);
        $tampil_id = mysqli_fetch_array($result_id, MYSQLI_ASSOC);
        $id_now = $tampil_id['id'];

        $query = "INSERT INTO t_staff(id_t_account, nama, alamat, status, create_date, create_by) 
                  VALUES($id_now, '$nama', '$alamat', '$statusnya', CURDATE(), '$usersession')";
    }

    if ($db->query($query)) {
        if ($row_cek['id_p_role'] == 1) {
            header('location:data_staff.php');
        } elseif ($row_cek['id_p_role'] == 2) {
            header('location:dashboard.php');
        }
        exit;
    }
    $db->close();
}
include("header.php");
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $judul; ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label class="control-label col-sm-4">Nama Staff</label>
                    <div class="col-sm-8">
                        <input type="text" maxlength="25" class="form-control" name="nama" 
                               value="<?php echo $tampil_data['nama'] ?? ''; ?>" required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4">Tanggal Daftar</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><?php echo date("Y-m-d"); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4">Alamat</label>
                    <div class="col-sm-8">
                        <textarea name="alamat" class="form-control" rows="3" required><?php echo htmlspecialchars($tampil_data['alamat'] ?? ''); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4">Status</label>
                    <div class="col-sm-8">
                        <select name="statusnya" class="form-control">
                            <option <?php echo ($tampil_data['status'] ?? '') == "Aktif" ? "selected" : ""; ?>>Aktif</option>
                            <option <?php echo ($tampil_data['status'] ?? '') == "Tidak Aktif" ? "selected" : ""; ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <?php if (!$id_st) { ?>
                <div class="form-group">
                    <label class="control-label col-sm-4">Username</label>
                    <div class="col-sm-8">
                        <input type="text" maxlength="25" class="form-control" name="user" required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4">Password</label>
                    <div class="col-sm-8">
                        <input type="password" maxlength="10" class="form-control" name="pass" required />
                    </div>
                </div>
                <?php } ?>
                <div class="form-group" align="right">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <?php if ($row_cek['id_p_role'] == 1) { ?>
                        <a href="data_staff.php" class="btn btn-primary">Batal</a>
                        <?php } else if ($row_cek['id_p_role'] == 2) { ?>
                        <a href="dashboard.php" class="btn btn-primary">Batal</a>
                        <?php } ?>
                        <button type="submit" name="btnsubmit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
