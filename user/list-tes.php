<?php
include("../koneksi.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar Tes</title>
    <?php
    include('header.php');
    ?>
    <link href="../css/sticky-navbar-footer.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://raw.githack.com/jquery/jquery-ui/main/ui/i18n/datepicker-id.js"></script>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
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
                Halaman Awal
            </div>
            <div class="card-body">
                <h5 class="card-title">Daftar Tes</h5>
                <p class="card-text">Berikut merupakan daftar tes yang akan anda kerjakan:</p>
            </div>
        </div>
        <div class="row">
            <?php
            if (isset($_SESSION['acara'])) {
                $getListTes = mysqli_query($db, "SELECT tbl_event.*, tbl_grup.jenis_tes FROM `tbl_event` INNER JOIN `tbl_grup` ON tbl_event.grup = tbl_grup.nama_grup WHERE tbl_event.id_event = '$_SESSION[acara]'");
                if (mysqli_num_rows($getListTes) > 0) {
                    $list = mysqli_fetch_array($getListTes);
                    $jenis_tes = explode(", ", $list['jenis_tes']);
                    for ($i = 0; $i < count($jenis_tes); $i++) {

            ?>
                        <div class="col-lg-6 col-md-12">
                            <div class="card mt-3 ml-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title"><?= $jenis_tes[$i] ?></h5>
                                        <form action="#" method="POST">
                                            <input type="hidden" name="jenis_tes" value="<?= $jenis_tes[$i] ?>" />
                                            <input type="submit" name="submit" value="Kerjakan" class="btn btn-primary" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        if ($_POST['jenis_tes'] == "CFIT") {
            $_SESSION['jenis_tes'] = "CFIT";
            echo "<meta http-equiv='refresh' content='0; url=list-subtes.php?jenis_tes=CFIT'>";
        }
        if ($_POST['jenis_tes'] == "IST") {
            $_SESSION['jenis_tes'] = "IST";
            echo "<meta http-equiv='refresh' content='0; url=list-subtes.php?jenis_tes=IST'>";
        }
        if ($_POST['jenis_tes'] == "DISC") {
            $_SESSION['jenis_tes'] = "DISC";
            $_SESSION['id_subtes'] = 17;
            echo "<meta http-equiv='refresh' content='0; url=intruksi.php'>";
        }
        if ($_POST['jenis_tes'] == "MBTI") {
            $_SESSION['jenis_tes'] = "MBTI";
            $_SESSION['id_subtes'] = 14;
            echo "<meta http-equiv='refresh' content='0; url=intruksi.php'>";
        }
        if ($_POST['jenis_tes'] == "MSDT") {
            $_SESSION['jenis_tes'] = "MSDT";
            $_SESSION['id_subtes'] = 15;
            echo "<meta http-equiv='refresh' content='0; url=intruksi.php'>";
        }
        if ($_POST['jenis_tes'] == "PAPI KOSTICK") {
            $_SESSION['jenis_tes'] = 'PAPI KOSTICK';
            $_SESSION['id_subtes'] = 16;
            echo "<meta http-equiv='refresh' content='0; url=intruksi.php'>";
        }
    }
    ?>
    <?php include('script.php') ?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Masukkan Tanggal Lahir</h5>
                </div>
                <form action="#" method="post">
                    <div class="modal-body">
                        <center>
                            Tanggal Lahir<br />
                            <input type="text" name="tgl_lahir" id="tglLahir" class="form-control" />
                        </center>
                    </div>
                    <div class="modal-footer">
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