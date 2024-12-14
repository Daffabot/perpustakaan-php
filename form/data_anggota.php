<?php
include("header.php");

$aktif = "";
$tidak = "";
$where = " WHERE 1=1 ";

// Periksa apakah parameter filter tersedia
if (isset($_GET['btncari'])) {
    if (!empty($_GET['txtNama'])) {
        $where .= " AND nama LIKE '%" . $_GET['txtNama'] . "%' ";
    }
    if (!empty($_GET['txtTgl'])) {
        $where .= " AND tgl_daftar = '" . $_GET['txtTgl'] . "' ";
    }
    if (!empty($_GET['txtAlamat'])) {
        $where .= " AND alamat LIKE '%" . $_GET['txtAlamat'] . "%' ";
    }
    if (!empty($_GET['txtStatus']) && $_GET['txtStatus'] !== 'Semua') {
        $where .= " AND status = '" . $_GET['txtStatus'] . "' ";
    }
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data Anggota</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form method="GET">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Anggota</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="txtNama" value="<?php echo $_GET['txtNama'] ?? ''; ?>">
                    </div>
                    <label class="col-sm-2 col-form-label">Tanggal Daftar</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txtTgl" name="txtTgl" value="<?php echo $_GET['txtTgl'] ?? ''; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="txtAlamat" value="<?php echo $_GET['txtAlamat'] ?? ''; ?>">
                    </div>
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-4">
                        <?php
                        if (isset($_GET['txtStatus'])) {
                            if ($_GET['txtStatus'] === "Aktif") {
                                $aktif = "selected";
                            } else if ($_GET['txtStatus'] === "Tidak Aktif") {
                                $tidak = "selected";
                            }
                        }
                        ?>
                        <select class="form-control" name="txtStatus">
                            <option>Semua</option>
                            <option value="Aktif" <?php echo $aktif; ?>>Aktif</option>
                            <option value="Tidak Aktif" <?php echo $tidak; ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-small btn-primary btn-block" name="btncari">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <table width="100%" class="table table-striped table-bordered table-hover">
                <tr>
                    <th>No</th>
                    <th>No Anggota</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal Daftar</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th colspan="3">Action</th>
                </tr>
                <?php
                    $hal = $_GET['hal'] ?? 1;
                    $max_results = 10;
                    $from = (($hal * $max_results) - $max_results);

                    $sql = "SELECT * FROM t_anggota $where LIMIT $from, $max_results";
                    $result = mysqli_query($db, $sql);
                    $jum_data = mysqli_num_rows($result);

                    if ($jum_data > 0) {
                        $no = 1;
                        while ($tampil = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$tampil['no_anggota']}</td>
                                <td>{$tampil['nama']}</td>
                                <td>{$tampil['nama']}</td>
                                <td>{$tampil['tgl_lahir']}</td>
                                <td>{$tampil['alamat']}</td>
                                <td>{$tampil['status']}</td>
                                <td>{$tampil['keterangan']}</td>
                                <td><a href='input_anggota.php?id={$tampil['id_t_anggota']}' class='btn btn-info'>Edit</a></td>
                                <td><a href='history_peminjaman.php?id={$tampil['id_t_anggota']}' class='btn btn-warning'>History</a></td>
                                <td><a onclick=\"if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_anggota.php?id={$tampil['id_t_anggota']}' }\" class='btn btn-danger'>Hapus</a></td>
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='11' style='text-align:center;'>Data tidak ditemukan</td></tr>";
                    }
                ?>
            </table>
        </div>
    </div>
</div>
<?php 
include "footer.php";
?>
<script type="text/javascript">
    $(document).ready(function(e) {
        $("#txtTgl").datepicker({dateFormat: "yy-mm-dd"});
    });
</script>