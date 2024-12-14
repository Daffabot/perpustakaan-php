<?php 
    include("../setting/koneksi.php");

    $where = " WHERE 1=1 ";

    // Periksa apakah parameter ada di URL
    if (isset($_GET['btncari'])) {
        if (!empty($_GET['txtNama'])) {
            $where .= " AND nama LIKE '%" . $_GET['txtNama'] . "%' ";
        }
        if (!empty($_GET['txtAlamat'])) {
            $where .= " AND alamat LIKE '%" . $_GET['txtAlamat'] . "%' ";
        }
        if (!empty($_GET['txtStatus']) && $_GET['txtStatus'] !== 'Semua') {
            $where .= " AND status = '" . $_GET['txtStatus'] . "' ";
        }
    }

    include("header.php");	
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data Staff</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-6">
            <form method="GET">
                <table>
                    <tr>
                        <td>Nama Staff&nbsp;</td>
                        <td><input type="text" class="form-control" name="txtNama" value="<?php echo isset($_GET['txtNama']) ? $_GET['txtNama'] : ''; ?>"></td>
                        <td>&nbsp;Status&nbsp;</td>
                        <td>
                            <select class="form-control" name="txtStatus">
                                <option>Semua</option>
                                <option <?php echo (isset($_GET['txtStatus']) && $_GET['txtStatus'] == "Aktif") ? "selected" : ""; ?>>Aktif</option>
                                <option <?php echo (isset($_GET['txtStatus']) && $_GET['txtStatus'] == "Tidak Aktif") ? "selected" : ""; ?>>Tidak Aktif</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat&nbsp;</td>
                        <td><input type="text" class="form-control" name="txtAlamat" value="<?php echo isset($_GET['txtAlamat']) ? $_GET['txtAlamat'] : ''; ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit" class="btn btn-small btn-primary btn-block" name="btncari">Cari</button></td>
                        <td></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <table width="100%" class="table table-striped table-bordered table-hover">
                <tr>
                    <th>No</th>
                    <th>Nama Staff</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php
                    $hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
                    $max_results = 10;
                    $from = (($hal * $max_results) - $max_results);
                    
                    $sql = "SELECT * FROM t_staff $where LIMIT $from, $max_results";
                    $result = mysqli_query($db, $sql);
                    $jum_data = mysqli_num_rows($result);
                    
                    if ($jum_data > 0) {
                        $no = 1;
                        while ($tampil = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<tr>
                                    <td>{$no}</td>
                                    <td>{$tampil['nama']}</td>
                                    <td>{$tampil['alamat']}</td>
                                    <td>{$tampil['status']}</td>
                                    <td><a href='input_staff.php?id={$tampil['id_t_staff']}' class='btn btn-info'>Edit</a></td>
                                    <td><a onclick=\"if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_staff.php?id={$tampil['id_t_staff']}' }\" class='btn btn-danger'>Hapus</a></td>
                                  </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center;'>Data tidak ditemukan</td></tr>";
                    }
                ?>
            </table>
        </div>
    </div>
</div>
<?php 
include "footer.php";
?>