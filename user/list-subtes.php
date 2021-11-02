<?php
include("../koneksi.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar Subtes</title>
    <?php
    include('header.php');
    ?>
    <link href="../css/sticky-navbar-footer.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://raw.githack.com/jquery/jquery-ui/main/ui/i18n/datepicker-id.js"></script>
</head>

<body>
    <?php
    $getDataUser = mysqli_query($db, "SELECT * FROM `tbl_user` INNER JOIN `tbl_event` ON tbl_user.acara = tbl_event.id_event WHERE id_user = '$_SESSION[id_user]'");
    $dataUser = mysqli_fetch_array($getDataUser);
    if (strtotime($dataUser['tgl_akhir'] . $dataUser['waktu_akhir']) <= time()) {
        echo "<meta http-equiv='refresh' content='0; url=../logout.php'>";
    }
    ?>
    <nav class="navbar navbar-dark bg-dark justify-content-between">
        <span class="navbar-brand">Halo, <?= $dataUser['nama']; ?></span>
        <a href="../logout.php" class="btn btn-primary">Logout</a>
    </nav>
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>: <?= $dataUser['nama']; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: <?= ($dataUser['tgl_lahir'] != "0000-00-00") ? date("d M Y", strtotime($dataUser['tgl_lahir'])) : "" ?></td>
                    </tr>
                    <tr>
                        <td>Usia</td>
                        <td>: <?php
                                if ($dataUser['tgl_lahir'] != "0000-00-00") {
                                    $bday = new DateTime($dataUser['tgl_lahir']); // Your date of birth
                                    $today = new Datetime(date('Y-m-d'));
                                    $diff = $today->diff($bday);
                                    printf('%d tahun, %d bulan, %d hari', $diff->y, $diff->m, $diff->d);
                                }
                                ?>
                        </td>
                    </tr>
                </table>
            </div>
            <?php
            if ($dataUser['tgl_lahir'] == "0000-00-00") {
            ?>
                <div class="align-middle">
                    <button type="button" class="btn btn-danger p-1" data-toggle="modal" data-target="#exampleModalCenter">
                        Masukkan tanggal lahir
                    </button>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#exampleModalCenter').modal({
                            backdrop: 'static',
                            keyboard: false,
                            show: true
                        });
                    });
                </script>
            <?php } ?>
        </div>
        <div class="card">
            <div class="card-header">
                <a href="list-tes.php" class="btn btn-sm btn-primary">
                    < Kembali</a>
                        Daftar Subtes - <?= $_SESSION['jenis_tes'] ?>
            </div>
            <div class="card-body">
                <h5 class="card-title">Intruksi</h5>
                <?php
                if (isset($_SESSION['jenis_tes'])) {
                    $intruksiTes = mysqli_query($db, "SELECT * FROM `tbl_jenistes` WHERE `nama_tes` = '$_SESSION[jenis_tes]'");
                    $intruksi = mysqli_fetch_array($intruksiTes);
                }
                ?>
                <p class="card-text"><?= $intruksi['intruksi_tes'] ?></p>
            </div>
        </div>
        <div class="row">
            <?php
            $getSubtes =  mysqli_query($db, "SELECT tbl_jenistes.id_jenistes, tbl_jenistes.nama_tes, tbl_subtes.id_subtes AS 'subtes_id', tbl_subtes.nama_subtes, tbl_log.* FROM `tbl_subtes` LEFT JOIN `tbl_jenistes` ON tbl_jenistes.id_jenistes = tbl_subtes.id_jenistes LEFT JOIN `tbl_log` ON tbl_log.id_subtes = tbl_subtes.id_subtes AND tbl_log.id_user = '$_SESSION[id_user]' WHERE tbl_jenistes.nama_tes = '$_SESSION[jenis_tes]' GROUP BY tbl_subtes.nama_subtes ORDER BY tbl_subtes.added_at ASC");
            if (mysqli_num_rows($getSubtes) > 0) {
                while ($subtes = mysqli_fetch_array($getSubtes)) {
            ?>
                    <div class="col-lg-6 col-md-3">
                        <div class="card mt-3 ml-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title"><?= $subtes['nama_subtes'] ?></h5>
                                    <form action="#" method="POST">
                                        <input type="hidden" name="subtes" value="<?= $subtes['subtes_id'] ?>" />
                                        <input type="submit" name="submit" id="sub<?= $subtes['subtes_id'] ?>" value="Kerjakan" class="btn btn-primary" disabled="true" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            $subtesSelesai = mysqli_query($db, "SELECT tbl_subtes.id_subtes, tbl_jenistes.nama_tes, tbl_subtes.nama_subtes, tbl_subtes.added_at, log.id_user, log.status FROM `tbl_subtes` INNER JOIN `tbl_jenistes` ON tbl_jenistes.id_jenistes = tbl_subtes.id_jenistes LEFT JOIN (SELECT * FROM `tbl_log` WHERE id_user = '$_SESSION[id_user]' AND tipe = 'Soal') log ON log.id_subtes = tbl_subtes.id_subtes WHERE tbl_jenistes.nama_tes = '$_SESSION[jenis_tes]'  AND (log.status = 'Belum Selesai' OR log.status IS NULL)  ORDER BY tbl_subtes.added_at ASC LIMIT 1");
            if (mysqli_num_rows($subtesSelesai) > 0) {
                $subSelesai = mysqli_fetch_array($subtesSelesai);
                echo "<script>";
                echo "$('#sub" . $subSelesai['id_subtes'] . "').attr('disabled', false);";
                echo "$('#sub" . $subSelesai['id_subtes'] . "').removeClass('btn-primary');";
                echo "$('#sub" . $subSelesai['id_subtes'] . "').addClass('btn-danger');";
                echo "</script>";
            }
            ?>
        </div>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        $_SESSION['id_subtes'] = $_POST['subtes'];
        echo "<meta http-equiv='refresh' content='0; url=intruksi.php'>";
    }
    ?>
    <?php include('script.php') ?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Masukkan Tanggal Lahir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body">
                        <center>
                            Tanggal Lahir<br />
                            <input type="text" name="tgl_lahir" id="tglLahir" class="form-control" />
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <input type="submit" name="save_tgl" class="btn btn-primary" value="Simpan" />
                    </div>
                </form>
                <?php
                if (isset($_POST['save_tgl'])) {
                    $tglLahir = date("Y-m-d", strtotime($_POST['tgl_lahir']));
                    $updateSql = mysqli_query($db, "UPDATE `tbl_user` SET `tgl_lahir` = '$tglLahir' WHERE id_user = '$_SESSION[id_user]'");
                    if ($updateSql) echo "<meta http-equiv='refresh' content='0; url=list-tes.php'>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
<script>
    $(function() {
        $("#tglLahir").datepicker({
            dateFormat: "dd MM yy",
            changeYear: true,
            yearRange: "1950:2021",
            language: "id",
            locale: "id"
        });
    });
</script>

</html>